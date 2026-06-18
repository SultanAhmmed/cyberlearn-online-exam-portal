```python
with open("README.md", "w") as f:
    f.write('''# Deliberately Insecure Web Application (Educational Laboratory)

## Overview
This is a deliberately insecure web application built in PHP for educational purposes. It demonstrates common web vulnerabilities including SQL Injection (both String-based and Integer-based) and Cross-Site Scripting (both Reflected and Stored). 

**WARNING:** Use *only* in a controlled lab environment (e.g., Kali Linux inside `/var/www/html/`). All code is intentionally insecure—do not deploy publicly.

## File Structure
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

## Setup Instructions

1. Place all repository files in `/var/www/html/online_exam/`.
2. Import the database schema and user configurations (MySQL root password may be required):
```bash
mysql -u root -p < setup.sql

```


If you use `sudo mysql` without a password, run:
```bash
sudo mysql < setup.sql

```


3. Update `db.php` with the correct database credentials if needed (pre-configured credentials are `sultan` / `sultan123`).
4. Start the Apache web server and MySQL database service:
```bash
sudo systemctl start apache2
sudo systemctl start mysql

```


5. Access the local deployment portal at:
[http://localhost/online_exam/](https://www.google.com/search?q=http://localhost/online_exam/)

## Vulnerable Pages Reference

| Page | Vulnerability | How to Test / Payload |
| --- | --- | --- |
| `admin_login.php` | String-based SQL Injection | Enter `admin' OR '1'='1` as the username + any password. |
| `student.php?id=1` | Integer-based SQL Injection | Navigate to `?id=1 OR 1=1` to display all student records. |
| `search.php?q=test` | Reflected XSS | Input payload into search: `?q=<script>alert(1)</script>` |
| `exam_comments.php?exam_id=1` | Stored XSS | Post a comment containing: `<script>alert(1)</script>`. *Note: Refresh the comments page after posting to see the script execute.* |

## Demonstrating Automated Exploitation via SQLMap

### 1. String-based Injection (Admin Login)

```bash
sqlmap -u "http://localhost/online_exam/admin_login.php?username=admin&password=test" --data="username=admin&password=test" -p username --dbms=mysql

```

### 2. Integer-based Injection (Student Details)

```bash
sqlmap -u "http://localhost/online_exam/student.php?id=1" -p id --dbms=mysql

```

## Additional Notes

* The dedicated database user credentials `sultan / sultan123` are automatically provisioned by the `setup.sql` script.
* Happy hacking! (Ethically, of course.)
''')
