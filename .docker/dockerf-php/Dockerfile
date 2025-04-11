FROM php:8.4.5-fpm


RUN apt-get update && apt-get install -y \
    git \
    curl \
    default-libmysqlclient-dev\
    libmariadb-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql ctype fileinfo  zip && \
    rm -rf /var/lib/apt/lists/*



RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    ctype \
    fileinfo


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

COPY ./src /var/www/html

WORKDIR /var/www/html

EXPOSE 9000

CMD [ "php", "-S", "0.0.0.0:80", "-t", "/var/www/html/public" ]
