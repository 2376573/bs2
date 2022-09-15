create table memo(
    idx int(6) not null auto_increment,
    username varchar(20) not null,
    memodate datetime default CURRENT_TIMESTAMP,
    txt text,
    userpw varchar(50) not null,
    primary key (idx)
);
create table user(
    idx int(6) not null auto_increment,
    userid varchar(20) not null,
    username varchar(20) not null,
    userpw varchar(50) not null,
    userip varchar(16) not null,
    userdate datetime default CURRENT_TIMESTAMP,
    primary key (idx),
    unique (userid)
);
