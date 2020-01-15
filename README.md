<p align="center"><a href="https://www.weeshop.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://avatars2.githubusercontent.com/u/50817500?s=400&u=4014b477b48c6c8a517a0231592a685e019ae807&v=4" alt="WeeShop"></a></p>

<p align="center">优雅易用的微信小程序商城，服务端使用php开发。 </p>
<p align="center">完全开源，任意商用，无须购买授权。</p>
<p align="center">基于Laravel的基因，来自Symfony的底层技术，来自Drupal Commerce的核心技术，由Drupal中国开源社区维护。</p>


<h2 align="center"> WeeShop | QQ群：714023327</h2>

感谢您的关注，WeeShop的成功离不开您的意见和支持：
- 马上Star此项目，最好同时Fork此项目，以帮助让更多的人看到此项目。
- 我们希望听见您的心声，请 [创建issue](https://github.com/weeshop/WeeShop/issues/new) 来表达您的意见。
- 我们万分欢迎您参与开发，请阅读 [如何加入开发]()。

[WeeShop v1.0.0 beta4 安装过程视频演示](https://www.bilibili.com/video/av79111768/)

<a href="https://www.bilibili.com/video/av79111768/">
  <img src="https://i1.hdslb.com/bfs/archive/c11af36df397aa86bfc351bbdecb264d0f86b734.jpg_400x300.jpg">
</a>


<img src="https://www.weeshop.org/images/screenshot.jpg">
<img src="https://www.weeshop.org/images/screenshot3.jpg">

简洁的美观的 UI 界面

<img src="https://www.weeshop.org/images/screenshot2.png">

支持使用 `Apache Solr` 集群对商品进行`全文检索`，支持使用属性进行`分面搜索`，支持对搜索结果进行预提示。

本工程为 WeeShop 后台与服务端，微信小程序端的工程在 [WeeShop/WeeApp](https://github.com/weeshop/WeeApp)。

微信小程序商城是以本工程作为服务端进行开发的。

## 文档
- [用户指南](https://www.weeshop.org/)
- [开发者指南](https://www.weeshop.org/)

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

# 安装测试数据
su - application -c \
"cd /app/web/sites && /usr/local/bin/drupal weeshop_demo:import"

# 更新翻译
su - application -c "cd /app/web/sites && \
/usr/local/bin/drush -vvv locale:check && \
/usr/local/bin/drush -vvv locale:update"
```

浏览器访问 `http://localhost:8080`，开始体验吧！

#### 登录管理后台

安装完成后，通过 `http://localhost:8080/user/login` 登录后台。

#### Thank you

<a href="https://www.jetbrains.com/?from=WeeShop">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120.1 130.2" id="jetbrains"><path d="M118.6,71.8c0.9-0.8,1.4-1.9,1.5-3.2c0.1-2.6-1.8-4.7-4.4-4.9 c-1.2-0.1-2.4,0.4-3.3,1.1l0,0l-83.8,45.9c-1.9,0.8-3.6,2.2-4.7,4.1c-2.9,4.8-1.3,11,3.6,13.9c3.4,2,7.5,1.8,10.7-0.2l0,0l0,0 c0.2-0.2,0.5-0.3,0.7-0.5l78-54.8C117.3,72.9,118.4,72.1,118.6,71.8L118.6,71.8L118.6,71.8z" fill="url(#jetbrains_a)"></path><path d="M118.8,65.1L118.8,65.1L55,2.5C53.6,1,51.6,0,49.3,0 c-4.3,0-7.7,3.5-7.7,7.7v0c0,2.1,0.8,3.9,2.1,5.3l0,0l0,0c0.4,0.4,0.8,0.7,1.2,1l67.4,57.7l0,0c0.8,0.7,1.8,1.2,3,1.3 c2.6,0.1,4.7-1.8,4.9-4.4C120.2,67.3,119.7,66,118.8,65.1z" fill="url(#jetbrains_b)"></path><path d="M57.1,59.5C57,59.5,17.7,28.5,16.9,28l0,0l0,0c-0.6-0.3-1.2-0.6-1.8-0.9 c-5.8-2.2-12.2,0.8-14.4,6.6c-1.9,5.1,0.2,10.7,4.6,13.4l0,0l0,0C6,47.5,6.6,47.8,7.3,48c0.4,0.2,45.4,18.8,45.4,18.8l0,0 c1.8,0.8,3.9,0.3,5.1-1.2C59.3,63.7,59,61,57.1,59.5z" fill="url(#jetbrains_c)"></path><path d="M49.3,0c-1.7,0-3.3,0.6-4.6,1.5L4.9,28.3c-0.1,0.1-0.2,0.1-0.2,0.2l-0.1,0 l0,0c-1.7,1.2-3.1,3-3.9,5.1C-1.5,39.4,1.5,45.9,7.3,48c3.6,1.4,7.5,0.7,10.4-1.4l0,0l0,0c0.7-0.5,1.3-1,1.8-1.6l34.6-31.2l0,0 c1.8-1.4,3-3.6,3-6.1v0C57.1,3.5,53.6,0,49.3,0z" fill="url(#jetbrains_d)"></path><path fill="#000" d="M34.6 37.4H85.6V88.4H34.6z"></path><path fill="#FFF" d="M39 78.8H58.1V82H39z"></path><g fill="#FFF"><path d="M38.8,50.8l1.5-1.4c0.4,0.5,0.8,0.8,1.3,0.8c0.6,0,0.9-0.4,0.9-1.2l0-5.3l2.3,0 l0,5.3c0,1-0.3,1.8-0.8,2.3c-0.5,0.5-1.3,0.8-2.3,0.8C40.2,52.2,39.4,51.6,38.8,50.8z"></path><path d="M45.3,43.8l6.7,0v1.9l-4.4,0V47l4,0l0,1.8l-4,0l0,1.3l4.5,0l0,2l-6.7,0 L45.3,43.8z"></path><path d="M55,45.8l-2.5,0l0-2l7.3,0l0,2l-2.5,0l0,6.3l-2.3,0L55,45.8z"></path><path d="M39,54l4.3,0c1,0,1.8,0.3,2.3,0.7c0.3,0.3,0.5,0.8,0.5,1.4v0 c0,1-0.5,1.5-1.3,1.9c1,0.3,1.6,0.9,1.6,2v0c0,1.4-1.2,2.3-3.1,2.3l-4.3,0L39,54z M43.8,56.6c0-0.5-0.4-0.7-1-0.7l-1.5,0l0,1.5 l1.4,0C43.4,57.3,43.8,57.1,43.8,56.6L43.8,56.6z M43,59l-1.8,0l0,1.5H43c0.7,0,1.1-0.3,1.1-0.8v0C44.1,59.2,43.7,59,43,59z"></path><path d="M46.8,54l3.9,0c1.3,0,2.1,0.3,2.7,0.9c0.5,0.5,0.7,1.1,0.7,1.9v0 c0,1.3-0.7,2.1-1.7,2.6l2,2.9l-2.6,0l-1.7-2.5h-1l0,2.5l-2.3,0L46.8,54z M50.6,58c0.8,0,1.2-0.4,1.2-1v0c0-0.7-0.5-1-1.2-1 l-1.5,0v2H50.6z"></path><path d="M56.8,54l2.2,0l3.5,8.4l-2.5,0l-0.6-1.5l-3.2,0l-0.6,1.5l-2.4,0L56.8,54z M58.8,59l-0.9-2.3L57,59L58.8,59z"></path><path d="M62.8,54l2.3,0l0,8.3l-2.3,0L62.8,54z"></path><path d="M65.7,54l2.1,0l3.4,4.4l0-4.4l2.3,0l0,8.3l-2,0L68,57.8l0,4.6l-2.3,0L65.7,54z"></path><path d="M73.7,61.1l1.3-1.5c0.8,0.7,1.7,1,2.7,1c0.6,0,1-0.2,1-0.6v0 c0-0.4-0.3-0.5-1.4-0.8c-1.8-0.4-3.1-0.9-3.1-2.6v0c0-1.5,1.2-2.7,3.2-2.7c1.4,0,2.5,0.4,3.4,1.1l-1.2,1.6 c-0.8-0.5-1.6-0.8-2.3-0.8c-0.6,0-0.8,0.2-0.8,0.5v0c0,0.4,0.3,0.5,1.4,0.8c1.9,0.4,3.1,1,3.1,2.6v0c0,1.7-1.3,2.7-3.4,2.7 C76.1,62.5,74.7,62,73.7,61.1z"></path></g></svg>
感谢 JetBrain 对本项目的资助
</a>

## 重要Issuse
- Docker for windows, volume默认权限是755，而无法更改 [#issues39](https://github.com/docker/for-win/issues/39)

  - 解决办法，使用Mac或Linux系统
  - 在 `docker-compose.yml` 中把 `/app/web/sites` 目录的volume注掉，让文件留在容器内

- 订单打印 [#2831952](https://www.drupal.org/project/commerce/issues/2831952)



[粤ICP备18006542号-1](http://www.beian.miit.gov.cn)
