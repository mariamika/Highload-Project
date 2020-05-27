## Устанавливаем Percona

```
[root@localhost ~]# yum install https://repo.percona.com/yum/percona-release-latest.noarch.rpm
Loaded plugins: fastestmirror
percona-release-latest.noarch.rpm                       |  17 kB     00:00
...
...
...

Installed:
  percona-release.noarch 0:1.0-18

Complete!

[root@localhost ~]# percona-release setup ps80
* Disabling all Percona Repositories
* Enabling the Percona Server 8.0 repository
* Enabling the Percona Tools repository
<*> All done!

[root@localhost ~]# yum install percona-server-server
Loaded plugins: fastestmirror
Loading mirror speeds from cached hostfile
...
...
Installed:
  percona-server-server.x86_64 0:8.0.19-10.1.el7
  percona-server-shared-compat.x86_64 0:8.0.19-10.1.el7

Dependency Installed:
  libaio.x86_64 0:0.3.109-13.el7
  percona-server-client.x86_64 0:8.0.19-10.1.el7
  percona-server-shared.x86_64 0:8.0.19-10.1.el7

Replaced:
  mariadb-libs.x86_64 1:5.5.65-1.el7

Complete!
```

## Импортируем БД

```[root@localhost ~]# mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 9
Server version: 8.0.19-10 Percona Server (GPL), Release 10, Revision f446c04

Copyright (c) 2009-2020 Percona LLC and/or its affiliates
Copyright (c) 2000, 2020, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.


mysql> CREATE DATABASE skytech;
Query OK, 1 row affected (0.00 sec)

mysql> USE skytech;
Database changed
mysql> source /vagrant/db.sql
Query OK, 0 rows affected (0.00 sec)

Query OK, 0 rows affected, 1 warning (0.00 sec)

Query OK, 0 rows affected (0.00 sec)
...
...

```

## Имтортируем explain_models

```
mysql> CREATE DATABASE office_module;
Query OK, 1 row affected (0.01 sec)

mysql> USE office_module;
Database changed
mysql> source /vagrant/explain_models.sql
Query OK, 0 rows affected, 1 warning (0.01 sec)

Query OK, 0 rows affected, 2 warnings (0.00 sec)
...
...

```

## Импортируем explain_models_patch_1

```
mysql> source /vagrant/explain_models_patch_1.sql
Query OK, 122 rows affected (0.02 sec)
Records: 122  Duplicates: 0  Warnings: 0

Query OK, 23 rows affected (0.01 sec)
Records: 23  Duplicates: 0  Warnings: 0
...
...

```

## Импортируем explain_models_patch_2

```
mysql> source /vagrant/explain_models_patch_2.sql
Query OK, 110 rows affected, 1 warning (0.02 sec)
Records: 110  Duplicates: 0  Warnings: 1

Query OK, 109 rows affected, 1 warning (0.01 sec)
Records: 109  Duplicates: 0  Warnings: 1
...
...

```

## что нужно делать, чтобы не увеличивать количество запросов на сервере

* оптимизировать запросы и для кэша в том числе
* использовать `EXPLAIN` для запросов `SELECT`
* использовать `LIMIT 1`, если нужно получить уникальную строку
* индексировать поля поиска
* индексировать и использовать одинаковый тип для связываемых столбцов
* не использовать `ORDER BY RAND()`
* стараться не использовать `SELECT *`
* стараться использовать поле `id` везде
* использовать `ENUM` вместо `VARCHAR`
* изучить предложения `PROCEDURE ANALYSE()`
* использовать `NOT NULL`, если это возможно
* использовать подготовленные выражения
* таблицы с фиксированной длиной записи (Static) работают быстрее
* разделять большие запросы `DELETE` или `INSERT`
* маленькие столбцы обрабатываются быстрее
* выбирать правильный механизм хранения данных (MyISAM или InnoDB)