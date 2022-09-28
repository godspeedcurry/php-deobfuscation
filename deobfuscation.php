<?php
error_reporting(0);
require 'vendor/autoload.php';

use PhpParser\Error;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

function eval_in_sandbox($expr){
    $expr = str_replace("<?php\n\n", '', $expr);
    file_put_contents('tmp.php', "<?php var_dump($expr);");
    $handle = popen("php tmp.php","r");
    $read = fread($handle, 4096);
    pclose($handle);
    $read = str_replace("\n",'',$read);
    if(strstr($read, 'Use of undefined constant') || strstr($read, 'Notice: Undefined') || strstr($read,'Fatal error: ')){
        return $expr;
    }
    if(strstr($read,'string(')){
        if(strstr($read,'string(0)')){
            return $expr;
        }
        return "'".addslashes(preg_replace("/string\(\d+\) \"(.*?)\"/",'${1}',$read))."'";
    }
    elseif(strstr($read,'int(')){
        return preg_replace("/int\(([+-]?\d+)\)/",'${1}',$read);
    }
    return $expr;
}

function convert_to_ast($code)
{
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    try {
        $ast = $parser->parse($code);
    } catch (Error $error) {
        echo "Parse error: {$error->getMessage()}\n";
        return;
    }
    return $ast;
}

function beautifyCode($ast)
{
    $prettyPrinter = new PrettyPrinter\Standard;
    return $prettyPrinter->prettyPrintFile($ast);
}

function strange_func_replace($ast)
{
    $code = beautifyCode($ast);
    $nodeFinder = new NodeFinder;

    $funcs =  $nodeFinder->findInstanceOf($ast, PhpParser\Node\Stmt\Function_::class);
    $map = [];
    $v = 0;

    foreach ($funcs as $func) {
        $funcname = $func->name->name;
        if (!isset($map[$funcname])) {
            if (!preg_match('/^[a-z0-9A-Z_]+$/', $funcname)) {
                $code = str_replace($funcname, "func_" . $v, $code);
                $v++;
                $map[$funcname] = $v;
            }
        }
    }
    return $code;
}

function strange_var_replace($code)
{
    $v = 0;
    $map = [];
    $tokens = token_get_all($code);
    $variables = array();
    foreach ($tokens as $token) {
        if ($token[0] === T_VARIABLE) {
            array_push($variables,$token[1]);
        }
    }
    // 优先替换长度更长的变量
    usort($variables, function($a,$b){return strlen($b)-strlen($a);});
    foreach($variables as $var){
        if (!isset($map[$var])) {
            if (!preg_match('/^\$[a-zA-Z0-9_]+$/', $var)) {
                $code = str_replace($var, '$var_' . $v++, $code);
                $map[$var] = $v;
            }
        }
    }
    return $code;
}

function funtion_dynamic_execute($ast)
{
    $code = beautifyCode($ast);
    $nodeFinder = new NodeFinder;
    $stats =  $nodeFinder->findInstanceOf($ast, PhpParser\Node\Expr\FuncCall::class);
    foreach ($stats as $stat) {
        
        $expr = beautifyCode(array($stat));
        $expr = str_replace("<?php\n\n", "", $expr);
        try {
            $non_calculate_func = array("error_reporting");
            $regex = join("|",$non_calculate_func);;
            if (strstr($expr, '$var_') === false && preg_match('/'.$regex.'/i', $expr) === 0 && substr_count($expr, "(") === 1) {
                $ret = eval("return " . $expr . ";");
                if (isset($ret)) {
                    if (gettype($ret) === 'string') {
                        if (function_exists($ret)){
                            $code = str_replace($expr, $ret, $code);
                        } 
                        else {
                            $code = str_replace($expr, "'" . addslashes($ret) . "'", $code);
                        }
                        
                    } elseif (gettype($ret) === "integer") {
                        $code = str_replace($expr, strval($ret), $code);
                    }
                }
            }
        } catch (\Throwable $e) {
            // echo $e;
        }
    }
    return $code;
}
// $arr[xxx]
function convert_array_index($ast)
{
    $code = beautifyCode($ast);
    $nodeFinder = new NodeFinder;
    $ArrayDims =  $nodeFinder->findInstanceOf($ast, PhpParser\Node\Expr\ArrayDimFetch::class);
    foreach ($ArrayDims as $ArrayDim) {
        $beforeExpr = str_replace("<?php\n\n", '',beautifyCode(array($ArrayDim)));
        $dim = str_replace("<?php\n\n", '', beautifyCode(array($ArrayDim->dim)));
        try {
            $ret = eval("return $dim;");
            if (isset($ret)) {
                if(gettype($ret) === 'string'){
                    $afterExpr = str_replace($dim, "'$ret'", $beforeExpr);
                }
                else if(gettype($ret) === 'integer'){
                    $afterExpr = str_replace($dim, $ret, $beforeExpr);
                }
                
                $code = str_replace($beforeExpr,$afterExpr, $code);
            }
        } catch (\Throwable $e) {
        }
    }
    return $code;
}

