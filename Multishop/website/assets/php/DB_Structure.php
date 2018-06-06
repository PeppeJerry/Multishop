<?php

function Creation_DB($db_name){

/* Basically is the DB structure */

$Structure ="

CREATE TABLE categories(
	id SMALLINT AUTO_INCREMENT,
	name VARCHAR(40) NOT NULL,
	description TEXT,
	PRIMARY KEY (id)
);

CREATE TABLE products(
	id SMALLINT AUTO_INCREMENT,
	name VARCHAR(40) NOT NULL UNIQUE,
	quantity int(6),
	description TEXT,
	price DECIMAL (5,2),
	url_img VARCHAR(2083) default './assets/img/no.png',
	added TIMESTAMP default NOW(),
	enable BOOLEAN default true,
	category SMALLINT references categories(id),
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

CREATE TABLE stockists(
	p_iva INT(11),
	name VARCHAR(30) NOT NULL,
	CAP int(5) default 0
);

CREATE TABLE prod_transictions(
	product SMALLINT references products(id),
	stockist INT(11) references stockist(p_iva),
	quantity INT(6),
	action text,
	time_action TIMESTAMP default NOW(),
	id SMALLINT AUTO_INCREMENT,
	PRIMARY KEY(id)
);

CREATE TABLE settings(
	id SMALLINT,
	price BOOLEAN default false,
	stockist BOOLEAN default false,
	stock BOOLEAN default false,
	PRIMARY KEY (id)
);

";
	/* Create the database with that structure and the given name */
	$con = new PDO("mysql:host=localhost;dbname=".$db_name,"root","");
	$stmt = $con->prepare($Structure);
	$stmt->execute();
	unset($con);
	unset($stmt);
	return;
	
}

?>

