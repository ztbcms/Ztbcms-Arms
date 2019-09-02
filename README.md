## 思路

1. 在 appBegin 行为开始记录开始信息，在 appEnd 中记录结束信息，最后计算信息差。可以考虑使用『行为』来实现
2. 在ajax 中直接统计（目前）

## 使用方法

```php
class Base extends CMS {
    // 引入覆盖 ajaxReturn
    use AjaxReturnTrait;
}
```