function convert_assign_right_value($ast)
{
    $code = beautifyCode($ast);
    $nodeFinder = new NodeFinder;
    $ArrayDims =  $nodeFinder->findInstanceOf($ast, PhpParser\Node\Expr\Assign::class);
    foreach ($ArrayDims as $ArrayDim) {
        
        $right_val = str_replace("<?php\n\n", '', beautifyCode(array($ArrayDim->expr)));
        try {
            $ret = eval("return $right_val;");
            if (isset($ret)) {
                if (gettype($ret) === 'string') {
                    if ($ret !== $right_val) {
                        $code = str_replace($right_val, "'" . addslashes($ret) . "'", $code);
                    }
                } elseif (gettype($ret) === 'integer') {
                    $code = str_replace($right_val, strval($ret), $code);
                }
            }
        } catch (\Throwable $e) {
        }
    }
    return $code;
}
// 没有引号 一般是常量
function isConstant($key)
{
    $arr = array("'", '"', '-', "+", "*", "/", "%");
    foreach($arr as $val){
        if(strstr($key, $val)){
            return false;
        }
    }
    return true;
}
function convert_func_args($ast)
{
    $code = beautifyCode($ast);
    $nodeFinder = new NodeFinder;
    $func_objs =  $nodeFinder->findInstanceOf($ast, PhpParser\Node\Expr\FuncCall::class);
    foreach ($func_objs as $func_obj) {
        foreach ($func_obj->args as $arg) {
            $arg = str_replace("<?php\n\n", '', beautifyCode(array($arg)));
                            
            try {
                if (strstr($arg, '$var_') === false && !isConstant($arg) ) {
                    $ret = eval_in_sandbox($arg);
                    if (isset($ret)) {
                        $code = str_replace($arg, $ret, $code);
                    }
                }
            } catch (\Throwable $e) {
            }
        }
    }
    return $code;
}


function deobfuse($code){
    $context = $code;
    eval(str_replace("<?php\n", "", $context));

    $ast1 = convert_to_ast($code);
    // 替换奇怪的函数名
    $code1 = strange_func_replace($ast1);
    
    // 替换奇怪的变量
    $code2 = strange_var_replace($code1);
    // return $code2;
    // 转换为语法树
    $ast2 = convert_to_ast($code2);
    // 函数动态执行

    $code3 = funtion_dynamic_execute($ast2);
    $ast3 = convert_to_ast($code3);
    // 数组下标

    $code4 = convert_array_index($ast3);
    $ast4 = convert_to_ast($code4);

    // 赋值

    $code5 = convert_assign_right_value($ast4);
    $ast5 = convert_to_ast($code5);

    // 函数参数
    $code6 = convert_func_args($ast5);
    return $code6;
}

if ($argc == 3) {
    $target_path = $argv[1];
    $output_path = $argv[2];
    // 目标文件
    $code = file_get_contents($target_path);
    $new_code = deobfuse($code);
    
    file_put_contents($output_path, $new_code);
}
