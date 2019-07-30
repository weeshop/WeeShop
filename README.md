<p align="center"><a href="https://www.weeshop.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://avatars2.githubusercontent.com/u/50817500?s=400&u=4014b477b48c6c8a517a0231592a685e019ae807&v=4" alt="WeeShop"></a></p>

<p align="center">优雅易用的微信小程序商城，服务端使用php开发。 </p>
<p align="center">完全开源，任意商用，无须购买授权。</p>
<p align="center">基于Laravel的基因，来自Symfony的底层技术，来自Drupal Commerce的核心技术，由Drupal中国开源社区维护。</p>


<h2 align="center"> WeeShop | QQ群：714023327</h2>

感谢您的关注，CatShop的成功离不开您的意见和支持：
- 马上Star此项目，最好同时Fork此项目，以帮助让更多的人看到此项目。
- 我们希望听见您的心声，请 [创建issue](https://github.com/weeshop/WeeShop/issues/new) 来表达您的意见。
- 我们万分欢迎您参与开发，请阅读 [如何加入开发]()。 

<img src="https://github.com/weeshop/WeeShop/raw/master/docs/screenshot.jpg">

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
```
su - application -c "cd /app/web/sites && /usr/local/bin/drupal site:install catshop  --langcode='en'  --db-type='mysql'  --db-host='db'  --db-name='drupal'  --db-user='root'  --db-pass='123'  --db-port='3306'  --site-name='CatShop'  --site-mail='164713332@qq.com'  --account-name='admin'  --account-mail='164713332@qq.com'  --account-pass='123'"
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



[粤ICP备18006542号-1](http://www.beian.miit.gov.cn)
