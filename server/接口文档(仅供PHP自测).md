# 接口文档

写在前面的话:

- 请求示例 与 返回示例
- ` resCode ` 为 ` 1 ` 时, 表示请求成功, 后台返回预期的数据
- ` resCode ` 为 ` 0 ` 时, 表示请求失败, 后台返回错误信息
- 在以下目录中, 前缀 [+] 表示已完成接口
- 在以下目录中, 前缀 [-] 表示已删除接口
- 在以下目录中, 前缀 [x] 表示接口未完成

目录:

- [[x]用户获得随机background](#-获得随机background)
- [[-]用户获得当前用户的当前天气](#-获得当前用户的当前天气)
- [[-]用户保存收藏的链接](#-保存收藏的链接)
- [[-]用户更新收藏的链接](#-更新收藏的链接)
- [[-]用户获得收藏的链接集](#-获得收藏的链接集)
- [[x]用户注册](#-用户注册)
- [[x]用户登录](#-用户登录)
- [[-]用户编辑](#-用户编辑)
- [[x]用户创建群组](#-用户创建群组)
- [[x]用户加入群组](#-用户加入群组)
- [[x]用户获得群组列表](#-用户获得群组列表)
- [[x]群组中链接列表](#-群组中已审核的链接/群组中待审核的链接) 
- [[x]群组中用户列表](#-群组中用户列表)
- [[x]群组中新增链接](#-群组中新增链接) 
- [[x]群主审核通过链接](#-群主审核通过链接) 
- [[x]群主拒绝链接](#-群主拒绝链接) 
- [[x]群主删除链接](#-群主删除链接) 

------

## \# 获得随机background
- 接口地址: ` /getRandomScreensaver.php ` ;
- 请求方式: ` GET `
- 请求参数: 
  ```
  {
    pageSize : 10,// 每页条数
    pageNum  : 1  // 页码
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      dataSize : 10,
      dataNum : 1,
      dataTotal : 100,
      dataList :[{
          id:1,
          bgSrc: 'https://rabc2.iteye.com/i/media/v1/0f000nTw6TryU7IXpq-Cqs.jpg',
          bgStar: 1,
          bgAuthor:'',
          bgName: '图片名,图片标题,可以用,可以不用',
          bgDesc: '图片说明,图片详情,图片介绍,这是某某国家某某地区, 很丑的一个公考拉',
      },{
          id:2,
          bgSrc: 'https://rabc2.iteye.com/i/media/v1/0f000nTw6TryU7IXpq-Cqs.jpg',
          bgStar: 1,
          bgAuthor:'',
          bgName: '图片名,图片标题,可以用,可以不用',
          bgDesc: '图片说明,图片详情,图片介绍,这是某某国家某某地区, 很丑的一个公考拉',
      }]
    },
    resInfo:'成功: 获得数据!'
  }
  ```

## \# 用户注册
- 接口描述
  - 后台: 用户名和密码必填但不作额外验证, 用户头像选填
  - 用户头像目前仅支持 http 链接形式的, 暂不支持自主上传
- 接口地址: ` /userRegister.php ` ;
- 请求方式: ` POST `
- 请求参数: 
  ```
  {
    userAvatar: 'http://tup.jpg' // 用户头像
    userName : 'qgp',   // 用户名
    userPass : '123456' // 密码
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      userId : 10010 , // 用户id
      userAvatar: 'http://tup.jpg' ,// 用户头像
      userName : 'qgp',   // 用户名
      userPass : '123456' // 密码
    },
    resInfo: '用户注册成功！'
  }
  ```


## \# 用户登录
- 第三方登录?
- github登录?
- 自定义登录
  - 接口描述: 目前密码是非必填 
  - 接口地址: ` /userLogin.php ` ;
  - 请求方式: ` GET `
  - 请求参数: 
    ```
    {
      userName : 'qgp',   // 用户名
      userPass : '123456' // 密码
    }
    ```
  - 返回数据: 
    ```
    {
      resCode: 1, 
      resData: {
        userId : 10010 , // 用户id
        userAvatar: 'http://tup.jpg' // 用户头像
        userName : 'qgp',   // 用户名
      },
      resInfo: '用户登录成功！'
    }
    ```

## \# 用户创建群组

> 生成一个 key

- 接口地址: ` /generateKEY.php ` ;
- 请求方式: ` POST `
- 请求参数: 
  ```
  {
    userId : 10010,// 用户id(登录时获得) , 必填
    groupName : '肉山小客厅' // 群名, 非必填
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      hash : 'c5602ffe9069ece63a14ff471a2d4022',
      groupLord : '10010', // 群主
      groupName : '肉山小客厅',
    },
    resInfo:'创建成功'
  }
  ```

## \# 用户加入群组

> 提交一个 key


- 接口地址: ` /submitKEY.php ` ;
- 请求方式: ` POST `
- 请求参数: 
  ```
  {
    hash : 'c5602ffe9069ece63a14ff471a2d4022' , // 群id即为 hash
      userId : 10010
    },
    resInfo:'加入成功'
  }
  ```

## \# 用户获得群组列表

> 包括用户创建的 和 用户加入的

- 接口地址: ` /getGroupList.php ` ;
- 请求方式: ` GET `
- 请求参数: 
  ```
  {
    userId : 10010 , // 用户id
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      dataList :[{
        id	:	19,
        groupId	:	483d3855fccf56cceb2def4fff987da4,
        userId	:	10011,
        groupName	:	,
        groupLord	:	0,
      },{
        id	:	1,
        groupId	:	483d3855fccf56cceb2def4fff987da4,
        userId	:	10011,
        groupName	:	,
        groupLord	:	0,
      }]
    },
    resInfo:'获取数据成功'
  }
  ```

## \# 群组中链接列表
- 接口描述: 群组中已审核的链接/群组中待审核的链接
- 接口地址: ` /getLinksOfGroup.php ` ;
- 请求方式: ` GET `
- 请求参数: 
  ```
  {
    groupId  : 'c5602ffe9069ece63a14ff471a2d4022' , // 群id
    pageSize : 10,// 每页条数
    shareLinkState: 1, // 状态,0表示未审核(默认未审核), 1表示审核通过
    pageNum  : 1  // 页码
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      dataSize : 10,
      dataNum : 1,
      dataTotal : 100,
      dataList :[{
        link : 'baidu.com',
      },{
        link : 'google.com',
      }]
    },
    resInfo:'获取数据成功'
  }
  ```

## \# 群组中用户列表 - 根据群组获得群组中的成员
- 接口地址: ` /getUsersOfGroup.php ` ;
- 请求方式: ` GET `
- 请求参数: 
  ```
  {
    groupId  : 'c5602ffe9069ece63a14ff471a2d4022' , // 群id
    pageSize : 10,// 每页条数
    pageNum  : 1  // 页码
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      dataSize : 10,
      dataNum : 1,
      dataTotal : 100,
      dataList :[{
        userId : 10010,
        userName : 'qgp'
      },{
        userId : 10010,
        userName : 'hesf'
      }]
    },
    resInfo:'获取数据成功'
  }
  ```

## \# 群组中新增链接
- 接口地址: ` /addLinkOfGroup.php ` ;
- 请求方式: ` POST `
- 请求参数: 
  ```
  {
    groupId  : 'c5602ffe9069ece63a14ff471a2d4022' , // 群id
    userId : 10010 ,
    linkOfGroup : 'baidu.com', // 添加的链接
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      groupId  : 'c5602ffe9069ece63a14ff471a2d4022' , // 群id
      linkOfGroup : 'baidu.com', // 添加的链接
    },
    resInfo:'新增成功'
  }
  ```

## \# 群主审核通过链接 
- 接口地址: ` /updateLinkOfGroup.php ` ;
- 请求方式: ` POST `
- 请求参数: 
  ```
  {
    id : '',
    shareLinkState : '1'
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
      groupId	:	1,
      userId	:	1,
      shareLinkSrc	:	1,
      userName : '',
      shareLinkIcoScr	: '',
      shareLinkState	:	1,
      shareLinkName	:	'',
    },
    resInfo:'新增成功'
  }
  ```

## \# 群主拒绝链接 
- 接口地址: ` /updateLinkOfGroup.php ` ;
- 请求方式: ` POST `
- 请求参数: 
  ```
  {
    id : '',
    shareLinkState : '0'
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
    },
    resInfo:'新增成功'
  }
  ```

## \# 群主删除链接 (无论是否通过审核)
- 接口地址: ` /deleteLinkOfGroup.php ` ;
- 请求方式: ` POST `
- 请求参数: 
  ```
  {
    id : '', //链接id
    userId : '' // 用户id
  }
  ```
- 返回数据: 
  ```
  {
    resCode: 1, 
    resData: {
    },
    resInfo:'新增成功'
  }
  ```
























