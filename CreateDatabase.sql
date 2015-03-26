CREATE DATABASE realestate_db;

USE realestate_db;

CREATE TABLE PROPERTY_TYPE
(
	tid INT,
	name VARCHAR(15),
	CONSTRAINT pk_Property_Type primary key (tid)
);

CREATE TABLE SELLER
(
	sid INT,
	fname VARCHAR(20),
	lname VARCHAR(20),
	email VARCHAR(30),
	password VARCHAR(20),
	phone VARCHAR(11),
	addr VARCHAR(100),
	agency VARCHAR(20),
	approved BOOLEAN,
	CONSTRAINT pk_Seller primary key (sid)
);

CREATE TABLE BUYER
(
	bid INT,
	fname VARCHAR(20),
	lname VARCHAR(20),
	email VARCHAR(30),
	password VARCHAR(20),
	phone VARCHAR(11),
	pref_city VARCHAR(20),
	pref_state VARCHAR(2),
	pref_zip INT,
	pref_homeSize DOUBLE,
	pref_lotSize DOUBLE,
	pref_beds INT,
	pref_baths DOUBLE,
	pref_typeID INT,
	pref_lowPrice DOUBLE,
	pref_highPrice DOUBLE,
	CONSTRAINT pk_Buyer primary key (bid),
	CONSTRAINT fk_TypeID foreign key (pref_typeID) references PROPERTY_TYPE(tid)
);

CREATE TABLE PROPERTY
(
	pid INT,
	addr VARCHAR(30),
	city VARCHAR(20),
	state VARCHAR(2),
	zip INT,
	description VARCHAR(2000),
	sold BOOLEAN,
	price DOUBLE,
	homeSize DOUBLE,
	lotSize DOUBLE,
	typeID INT,
	sellerID INT,
	dateAdded DATETIME,
	yearBuilt INT,
	beds INT,
	baths DOUBLE,
	CONSTRAINT pk_Property primary key (pid),
	CONSTRAINT fk_TypeID2 foreign key (typeID) references PROPERTY_TYPE(tid),
	CONSTRAINT fk_SellerID foreign key (sellerID) references SELLER(sid)
);

CREATE TABLE FAVORITE
(
	bid INT, 
	pid INT,
	CONSTRAINT pk_Favorite primary key (bid, pid),
	CONSTRAINT fk_BuyerID foreign key (bid) references BUYER(bid),
	CONSTRAINT fk_PropertyID foreign key (pid) references PROPERTY(pid)
);

CREATE TABLE PICTURE
(
	pictureID INT,
	picture BLOB,
	pid INT,
	isPrimary BOOLEAN,
	CONSTRAINT pk_PICTURE primary key (pictureID),
	CONSTRAINT fk_PropertyID2 foreign key (pid) references PROPERTY(pid)
);