## Installation
1. Install XAMPP
2. edit in php.ini
	- memory_limit=256M
	- upload_max_filesize=20M
	- post_max_size=20M
3. start/ stop apache
4. goto http://localhost/phpmyadmin
5. Create database name "forth_medical"
	import forth_medical.sql
		- wait ............
6. add vhost in C:\xampp\apache\conf\extra\httpd-vhosts.conf

`NameVirtualHost *
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot [GIT]/appweb
    <Directory "[GIT]/appweb/">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
    DirectoryIndex index.html index.php
</VirtualHost>`  
then restart apache

3. Run web http://localhost


## DataTable doc
	https://datatables.net/reference/api/
