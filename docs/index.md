# WeeShop | QQ群：714023327
优雅易用的微信小程序商城，服务端使用php开发。 

基于Laravel的基因，来自Symfony的底层技术，来自Drupal Commerce的核心技术，由Drupal中国开源社区维护。

由社区开发者维护，完全开源，任意商用，无须购买授权。

感谢您的关注，CatShop的成功离不开您的意见和支持：
- 马上Star此项目，最好同时Fork此项目，以帮助让更多的人看到此项目。
- 我们希望听见您的心声，请 [创建issue](https://github.com/weeshop/WeeShop/issues/new) 来表达您的意见。
- 我们万分欢迎您参与开发，请阅读 [如何加入开发]()。 

## 文档
- [用户指南](docs/user-guide/index.md)
- [开发者指南](docs/dev-guide/index.md)

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

本项目使用Docker进行快速部署实例，`无须PHP环境`，您的电脑啥都不需要安装，只需要安装`Docker`服务和`docker-compose`即可。

如果docker镜像下载慢，请自行了解 [如何加速docker镜像下载](https://www.baidu.com/s?wd=docker%E5%8A%A0%E9%80%9F)）

先决条件：
- 确保本机80端口没有被占用。
- 把 `weeshop.dev` 指向本机。（也可以使用其他域名）

```bash
# 用git下载代码到当前目录
git clone https://github.com/weeshop/WeeShop.git
cd WeeShop

# 启动docker容器
docker-compose up -d --force-recreate --remove-orphans --build

# 进入docker容器
docker-compose exec server bash

# 进入容器后，在容器内继续运行下面的命令

# 安装composer依赖
cd /app
composer install

# 安装实例
su - application -c "cd /app/web/sites && /usr/local/bin/drupal site:install catshop --langcode='en'  --db-type='mysql'  --db-host='db'  --db-name='drupal'  --db-user='root'  --db-pass='123'  --db-port='3306'  --site-name='CatShop'  --site-mail='164713332@qq.com'  --account-name='admin'  --account-mail='164713332@qq.com'  --account-pass='123'"
```

浏览器访问 `http://weeshop.dev`

开启开发模式
```bash
su - application -c "cd /app/web/sites && /usr/local/bin/drupal site:mode -vvv dev"
```

## 重要Issuse 
- Docker for windows, volume默认权限是755，而无法更改 [#issues39](https://github.com/docker/for-win/issues/39)
  
  - 解决办法，使用Mac或Linux系统
  - 在 `docker-compose.yml` 中把 `/app/web/sites` 目录的volume注掉，让文件留在容器内

- 订单打印 [#2831952](https://www.drupal.org/project/commerce/issues/2831952)

## 商品搜索功能的实现

使用 `search_api` 和 `facets` 模块，实现商品索功能。

创建一个名为 `product_search` 模块，用来保存相关功能代码资源。

- 默认使用数据库搜索，通过安装 `search_api_db_defaults` 模块，
  会自动创建一个名为 `default_server` 的 `search_api_db` backend类型索引服务器。
- 默认创建一个产品搜索索引，用创建一个 config entity的方式实现。
- 向产品搜索索引添加必要的字段。
- 创建一个对 `产品搜索索引` 进行搜索的 `view`，并添加默认的必要字段。


当有新的产品属性创建时，同时创建以下数据：
- 查找产品索引，向其添加索引字段。
- 创建相应的Block，并把它添加到边栏region。

[粤ICP备18006542号-1](http://www.beian.miit.gov.cn)
