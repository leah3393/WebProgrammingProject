USE realestate_db;

CREATE TABLE PICTURE
(
	pictureID INT,
	picture VARCHAR(100),
	pid INT,
	isPrimary BOOLEAN,
	CONSTRAINT pk_PICTURE primary key (pictureID),
	CONSTRAINT fk_PropertyID2 foreign key (pid) references PROPERTY(pid)
);