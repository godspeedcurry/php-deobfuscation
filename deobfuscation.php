<?php
// error_reporting(0);

require 'vendor/autoload.php';

use PhpParser\Error;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

class StrangeVarNameNodeVisitor extends NodeVisitorAbstract
{
    public $v = 0;
    public $var_map = array();
    public function leaveNode(Node $node) {
        if ($node instanceof Node\Expr\Variable) {
            if (!isset($this->var_map[$node -> name])) {
                $this->var_map[$node -> name] = $this->v;
                $this->v++;   
            }
            $node->name = "var_" . $this->var_map[$node -> name];
        }
    }
}

class StrangeFuncNameNodeVisitor extends NodeVisitorAbstract
{   
    public $v = 0;
    public $func_map = array();
    public function leaveNode(Node $node) {
        if ($node instanceof Node\Stmt\Function_ ) {
            if (!isset($this->func_map[$node -> name -> name])) {
                $this->func_map[$node -> name -> name] = $this->v;
                $this->v++;   
            }
            $node->name->name = "func_" . $this->func_map[$node -> name -> name];            
        }
        if ($node instanceof Node\Expr\FuncCall && ($node -> name) instanceof Node\Name && in_array($node -> name -> parts[0], get_defined_functions()['internal']) === false) {
            if (!isset($this->func_map[$node -> name -> parts[0]])) {
                $this->func_map[$node -> name -> parts[0]] = $this->v;
                $this->v++;   
            }
            $node->name-> parts[0] = "func_" . $this->func_map[$node -> name -> parts[0]];            
        }
    
    }
}

class StrangeClassNameNodeVisitor extends NodeVisitorAbstract
{   
    public $v = 0;
    public $class_map = array();
    public function leaveNode(Node $node) {
        if ($node instanceof Node\Stmt\Class_) {
            $classname = $node -> name -> name;
            if (!isset($this->class_map[$classname])) {
                $this->class_map[$classname] = $this->v;
                $this->v++;   
            }
            $node->name->name = "class_" . $this->class_map[$classname];            
        }

        if ($node instanceof Node\Expr\New_) {
            $classname = $node -> class -> parts;
            if(sizeof($classname) == 1){
                if (!isset($this->class_map[$classname[0]])) {
                    $this->class_map[$classname[0]] = $this->v;
                    $this->v++;   
                }
                $node -> class -> parts[0] = "class_" . $this->class_map[$classname[0]];            
            }
            
            
        }
    }
}

class FuncDynamicExecuteNodeVisitor extends NodeVisitorAbstract {   
    public $v = 0;
    public $func_map = array();
    public function leaveNode(Node $node) {
        if ($node instanceof Node\Expr\FuncCall && ($node -> name) instanceof Node\Name && in_array($node -> name -> parts[0], get_defined_functions()['internal']) ) {
            $expr = beautifyCode(array($node));
            $expr = str_replace("<?php\n\n", "", $expr);
            $non_calculate_func = array("error_reporting","exit","__FILE__","file_get_contents",'$_GET','$_POST','$_REQUEST','$_SERVER','eval');
            $regex = join("|",$non_calculate_func);
            if (strstr($expr, '$var_') === false && preg_match('/'.$regex.'/i', $expr) === 0 ) {
                $ret = eval("return $expr;");
                if (isset($ret)) {
                    if (gettype($ret) === 'string') {
                        return new Node\Scalar\String_($ret);
                    } 
                    elseif (gettype($ret) === "integer") {
                        return new Node\Scalar\LNumber($ret);
                    }
                    // todo
                }
            }
        }
    }
}

// class ArrayIndexNodeVisitor extends NodeVisitorAbstract{
//     public function leaveNode(Node $node) {
//         if (PhpParser\Node\Expr\ArrayDimFetch::class) {
//             $expr = beautifyCode(array($node));
//             $expr = str_replace("<?php\n\n", "", $expr);
//             $non_calculate_func = array("error_reporting","exit","__FILE__","file_get_contents",'$_GET','$_POST','$_REQUEST','$_SERVER','eval');
//             $regex = join("|",$non_calculate_func);
//             if (strstr($expr, '$var_') === false && preg_match('/'.$regex.'/i', $expr) === 0 ) {
//                 $ret = eval("return $expr;");
//                 if (isset($ret)) {
//                     if (gettype($ret) === 'string') {
//                         return new Node\Scalar\String_($ret);
//                     } 
//                     elseif (gettype($ret) === "integer") {
//                         return new Node\Scalar\LNumber($ret);
//                     }
//                     // todo
//                 }
//             }
//         }
//     }
// }


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
            if (isset($ret) && strstr($ret,"2bc5be0fb0ce084e9138288d6a13a35d") === false) {
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
            if (isset($ret) && strstr($ret,"2bc5be0fb0ce084e9138288d6a13a35d") === false) {
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


function deobfuse($code){
    // 创建上下文
    // $context = str_replace("<?php", "", $code);
    // var_dump($context);
    // eval($context);
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

    try {
        $stmts = $parser->parse($code);
        $traverser = new NodeTraverser;
        // 添加 node visitors
        $traverser->addVisitor(new StrangeVarNameNodeVisitor);
        $traverser->addVisitor(new StrangeFuncNameNodeVisitor);
        $traverser->addVisitor(new StrangeClassNameNodeVisitor);
        $traverser->addVisitor(new FuncDynamicExecuteNodeVisitor);
        // 遍历 AST
        $new_stmts = $traverser->traverse($stmts);

        $code = beautifyCode($new_stmts);

    } catch (Error $e) {
        echo 'Parse Error: ', $e->getMessage();
    }

    // print_r(convert_to_ast($code));
    
    // 转换为语法树
    // $ast3 = convert_to_ast($code3);
    // 函数动态执行

    // // 数组下标

    // $code5 = convert_array_index($code);
    // $ast5 = convert_to_ast($code5);

    // // 赋值

    // $code6 = convert_assign_right_value($ast5);
    // $ast6 = convert_to_ast($code6);

    return $code;
}

if ($argc == 3) {
    $target_path = $argv[1];
    $output_path = $argv[2];
    // 目标文件
    $code = file_get_contents($target_path);
    $new_code = deobfuse($code);
    
    file_put_contents($output_path, $new_code);
}
