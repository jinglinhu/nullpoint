# Wallet Laravel

## Nginx
	brew install nginx

	sudo nginx 
    sudo nginx -s stop|reload

    vim /usr/local/etc/nginx/conf.d/xxx.conf

    server {
            listen       80;
            server_name  xxxx.xxxxx.xxx;
            root /code_dir_replace/public;

            location /{
                index index.php;
                try_files $uri $uri/ /index.php?$query_string;
           }
            location ~ \.php$ {
                include /usr/local/etc/nginx/fastcgi.conf;
                fastcgi_intercept_errors on;
                fastcgi_pass   127.0.0.1:9000;
            }
        }

## PHP
	brew install php71 \
    --without-snmp \
    --without-apache \
    --with-debug \
    --with-fpm \
    --with-intl \
    --with-homebrew-curl \
    --with-homebrew-libxslt \
    --with-homebrew-openssl \
    --with-imap \
    --with-mysql \
    --with-tidy

    brew services start|stop|restart php71

## Laravel
	1.composer install 
	2.php artisan migrate 

## Admin Module

	http://domain.com/admin/xxxx
	集成Rbac权限及开发者工具

## Web Module
	
	http://domain/

## Api Module

	http://domain.com/api/xxxx
	基于jwt token验证

```
{
    "status_code": 200,
    "message": "success",
    "data": {
       xxxxxxxxxxx
    }
}
```

## API List
- user
	- [register](#register)
	- [login](#login)
	- [info](#info)
	- [logout](#logout)

