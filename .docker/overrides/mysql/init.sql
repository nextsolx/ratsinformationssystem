CREATE DATABASE IF NOT EXISTS testing;
CREATE USER 'testing'@'%' IDENTIFIED BY 'secret';
GRANT ALL ON testing.* TO 'testing'@'%';
