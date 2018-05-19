CREATE TABLE products(
	id SMALLINT AUTO_INCREMENT,
	name VARCHAR(40) NOT NULL,
	description TEXT,
	price DECIMAL (5,2),
	enable BOOLEAN default true,
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

CREATE TABLE priorities(
	lvl SMALLINT,
	name VARCHAR(20) UNIQUE,
	PRIMARY KEY(lvl)
);

CREATE TABLE users(
	userid VARCHAR(25) NOT NULL UNIQUE,
	pwd CHAR(128) NOT NULL,
	id SMALLINT AUTO_INCREMENT,
	a_product BOOLEAN default false,
	a_admin BOOLEAN default false,
	priority SMALLINT references priorities(lvl),
	enable BOOLEAN default true,
	PRIMARY KEY(id)
);

CREATE TABLE settings(
	id SMALLINT,
	price BOOLEAN default false,
	stockist BOOLEAN default false,
	stock BOOLEAN default false,
	PRIMARY KEY (id)
);