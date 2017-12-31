# 开发者指南

CatShop的目前的开发方针分为两大部分：
- 文档开发
- 功能开发

## 目录
- [系统架构](architecture/index.md)

## 如何扩展
- 产品类型：相关Entity实现 `\Drupal\commerce\PurchasableEntityInterface` 接口
- 结账流程：实现 `@CommerceCheckoutFlow` 插件
- 结账流程步骤：实现 `@CommerceCheckoutPane` 插件
- 支付方式： 实现 `@CommercePaymentType` `@CommercePaymentMethodType` `@CommercePaymentGateway` 插件（微信和支付宝已有社区项目）
- 物流方式：实现 `commerce_shipping` 模块的 `@CommerceShippingMethod` 插件