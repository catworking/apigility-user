# Apigility User
用户组件提供了用户注册、用户个人资料管理功能，是绝大部分组件都依赖的组件。

## 实体
- Identity 用户标识
- User 用户
- IncomeLevel 收入等级
- Occupation 职业
- PersonalCertification 个人认证
- ProfessionalCertification 职业认证

实体之间的关联关系，请参考它们的实体类代码定义，也可以参考docs目录中的E-R图。

### 关于Identity和User两个实体的关系
Identity是用于保存用户帐号的实体，User是用于保存用户个人资料的实体。

Identity的id字段，与User的id字段的值是相同的，但这两个实体并没有做外键关联。

User对象不需要手动创建，注册帐号是通过POST Identity资源来完成的，创建一个Identity时，
会自动创建一个User对象，并且会保证其id字段的值与Identity对象一致。

## Composer 依赖
- doctrine/doctrine-orm-module
- zend/config