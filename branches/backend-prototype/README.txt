add a virtual host in the httpd.conf

<VirtualHost *:80>
  ServerName uninformed.lo
  DocumentRoot "/Applications/XAMPP/htdocs/uninformed/trunk/web"
  DirectoryIndex index.php
  <Directory "/Applications/XAMPP/htdocs/uninformed/trunk/web">
    AllowOverride All
    Allow from All
  </Directory>

  Alias /sf /Applications/XAMPP/htdocs/uninformed/trunk/lib/vendor/symfony/data/web/sf
  <Directory "/Applications/XAMPP/htdocs/uninformed/trunk/lib/vendor/symfony/data/web/sf">
    AllowOverride All
    Allow from All
  </Directory>
</VirtualHost>

add the host to the hosts file
127.0.0.1       uninformed.lo

check out the source:
svn checkout http://uninformed.googlecode.com/svn/trunk/ uninformed-read-only

create a "uninformed" database

other than MySQL:
php symfony doctrine:build-sql

php symfony doctrine:insert-sql

php symfony doctrine:data-load //load example data