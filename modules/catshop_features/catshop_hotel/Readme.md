# Roadmap

- [ ] 创建 `Hotel` entity has bundle

  酒店可以包含多个 `Room` 对象

- [ ] 创建 `Room` entity has bundle
  
  没有具体价格，可显示一个价格区间，
  价格区间由其所关联的 `BookingPool` 
  对象来生成。
  
- [ ] 创建 BookingPool entity 

  包含多个 `BookingUnit` entity，能计算最高价和最低价
  
- [ ] 创建 BookingUnit entity 
  
  实现 `PurchasableEntityInterface` 接口，
  包含一个价格字段 `price` ，和一个日期字段 `date`