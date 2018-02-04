## 附录C MySQL语句的语法


### 阅读语法, 约定如下:
    * `|` 符号用来指出几个选择中的一个，因此，`NULL | NOT NULL` 表示或者给出NULL 或者 给出NOT NULL;

    * 包含在方括号中的关键字或子句（如 `[like this]` ）是可选的;

    * 既没有列出所有的 MySQL 语句，也没有列出每一条子句和选项.


### 1. ALTER TABLE
* `ALTER TABLE` 用来更新已存在表的模式:

```mysql
ALTER TABLE tablename
(
    ADD     column              dtatype     [NULL|NOT NULL] [CONSTRAINTS],
    CHANGE  column, columns     dtatype     [NULL|NOT NULL] [CONSTRAINTS],
    DROP    column,
    ...
)
```


### 2. COMMIT
* COMMIT 用来将事务处理写到数据库。详细信息请参阅第26章


### 3. CREATE INDEX
* CREATE INDEX 用于在一个或多个列上创建索引。详细请参阅第21章

``` mysql
CREATE INDEX indename 
ON tablename (column [ASC|DESC], ...)
```


### 4. CREATE PROCEDURE
* CREATE PROCEDURE用于创建存储过程。详细信息请参阅第23章

```mysql
CREATE PROCEDURE procedurename( [parameters] )
BEGIN
    ...
END;
```


### 5. CREATE TABLE
* CREATE TABLE 用于创建新数据库表

```mysql
CREATE TABLE tablename
(
    column      dtatype     [NULL|NOT NULL] [CONSTRAINTS],
    ...
)
```


### 6. CREATE USER
* CREATE USER 用于向系统中添加新的用户账户

```mysql
CREATE USER username[@hostname]
[IDENTIFIED BY [PASSWORD] 'password];
```


### 7. CREATE VIEW
* CREATE VIEW 用来创建一个或多个表上的新视图. 详细信息请参阅第
22章。

```mysql
CREATE [OR REPLACE] VIEW viewname
AS
SELECT ...;
```


### 8. DELETE
* DELETE 从表中删除一行或多行。详细信息请参阅第20章。

```mysql
DELETE FROM tablename
[WHERE ...];
```


### 9. DROP
* DROP 永久地删除数据库对象（表、视图、索引等）。详细信息请参阅第21、22、23和第24章。

```mysql
DROP DATABASE|INDEX|PROCEDURE|TABLE|TRIGGER|USER|VIEW
    itemname;
```


### 10. INDSERT
* INSERT 给表增加一行。详细信息请参阅第19章。    

```mysql
INSERT INTO tablename [(columns, ...)]
VALUES(values, ...)
```


### 11. INSERT SELECT
* INSERT SELECT 插入 SELECT 的结果到一个表。详细信息请参阅第19章。

```mysql
INSERT INTO tablename [(columns, ...)]
SELECT columns, ... FROM tablename, ...
[WHERE ...];
```


### 12. ROLLBACK
* ROLLBACK 用于撤销一个事务处理块。详细信息请参阅第26章

```mysql
ROLLBACK [ TO savepintname];
```


### 13. SAVEPOINT
* SAVEPOINT 为使用 ROLLBACK 语句设立保留点。详细信息请参阅第26章。

```mysql
SAVEPOINT spl;
```


### 14. SELECT
* SELECT 用于从一个或多个表（视图）中检索数据。更多的基本信息，请参阅第4、5和第6章（第4～17章都与 SELECT 有关）。

```mysql
SELECT columnname, ...
FROM tablename, ...
[WHERE ...]
[UNIOIN ...]
[GROUP BY ...]
[HAVING ...]
[ORDER BY ...];
```


### 15. START TRANSACTION
* START TRANSACTION 表示一个新的事务处理块的开始。详细信息请参阅第26章。

```mysql
START TRANSACTION;
```


### 16. UPDATE
* UPDATE 更新表中一行或多行。详细信息请参阅第20章。

```mysql
UPDATE tablename
SET columname = value, ...
[WHERE ...];
```
