# 订单类型 Order types

Order types 允许你控制订单应如何与Drupal Commerce的其他组件交互，
以及如何在系统中移动（状态变化）。

每个订单类型需要设定一个workflow，定义了该类型的订单将会处于哪些状态，
以及如何在这些状态之间变换。

系统中有一个默认的订单类型 `default`，它可用于关联可邮寄的商品，
它使用的是一个叫 `Fulfillment`的 workflow。
如果是数字商品这类不需要邮寄的订单类型，则可以使用更简单的 `Default` workflow。

每一个订单类型都可以设置草案订单的 `order refresh process` 刷新频繁度。

购物车模块 `cart module` 允许每个订单类型都可以控制在购物车中的默认视图，
包。

你可以对不同的订单类型使用不同的 `checkout` 流程。比如，
实物订单使用需要顾客填写收货地址的 `checkout` 流程，
而数字商品订单使用更简单的只需要支付即可的 `checkout` 流程。