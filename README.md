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

## 用户在线状态
每一个登录的用户，都会使用Oauth2认证服务生成token，所以可以根据token的查找来确定一个用户
的在线状态。

用户实体关联了一个名为tokens的ApigilityOauth2Adapter\DoctrineEntity\OauthAccessToken 集合。
APP端可以检查User对象的tokens字段，该字段返回了用户有效的token数量，来确定用户是否在线。

### 逼退其他用户
用户主动退出时，一般要调用/oauth/access-token接口（delete方法）销毁一个有效的token。

但是有可能用户在一个设备上未执行退出操作，便在另一个设备上登录相同的帐号。
这时就可能有需要把前一个设备的会话销毁。这可以通过/oauth/access-token接口（get方法）
查找所有自己的有效token，并调用/oauth/access-token接口（delete方法）毁除了当前设备以外的所有token。

## Composer 依赖
- doctrine/doctrine-orm-module
- zend/config