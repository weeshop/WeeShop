# 订单项 Order items
订单项代表一个purchasable entity（可购买实体），一个订单中可以包含多个订单项。
订单项包含一个指向purchasable entity引用字段、一个表示购买数量的字段、
还有表示单价和小计的字段。

订单的总计，是各个订单项的小计之和。

订单刷新过程 order refresh process，会对草案订单的订单项单价进行计算。
当一个 purchasable entity的价格变动时，这个机制会以一定的策略使用草案订单
中对应的订单项单价进行同步。

add to cart（添加到购物车）表单，本质上是order item的创建表单。
它有着特殊的表单显示模式。顾客通过在这个表单上选择产品的属性组合来标识
要购买的具体purchased entity。