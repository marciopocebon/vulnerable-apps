CREATE TABLE comments(
    id MEDIUMINT NOT NULL AUTO_INCREMENT,
    name CHAR(30) NOT NULL,
    text TEXT NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO comments(name, text) VALUES('admin', 'Hi!'),('guest', 'Nice site!'),('other', 'anybody here?');
