## php 反混淆
主要是针对开源软件混淆后代码不好审计的情况 利用phpparser辅助分析

- [x] 格式化
- [x] 乱码变量、函数名修复
- [x] 函数动态执行 
- [x] 数组下标动态拼接
- [x] 函数参数动态拼接 

## usage 
python3 deobfuscation.py -t 3
指定多次可以获得理论上更好的结果


## TODO
- [ ] 优化代码逻辑
- [ ] 含有类的情况等等
- [ ] 未分析到的情况
![image](https://github.com/godspeedcurry/php-deobfuscation/blob/master/images/img1.png)                                                               