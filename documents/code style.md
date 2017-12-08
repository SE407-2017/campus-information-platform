## 基本准则
* 合理使用缩进
* 最好保持每行宽度不超过 80 个字符
* 不要过多的运用空白符
* **运用有意义的名字命名属性（不要使用1,2,3这类无意义的符号）**

### 缩进
1. 使用 1 个tab (4个空格) 为一个缩进层级
```      
// good
.activity
    position: relative
// bad
.activity
  position: relative
```
2. CSS属性与值之间增加一个空格
```      
// good
.activity
    position: relative
// bad
.activity
  position:relative
```

### 命名
1. 变量 使用 Camel命名法
例如：
```
var addActivity = {};
```
2. 常量 使用 全部字母大写，单词间下划线分隔 的命名方式。
例如：
```
var CANCEL_APPLY = 1;
```
3. 函数 使用 Camel命名法。
例如：
```
function showDetail(var id) {}
```

这方面可能我也不是特别注意(所以发的有点晚)，但以上规则都是我严格遵守的，希望大家后续如果还有改动能遵守上述规则，也帮助大家养成尽可能好的代码风格/(ㄒoㄒ)/~~