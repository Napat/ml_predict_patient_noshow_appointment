## เป้าหมาย  
    เริ่มต้นเรียนรู้ DataTable เพื่อใช้กับงานต่าง ๆ ต่อไปในอนาคตอันใกล้และไกล เพื่อท้องฟ้าที่สดใส   
    - jQuery   
    - AJAX  
    - SQL   
## Installation  
1. Install [XAMPP](https://www.apachefriends.org/)  
2. Config apache and PHP  
    2.1 edit C:\xampp\php\php.ini  
	- memory_limit=256M
	- upload_max_filesize=20M
	- post_max_size=20M

    2.2 add vhost in C:\xampp\apache\conf\extra\httpd-vhosts.conf
```
NameVirtualHost *
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot [project dir]/webapp
    <Directory "[project dir]/webapp/">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
    DirectoryIndex index.html index.php
</VirtualHost>
```

3. start apache and mysql from XAMPP Control panel  
4. goto [http://localhost/phpmyadmin](http://localhost/phpmyadmin)  
5. Create database   
    5.1 Create database name "forth_medical" with COLLATION utf8mb4_unicode_ci  
    5.2 import forth_medical.sql to forth_medical (Wait 2 minutes)  
6. Run web [http://localhost](http://localhost)  
    if everythings is OK, you will see 200 medical records   

## DataTable doc
	https://datatables.net/reference/api/
