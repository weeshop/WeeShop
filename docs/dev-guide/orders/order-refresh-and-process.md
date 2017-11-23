# 订单刷新和处理 Order refresh and processing

Order processing是 order refresh process（订单刷新过程）的一部分。
这个过程以一定的策略运行在一个草案订单上，以确保订单的所有adjustments(优惠券之类的价格调整)
和订单项的单价都是最新的状态。

## 订单刷新的生命周期 The order refresh lifecycle
订单刷新是必不可少的，因为一个订单还在草案阶段时，很多订单要素都可能地订单草案期间发生变化，
订单刷新可以确保草案订单中的商品价格、促销价格、税额等要素是最新的状态。
当一个订单被加载时，订单的storage（数据储存管理器）会检查订单是否需要刷新。
如果需要，就调用order refresh cycle，它是由`commerce_order.order_refresh`过程控制的。

> 订单刷新只会应用在草案订单上，一个已确定的（paced）的订单是不会应用订单刷新的。

下面是订单刷新过程的一个概貌：
- 订单从storage中加载时，判断它是否需要刷新。
- 移除订单上的所有adjustment(各种价格调整)。
- 处理每一个订单项：
  - 移除订单项上的所有adjustment
  - 把订单项的单价，应用为对应purchasable entity的最新的单价。
- 在订单上运行已经挂载的服务
  - 促销模块把adjustment（促销价格调整）应用到订单和订单项上。
  - Tax税务模块应用税额调整到订单。
- 如果订单刷新后有了变化，那么保存订单。

## 配置订单刷新阈值Configure the order refresh threshold
每一个订单类型都有可配置自己的刷新阈值。一个常规的顾客的订单，可能只需要每个小时刷新一次，
但一个批发商的订单就可能要更频繁地刷新，比如每分钟刷新。

默认情况下，订单是每5分钟刷新一次的，可以在订单类型编辑页面修改。

## 把服务挂载(hooking)到订单刷新过程
`order refresh process` 使用 `tagged services`的方式来标识哪些服务应该被运行。
服务类必须实现接口 `\Drupal\commerce_order\OrderProcessorInterface`。

这是一个模块中的`*.services.yml`文件的例子：
```yaml
  # Order refresh process to apply taxes.
  # We set the priority very low so it calculates last.
  commerce_demo.order_process.taxes:
    class: Drupal\commerce_demo\OrderProcessor\ApplyTaxAdjustments
    tags:
      - { name: commerce_order.order_processor, priority: -300 }
```