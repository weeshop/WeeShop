# CatShop
优雅易用的PHP商城，PHP网店。 

基于Laravel的基因，来自Symfony的底层技术，来自Drupal Commerce的核心技术，由Drupal中国开源社区维护。

由社区开发者维护，完全开源，任意商用，无须购买授权。

感谢您的关注，CatShop的成功离不开您的意见和支持：
- 马上Star此项目，最好同时Fork此项目，以帮助让更多的人看到此项目。
- 我们希望听见您的心声，请 [创建issue](https://github.com/catworking/catshop/issues/new) 来表达您的意见。
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
- 支持全球流行的各种支付手段，Paypal、支持宝、微信、银行卡等。
- 使用全文检索技术，可以选择使用各种流行的全文检索方案，如Apache solr等。
- 支持符合工业标准的RESTful接口，可配置多种认证方式HTTP Basic、Oauth2.0 等，轻松进行移动应用开发。

## 快速体验

使用docker-compose启动容器（请自行了解 [如何加速docker镜像下载](https://www.baidu.com/s?wd=docker%E5%8A%A0%E9%80%9F)）
```bash
cd path-to-catshop
docker-compose up -d --force-recreate --remove-orphans --build
```

安装示例数据
```bash
# 进入docker容器
docker-compose exec drupal bash -T

# 进入应用程序目录
cd /app/web
# 初始化数据目录
cp -r /app/web/sites_bak/* /app/web/sites

# 安装实例
su - www-data -c "drush -y -vvv --root=/app/web site-install catshop install_configure_form.site_default_country=CN install_configure_form.enable_update_status_emails=NULL --db-url=mysql://root:123@db:3306/drupal --account-name=admin --account-pass=123 --account-mail=164713332@qq.com --site-name=测试网站 --locale=zh-hans"
su - www-data -c "drupal site:install catshop  --langcode='zh-hans'  --db-type='mysql'  --db-host='db'  --db-name='drupal'  --db-user='root'  --db-pass='123'  --db-port='3306'  --site-name='MySite'  --site-mail='164713332@qq.com'  --account-name='admin'  --account-mail='164713332@qq.com'  --account-pass='123'"

# 通过drush的方式安装示例数据模块
su - www-data -c "drush -vvv en catshop_demo --root=/app/web"
```

浏览器访问 `http://localhost:8080`