FROM tangramor/nginx-php8-fpm:latest

WORKDIR /var/www/html/

COPY . /var/www/html/

EXPOSE 80

CMD ["/usr/bin/supervisord"]
