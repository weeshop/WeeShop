<p align="center"><a href="https://www.weeshop.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://avatars2.githubusercontent.com/u/50817500?s=400&u=4014b477b48c6c8a517a0231592a685e019ae807&v=4" alt="WeeShop"></a></p>

<p align="center">优雅易用的微信小程序商城，服务端使用php开发。 </p>
<p align="center">完全开源，任意商用，无须购买授权。</p>
<p align="center">基于Laravel的基因，来自Symfony的底层技术，来自Drupal Commerce的核心技术，由Drupal中国开源社区维护。</p>


<h2 align="center"> WeeShop | QQ群：714023327</h2>

感谢您的关注，WeeShop的成功离不开您的意见和支持：
- 马上Star此项目，最好同时Fork此项目，以帮助让更多的人看到此项目。
- 我们希望听见您的心声，请 [创建issue](https://github.com/weeshop/WeeShop/issues/new) 来表达您的意见。
- 我们万分欢迎您参与开发，请阅读 [如何加入开发]()。

<img src="https://github.com/weeshop/documentation/raw/master/source/images/screenshot.jpg">
<img src="https://github.com/weeshop/documentation/raw/master/source/images/screenshot3.jpg">

简洁的美观的 UI 界面

<img src="https://github.com/weeshop/documentation/raw/master/source/images/screenshot2.png">

支持使用 `Apache Solr` 集群对商品进行`全文检索`，支持使用属性进行`分面搜索`，支持对搜索结果进行预提示。

本工程为 WeeShop 后台与服务端，微信小程序端的工程在 [WeeShop/WeeApp](https://github.com/weeshop/WeeApp)。

微信小程序商城是以本工程作为服务端进行开发的。

## 文档
- [用户指南](https://www.weeshop.org/user_guide/)
- [开发者指南](https://www.weeshop.org/dev_guide/)

## 特性
- 灵活的商品属性系统，可表达任意类型的商品，包括虚拟商品。
- 支持多仓库存管理，也支持不需要库存管理的商品。
- 灵活的结账过程，可以针对任意商品类型定制结账过程。
- 支持全球的物流信息对接，支持国内各大快递公司。
- 完备的多语言系统，支持全球100多种语言。
- 支持全球流行的各种支付手段，Paypal、支付宝、微信、银行卡等。
- 使用全文检索技术，可以选择使用各种流行的全文检索方案，如Apache solr等。
- 支持符合工业标准的RESTful接口，可配置多种认证方式HTTP Basic、Oauth2.0 等，轻松进行移动应用开发。

## 快速体验

#### 创建 WeeShop 工程

本项目支持用 Composer 创建工程，使用下面的命令，会在当前目录下创建一个 `myshop` 目录，并在其中下载 WeeShop 相关的代码，包括它们的依赖：

```bash
composer create-project weeshop/project-base:dev-8.x-1.x WeeShop --stability dev --no-interaction -vvv
```

这条命令实际上是简单地下载 WeeShop 模板工程仓库 [weeshop/project-base](https://github.com/weeshop/project-base) 的代码，
并安装其所定义的 Composer 依赖，所以，实际上你也可以直接克隆该仓库，把它作为你新项目的起点。

#### 使用 Docker 镜像运行代码

本项目提供了预置的 Docker 镜像，并编排到了模板工程根目录的 `docker-compose.yml` 中。

如果使用 `docker-compose`，你将无须关心PHP环境问题，您的电脑啥都不需要安装，除了基本的 `Docker` 服务和 `docker-compose`。

如果docker镜像下载慢，请自行了解 [如何加速docker镜像下载](https://www.baidu.com/s?wd=docker%E5%8A%A0%E9%80%9F)

如果不希望使用 docker 快速安装，也可以参考 [通过传统的手工方式安装](https://www.weeshop.org/user_guide/install.html)

先决条件：
- 确保本机8080端口没有被占用。这是因为 `docker-compose.yml` 中需要映射 Web 容器的 80 端口到物理机的 8080 端口。

```bash
# 启动docker容器
docker-compose up -d
```

#### 安装方式一：使用图形界面

这时你可以访问 `http://localhost:8080`，打开图形安装界面根据提示输入信息进行安装：
- 主机: db
- 端口：3306
- 用户：root
- 密码：123
- 数据库：weeshop


#### 安装方式二：使用命令行

如果你喜欢用命令行的方式，你可以使用下面的命令行来安装

```bash
# 进入docker容器
docker-compose exec web bash

# 进入容器后，在容器内继续运行下面的命令
# 安装实例， account-name 和 account-pass 分别是登录后台的用户名和密码
su - application -c \
"cd /app/web/sites && /usr/local/bin/drupal site:install --force --no-interaction weeshop  \
--langcode='en'  \
--db-type='mysql'  \
--db-host='db'  \
--db-name='weeshop'  \
--db-user='root'  \
--db-pass='123'  \
--db-port='3306'  \
--site-name='My WeeShop'  \
--site-mail='164713332@qq.com'  \
--account-name='admin'  \
--account-mail='164713332@qq.com'  \
--account-pass='123'"

# 更新翻译
su - application -c "cd /app/web/sites && \
/usr/local/bin/drush -vvv locale:check && \
/usr/local/bin/drush -vvv locale:update"
```

浏览器访问 `http://localhost:8080`，开始体验吧！

#### 登录管理后台

安装完成后，通过 `http://localhost:8080/user/login` 登录后台。

## 重要Issuse
- Docker for windows, volume默认权限是755，而无法更改 [#issues39](https://github.com/docker/for-win/issues/39)

  - 解决办法，使用Mac或Linux系统
  - 在 `docker-compose.yml` 中把 `/app/web/sites` 目录的volume注掉，让文件留在容器内

- 订单打印 [#2831952](https://www.drupal.org/project/commerce/issues/2831952)



[粤ICP备18006542号-1](http://www.beian.miit.gov.cn)
