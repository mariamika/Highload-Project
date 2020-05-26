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