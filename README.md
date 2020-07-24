# moodle-on-azure

This exercise supports:

MariaDB: 10.5.4
MySQL: 5.7
Moodle: 3.9.1 (3-debian-10)

Steps:

1. Create database and user in database (mysql or mariadb) then assign permissions.

create database moodledb;
grant all on moodledb.* to moodleuser@'%' identified by "Password.123";
flush privileges;

2. Configure docker-compose file.

3. Run docker-compose file.