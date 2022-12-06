CREATE DATABASE BookStore;
USE BookStore;

CREATE TABLE Book(
    BookID varchar(50),
	BookTitle varchar(200),
    ISBN varchar(20),
    Price double(12,2),
    Author varchar(128),
    Type varchar(128),
    Image varchar(128),
    PRIMARY KEY (BookID)
);

CREATE TABLE Users(
    UserID int not null AUTO_INCREMENT,
    UserName varchar(128),
    Password varchar(16),
    PRIMARY KEY (UserID)
);

CREATE TABLE Customer (
	CustomerID int not null AUTO_INCREMENT,
    CustomerName varchar(128),
    CustomerPhone varchar(12),
    CustomerIC varchar(14),
    CustomerEmail varchar(200),
    CustomerAddress varchar(200),
    CustomerGender varchar(10),
    UserID int,
    PRIMARY KEY (CustomerID),
    CONSTRAINT FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE `Order`(
	OrderID int not null AUTO_INCREMENT,
    CustomerID int,
    BookID varchar(50),
    DatePurchase datetime,
    Quantity int,
    TotalPrice double(12,2),
    Status varchar(1),
    PRIMARY KEY (OrderID),
    CONSTRAINT FOREIGN KEY (BookID) REFERENCES Book(BookID) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Cart(
	CartID int not null AUTO_INCREMENT,
    CustomerID int,
    BookID varchar(50),
    Price double(12,2),
    Quantity int,
    TotalPrice double(12,2),
    PRIMARY KEY (CartID),
    CONSTRAINT FOREIGN KEY (BookID) REFERENCES Book(BookID) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON DELETE SET NULL ON UPDATE CASCADE
);


INSERT INTO `book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) VALUES ('B-001','Hacking com Kali Linux: Técnicas Práticas Para Testes de Invasão','978-8575223956',136,'','Travel','image/travel.jpg');
INSERT INTO `book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) VALUES ('B-002', 'Introdução ao Pentest', '978-8575228074', 150.00, 'Daniel Moreno', 'Hacker Ético', 'image/pentest.jpg');
INSERT INTO `book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) VALUES ('B-003', 'Linux - A bíblia: o mais abrangente e definitivo guia sobre Linux', '978-8576087991', 129.99, 'Christopher Negus', 'Tecnologia', 'image/linuxbiblia.jpg');
INSERT INTO `book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) VALUES ('B-004', 'Desenvolvendo Websites com PHP: Aprenda a Criar Websites Dinâmicos e Interativos com PHP e Bancos de Dados', '978-8575225349', 75.99, 'Juliano Niederauer', 'Tecnologia', 'image/php.jpg');
