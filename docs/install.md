# 传统方式安装指南

## 运行环境要求

### HTTP服务器

暂时只支持 Apache，请使用 2.4以上版本。

### PHP版本

请使用 7.1 以上版本。

#### 扩展模块

取决于你的操作系统和软件版本和PHP的安装方式的不同，php包含的扩展模块可能不一样，
但是你可以检查一下以下的列表，如果已安装了这些扩展，那么基本上不会有问题，
因为这是从开发人员的环境列出的清单：

```bash
bash-4.4# php -m
[PHP Modules]
apcu
bcmath
bz2
calendar
Core
ctype
curl
date
dom
exif
fileinfo
filter
ftp
gd
gettext
hash
iconv
imagick
intl
json
ldap
libxml
mbstring
mcrypt
mysqli
mysqlnd
openssl
pcntl
pcre
PDO
pdo_mysql
pdo_sqlite
Phar
posix
readline
redis
Reflection
session
shmop
SimpleXML
soap
sockets
SPL
sqlite3
standard
sysvmsg
sysvsem
sysvshm
tokenizer
wddx
xml
xmlreader
xmlrpc
xmlwriter
xsl
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

### MySQL版本

请使用 Mysql 5.7或以上的版本。

### Composer 版本

本工程使用 Composer 管理源码依赖，
请尽可能使用最新版本的 Composer。

## 安装方法

### 下载源码

暂时来说，你需要用 git 来下载源码：

```bash
# 用git下载代码到当前目录
git clone https://github.com/weeshop/WeeShop.git
cd WeeShop

# 拉取子库代码
git submodule init
git submodule update
```
Note: if you're using mutilple ssh RSAs, you might encounter the errors like below for submodule update.

Load key "/c/Users/CenaZ/.ssh/id_rsa_github.pub": invalid format
git@ssh.github.com: Permission denied (publickey).
fatal: Could not read from remote repository.
In case you are not accessing your own repository, or cloning inside a cloned repository (using some "git submodule... " commands):
In the home directory of your repository:

$ ls -a
1. Open ".gitmodules", and you will find something like this:

[submodule "XXX"]
    path = XXX
    url = git@github.com:YYY/XXX.git
Change the last line to be the HTTPS of the repository you need to pull:

[submodule "XXX"]
    path = XXX
    https://github.com/YYY/XXX.git
Save ".gitmodules", and run the command for submodules, and ".git" will be updated.

2. Open ".git", go to "config" file, and you will find something like this:

[core]
    repositoryformatversion = 0
    filemode = true
    bare = false
    logallrefupdates = true
    ignorecase = true
    precomposeunicode = true
[remote "origin"]
    url = https://github.com/YYY/XXX.git
    fetch = +refs/heads/*:refs/remotes/origin/*
[branch "master"]
    remote = origin
    merge = refs/heads/master
[submodule "XXX"]
    url = git@github.com:YYY/XXX.git
Change the last line to be the HTTPS of the repository you need to pull:

    url = https://github.com/YYY/XXX.git
So, in this case, the main problem is simply with the url. HTTPS of any repository can be found now on top of the repository page.

### 安装源码依赖

```bash
cd commerce
composer install -vvv
```

### 执行安装

- 把 `commerce/web` 目录设置为 apache的站点根目录
- 确保 apache 进程对 `commerce/web/sites/default` 目录拥有可写权限，其他目录权需可读权限即可。
- 在浏览器中访问 apache 站点，即可打开WeeShop的图形化安装界面
- 按照图形界面的要求填写数据库连接信息，和站点信息、管理员账号信息，即可完成安装
