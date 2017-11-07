# 校园信息平台

## 技术栈

### 前端

* 语言： HTML/CSS/JavaScript
* 框架： Vue.js（这里因为要快速开发，使用了vue-cli这个脚手架）
* 环境： Node(npm)

HTML/CSS/JavaScript的学习，在 [http://www.w3school.com.cn/](http://www.w3school.com.cn/)上有详细的教程

Vue直接看官方文档即可 [https://cn.vuejs.org/](https://cn.vuejs.org/)

NPM是个包管理软件，只在用Vue下载依赖包时用到，安装很简单

具体安装教程见 [https://jingyan.baidu.com/article/91f5db1b2bb6941c7f05e33c.html](https://jingyan.baidu.com/article/91f5db1b2bb6941c7f05e33c.html)


### 后端

* 语言： PHP
* 框架： Laravel
* 环境： Apache/PHP/MySql 	

PHP在w3cschool上也有详细教程 [http://www.w3school.com.cn/](http://www.w3school.com.cn/)

Laravel我觉得看官方教程就行了 [http://laravelacademy.org/laravel-docs-5_2](http://laravelacademy.org/laravel-docs-5_2)

##### 依赖包安装

	composer install

##### 生成app_key

	php artisan key:generate(需先将.env.example改为.env) 

##### 修改数据库
	
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=your database
	DB_USERNAME=root
	DB_PASSWORD=your password

##### 数据库迁移

	php artisan migrate

##### 数据库回滚

	php artisan migrate：rollback

### 代码管理

使用老师推荐的Git

文档可以看这个  [https://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000](https://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000)

常用的命令：
	
	git clone 地址   // 克隆远程代码到本地	

	git pull     // 同步远程代码到本地
	
	git add --all 	 // 将代码推到本地仓库
	git commit -m "描述操作"		// 添加描述
	git push origin master		// 将本地仓库代码推到远程仓库

## 使用说明

#### 前端和后端分别运行在两个不同的端口

前端代码：

	# download
	git clone https://github.com/shinytang6/SchoolInfo

	# change directory
	cd fontend

	# install dependencies
	npm install

	# serve with hot reload at localhost:8080
	npm run dev

后端代码：
	
	// 确保之前已经完成安装依赖包以及生成app_key
	cd 目录 (public目录下)
	php -S localhost:端口

## 功能

> 这是最需要完成的一些功能

#### 用户

- [ ] 登录jaacount
- [x] 用户注册
- [ ] 关注活动
- [ ] 取消关注
- [x] 查看关注活动 
- [ ] 系统推送活动
- [ ] 评论
- [ ] 活动搜索
- [ ] 翻页浏览

#### 管理员

- [ ] 储存用户信息
- [ ] 发布活动信息
