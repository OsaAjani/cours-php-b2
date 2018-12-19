CREATE DATABASE IF NOT EXISTS cloud;

use cloud;


CREATE TABLE IF NOT EXISTS user
(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(150) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT 0,
    api_key VARCHAR(150) NOT NULL UNIQUE,
    PRIMARY KEY (id),
    UNIQUE(email),
    UNIQUE(api_key)
);


CREATE TABLE IF NOT EXISTS token
(
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    value VARCHAR(150) NOT NULL UNIQUE,
    expire TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS file
(
	id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
	name VARCHAR(150) NOT NULL ,
    uid VARCHAR(150) NOT NULL ,
    public_uid VARCHAR(150) NOT NULL ,
	PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE(user_id, name),
    UNIQUE(public_uid)
);

