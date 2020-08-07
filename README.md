# moodle-on-azure

This exercise supports:

- MariaDB: 10.5.4
- MySQL: 5.7
- Moodle: 3.9.1 (3-debian-10)

Steps:

1. Create database and user in database (mysql or mariadb) then assign permissions.
https://docs.moodle.org/39/en/Installation_quick_guide

```
CREATE DATABASE moodle DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL ON moodle.* TO 'moodleuser'@'%' IDENTIFIED BY 'Password.123';
flush privileges;
```

2. Configure docker-compose file or AKS helm chart command.

3. Run docker-compose file or AKS helm chart command.
