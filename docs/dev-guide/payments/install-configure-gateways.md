# 安装并配置一个支付网关 Installing and Configure a Payment Gateway

在你配置你的网店时，你很可能需要安装一个提供支付网关的模块来使用你需要的在线支付服务。
当前可以使用的所有支付网关全部被列在[这里](https://docs.drupalcommerce.org/commerce2/developer-guide/payments/01.available-gateways)

本文以配置PayPal网关来作为示例，教你如何安装并配置一个支付网关。

## 安装模块
第一步是安装提供你所需要的支付网关的模块。在这个示例中，我们需要安装 `Commerce PayPal` 模块。
一般来说，我们应该使用 `Composer` 来下载模块代码，这样的话，一些依赖的模块也会自动下载。

## 添加一个支付网关
安装并启用模块后，访问 `/admin/commerce/config/payment-gateways` 页面，并点击 `Add payment gateway` 
按钮。然后填写显示的表单。这时你可以看到PayPal已经出现在`Plugin`选项中。填写好在线支付服务的相关访问凭证。
`Mode`选项，在开发测试的时请选择`Test`，如果在生产环境请选择`Live`。
然后保存，你会看见你的支付网关列表中出现了新建的PayPal网关。

## 使用网关进行支付 Paying at Checkout
添加了网关后，在支付时就会出现PayPal网关选择选项。选择，支付。