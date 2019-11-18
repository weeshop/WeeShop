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
