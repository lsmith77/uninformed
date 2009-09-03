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

# FOR ALL USERS (NOT ONLY FRESH CHECKOUTS)
# IF YOU HAD A PREVIOUS VERSION (before rev27) RUNNING, I RECOMMEND TO:

- delete all generated files from lib/form, lib/filter, lib/model
- delete all backend modules
- php symfony doctrine:build-all-reload
- create backend modules (see database yaml for names)
- php symfony cc

So far (r32) no folder lib/ or apps/ has been committed since r26. After r26
the database YAML was restructured.