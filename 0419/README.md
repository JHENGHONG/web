建立...
* 資料庫 test0329
* 資料表table moneybook
* 欄位
	1. m_id    Primary key
	2. name    200以下的字串
	3. cost    整數
* 可以操作這個資料庫的使用者 mememe / 123456
	1. 執行 D:\xampp\mysql\bin\mysql -uroot
	2. 使用 http://localhost/phpmyadmin/
	3. 使用 adminer http://localhost/adminer.php
   

命令提示字元 D:\xampp\mysql\bin\mysql -uroot

````
CREATE DATABASE test0329 DEFAULT CHARACTER SET 'utf8' DEFAULT COLLATE 'utf8_general_ci';

CREATE USER 'mememe'@'localhost' IDENTIFIED BY '123456';

GRANT ALL PRIVILEGES ON test0329.* TO 'mememe'@'localhost';

FLUSH PRIVILEGES;

EXIT;
````

命令提示字元 D:\xampp\mysql\bin\mysql -umememe -p

````
USE test0329;

CREATE TABLE moneybook (
  m_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200),
  cost INT
) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
````
