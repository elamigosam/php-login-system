FROM php:7.4-apache

#enable .htaccess 
RUN a2enmod rewrite
RUN service apache2 restart
ADD . /var/www/html

# Install mysqli driver. 
RUN docker-php-ext-install mysqli

#Install PDO Driver
RUN docker-php-ext-install mysqli pdo pdo_mysql

#COPY ./app /var/www/html/

#used to diplay nice error messages. 
RUN pecl install xdebug && docker-php-ext-enable xdebug

# And clean up the image
RUN rm -rf /var/lib/apt/lists/*