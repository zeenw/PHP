CREATE database project_php
;

use project_php
;

CREATE TABLE user (
  user_id smallint PRIMARY KEY auto_increment,
  uemail varchar(40) unique,
  fname varchar(40) not null,
  lname varchar(40) not null,
  pword varchar(40) not null,
  phone varchar(25),
  expire_date date,
  creat_date date,
  member_type smallint,
  card_num varchar(50),
  card_mm char(2),
  card_yy char(4),
  card_code char(6),
  card_name varchar(60),
  uaddress varchar(80),
  city varchar(40),
  postcode varchar(15),
  province varchar(20)
);

insert into user (uemail, fname, lname, pword, expire_date, creat_date, member_type) 
values 
('zeen@mytrip.com', 'zeen', 'wu', '111', DATE_ADD(current_date(), INTERVAL 1 year), current_date(), 1),
('zeen@gmail.com', 'zeen', 'wu', '111', DATE_ADD(current_date(), INTERVAL 1 year), current_date(), 0)
;

CREATE TABLE category (
  cate_id smallint auto_increment PRIMARY KEY ,
  category varchar(40)
);

alter table category
add column flag smallint
;
insert into product values
(1,'Cuba 7 days ALL–INCLUSIVE', 1, 'Cuba 7 days ALL–INCLUSIVE description', 1, '$4199.00', '10.jpg'),
(2,'Jamaca 7 days ALL–INCLUSIVE', 2, 'Cuba 7 days ALL–INCLUSIVE description', 2, '$4199.00', '20.jpg'),
(3,'Mexico 7 days ALL–INCLUSIVE', 3, 'Cuba 7 days ALL–INCLUSIVE description', 3, '$4199.00', '30.jpg'),
(4,'USA 7 days ALL–INCLUSIVE', 4, 'Cuba 7 days ALL–INCLUSIVE description', 4, '$4199.00', '40.jpg'),
(5,'Cuba 7 days ALL–INCLUSIVE', 1, 'Cuba 7 days ALL–INCLUSIVE description', 1, '$4199.00', '11.jpg'),
(6,'Jamaca 7 days ALL–INCLUSIVE', 2, 'Cuba 7 days ALL–INCLUSIVE description', 2, '$4199.00', '21.jpg'),
(7,'Mexico 7 days ALL–INCLUSIVE', 3, 'Cuba 7 days ALL–INCLUSIVE description', 3, '$4199.00', '31.jpg'),
(8,'USA 7 days ALL–INCLUSIVE', 4, 'Cuba 7 days ALL–INCLUSIVE description', 4, '$4199.00', '41.jpg'),
(9,'Cuba 7 days ALL–INCLUSIVE', 1, 'Cuba 7 days ALL–INCLUSIVE description', 1, '$4199.00', '12.jpg'),
(10,'Jamaca 7 days ALL–INCLUSIVE', 2, 'Cuba 7 days ALL–INCLUSIVE description', 2, '$4199.00', '22.jpg'),
(11,'Mexico 7 days ALL–INCLUSIVE', 3, 'Cuba 7 days ALL–INCLUSIVE description', 3, '$4199.00', '32.jpg'),
(12,'USA 7 days ALL–INCLUSIVE', 4, 'Cuba 7 days ALL–INCLUSIVE description', 4, '$4199.00', '42.jpg')
;

CREATE TABLE product (
  product_id smallint auto_increment PRIMARY KEY,
  product_name varchar(50),
  cid smallint,
  description varchar(10000),
  views smallint,
  price varchar(15),
  pic_name varchar(100)
);

CREATE TABLE comment (
  comment_id smallint auto_increment PRIMARY KEY ,
  uid smallint,
  pid smallint not null,
  score smallint,
  comment varchar(800)
);

insert into comment (uid, pid, score, comment) values 
(1,1,4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce justo quam, blandit quis vehicula vel, consectetur ac augue. Donec pharetra ullamcorper arcu, id condimentum quam blandit eget. Sed laoreet ut nisi id rhoncus. Duis nec pulvinar velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi in tristique orci. Aliquam neque mauris, placerat et libero vel, vestibulum molestie velit. Etiam eget sollicitudin felis, nec rutrum ex. Mauris venenatis id turpis ut laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'),
(1,2,4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce justo quam, blandit quis vehicula vel, consectetur ac augue. Donec pharetra ullamcorper arcu, id condimentum quam blandit eget. Sed laoreet ut nisi id rhoncus. Duis nec pulvinar velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi in tristique orci. Aliquam neque mauris, placerat et libero vel, vestibulum molestie velit. Etiam eget sollicitudin felis, nec rutrum ex. Mauris venenatis id turpis ut laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'),
(2,3,4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce justo quam, blandit quis vehicula vel, consectetur ac augue. Donec pharetra ullamcorper arcu, id condimentum quam blandit eget. Sed laoreet ut nisi id rhoncus. Duis nec pulvinar velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi in tristique orci. Aliquam neque mauris, placerat et libero vel, vestibulum molestie velit. Etiam eget sollicitudin felis, nec rutrum ex. Mauris venenatis id turpis ut laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'),
(2,4,4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce justo quam, blandit quis vehicula vel, consectetur ac augue. Donec pharetra ullamcorper arcu, id condimentum quam blandit eget. Sed laoreet ut nisi id rhoncus. Duis nec pulvinar velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi in tristique orci. Aliquam neque mauris, placerat et libero vel, vestibulum molestie velit. Etiam eget sollicitudin felis, nec rutrum ex. Mauris venenatis id turpis ut laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'),
(0,5,4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce justo quam, blandit quis vehicula vel, consectetur ac augue. Donec pharetra ullamcorper arcu, id condimentum quam blandit eget. Sed laoreet ut nisi id rhoncus. Duis nec pulvinar velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi in tristique orci. Aliquam neque mauris, placerat et libero vel, vestibulum molestie velit. Etiam eget sollicitudin felis, nec rutrum ex. Mauris venenatis id turpis ut laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'),
(0,6,4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce justo quam, blandit quis vehicula vel, consectetur ac augue. Donec pharetra ullamcorper arcu, id condimentum quam blandit eget. Sed laoreet ut nisi id rhoncus. Duis nec pulvinar velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi in tristique orci. Aliquam neque mauris, placerat et libero vel, vestibulum molestie velit. Etiam eget sollicitudin felis, nec rutrum ex. Mauris venenatis id turpis ut laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'),
(0,6,4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce justo quam, blandit quis vehicula vel, consectetur ac augue. Donec pharetra ullamcorper arcu, id condimentum quam blandit eget. Sed laoreet ut nisi id rhoncus. Duis nec pulvinar velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi in tristique orci. Aliquam neque mauris, placerat et libero vel, vestibulum molestie velit. Etiam eget sollicitudin felis, nec rutrum ex. Mauris venenatis id turpis ut laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.')
;


CREATE TABLE cart (
  cart_id int auto_increment PRIMARY KEY ,
  uid smallint,
  pid smallint,
  quantity smallint,
  order_date datetime DEFAULT current_timestamp,
  flag smallint

);

select * from product inner join category where cid = cate_id and cid = 1
;

select * from product inner join cart where product_id = pid and flag = 1 and uid = 2
;

delete from comment where comment_id>13
;

select * from user
;
