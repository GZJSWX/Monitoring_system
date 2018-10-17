create database SD;
use SD;
create table pr_admin(
id int primary key auto_increment,
username varchar(20) not null unique comment '用户名:具有唯一性',
password char(32) not null comment '用户密码:MD5加密'
)charset utf8;
create table kqsj(
rq datetime primary key not null  comment '日期',
kqwd float not null  comment '空气温度',
kqsd float not null  comment '空气湿度',
co float not null  comment '二氧化碳含量',
pm float not null  comment 'PM2.5含量',
gz float not null comment '光照强度'
)charset utf8;
create table szsj(
rq datetime primary key not null  comment '日期',
stwd float not null comment '水的温度',
ph float not null comment '水的酸碱度',
hzd float not null comment '水的浑浊度',
sw float not null comment '水位'
)charset utf8;
create table trsj(
rq datetime primary key not null  comment '日期',
trwd float not null comment '土壤温度',
trsd float not null comment '土壤湿度'
)charset utf8;
insert into pr_admin values(null,'admin',md5('admin'));