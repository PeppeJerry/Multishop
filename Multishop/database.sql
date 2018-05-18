CREATE TABLE products(
	id SMALLINT AUTO_INCREMENT,
	name VARCHAR(40) NOT NULL,
	description TEXT,
	price DECIMAL (5,2),
	PRIMARY KEY (id)
);

CREATE TABLE categories(
	id SMALLINT AUTO_INCREMENT,
	name VARCHAR(40) NOT NULL,
	description TEXT,
	PRIMARY KEY (id)
);

CREATE TABLE classifications(
	id SMALLINT AUTO_INCREMENT,
	product SMALLINT,
	category SMALLINT,
	PRIMARY KEY (id)
);

CREATE TABLE users(
	userid VARCHAR(25) NOT NULL UNIQUE,
	pwd CHAR(128) NOT NULL,
	privilage SMALLINT 
	id SMALLINT,
	PRIMARY KEY(id)
);

CREATE TABLE settings(
	id SMALLINT AUTO_INCREMENT,
	price BOOLEAN default false,
	stockist BOOLEAN default false,
	stock BOOLEAN default false
);