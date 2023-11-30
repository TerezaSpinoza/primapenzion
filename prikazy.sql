-- Active: 1701069067805@@127.0.0.1@3306@penzion
CREATE DATABASE penzion DEFAULT CHARSET utf8mb4;
DROP DATABASE penzion;
CREATE TABLE stranka (
    id VARCHAR(255) PRIMARY KEY,
    titulek VARCHAR(255),
    menu VARCHAR(255),
    obrazek VARCHAR(255),
    obsah TEXT,
    poradi INT NOT NULL DEFAULT 0
);
SHOW TABLES;
INSERT INTO stranka SET id="kocka", titulek="mnau", menu="cici", obrazek="primapenzion-main.jpg", obsah="cici123";
SELECT * from stranka;
delete from stranka;

SELECT MAX(poradi) max_poradi FROM stranka
