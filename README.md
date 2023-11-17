<p align="center"><a href="https://www.weeshop.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://avatars2.githubusercontent.com/u/50817500?s=400&u=4014b477b48c6c8a517a0231592a685e019ae807&v=4" alt="WeeShop"></a></p>

<p align="center">An E-commerce web system that based on Drupal Commerce</p>


<h2 align="center"> WeeShop | QQ Group：714023327</h2>

Thank you for watching：
- Add stars to our GitHub repository.
- [Create issue](https://github.com/weeshop/WeeShop/issues/new) to report any problem.


## 特性
- 灵活的商品属性系统，可表达任意类型的商品，包括虚拟商品。
- 支持多仓库存管理，也支持不需要库存管理的商品。
- 灵活的结账过程，可以针对任意商品类型定制结账过程。
- 支持全球的物流信息对接，支持国内各大快递公司。
- 完备的多语言系统，支持全球100多种语言。
- 支持全球流行的各种支付手段，Paypal、支付宝、微信、银行卡等。
- 使用全文检索技术，可以选择使用各种流行的全文检索方案，如Apache solr等。
- 支持符合工业标准的 RESTFul 接口，可配置多种认证方式HTTP Basic、Oauth2.0 等，轻松进行移动应用开发。

## 快速体验

#### 创建 WeeShop 工程

本项目支持用 Composer 创建工程，使用下面的命令，会在当前目录下创建一个 `WeeShop` 目录，并在其中下载 WeeShop 相关的代码，包括它们的依赖：

```bash
composer create-project weeshop/weeshop-project WeeShop --stability dev --no-interaction -vvv
```

这条命令实际上是简单地下载 WeeShop 模板工程仓库 [weeshop/weeshop-project](https://github.com/weeshop/weeshop-project) 的代码，
并安装其所定义的 Composer 依赖，所以，实际上你也可以直接克隆该仓库，把它作为你新项目的起点。

#### 使用 Docker 镜像运行代码

本项目提供了预置的 Docker 镜像，并编排到了模板工程根目录的 `docker-compose.yml` 中。

如果不希望使用 docker 快速安装，也可以参考 [通过传统的手工方式安装](https://www.weeshop.org/user_guide/install.html)

先决条件：
- 确保本机 8080 端口没有被占用。这是因为 `docker-compose.yml` 中需要映射 Web 容器的 80 端口到物理机的 8080 端口。

```bash
# 启动docker容器
docker compose up -d
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
docker compose exec web bash

# 进入容器后，在容器内继续运行下面的命令
chmod u+w /app/web/sites/default && \
cd /app && \
vendor/bin/drush site:install weeshop \
install_configure_form.enable_update_status_emails=NULL \
install_configure_form.demo_content=0 \
--db-url=mysql://root:123@db:3306/drupal \
--locale=en \
--site-name='WeeShop' \
--site-mail='164713332@qq.com' \
--site-pass=ekpass \
--account-name=admin \
--account-mail=164713332@qq.com \
--account-pass=ekpass
vendor/bin/drush locale:check && \
vendor/bin/drush locale:update
```

浏览器访问 `http://localhost:8080`，开始体验吧！

#### 登录管理后台

安装完成后，通过 `http://localhost:8080/user/login` 登录后台。

## 重要 issues

- 订单打印 [#2831952](https://www.drupal.org/project/commerce/issues/2831952)

## Modules pending for Drupal 10 upgrade
Pending in dev branch:
- adminimal_admin_toolbar

Waiting:
- migrate_manifest

[粤ICP备18006542号-1](http://www.beian.miit.gov.cn)
