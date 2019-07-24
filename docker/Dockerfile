FROM php:7.3.7-fpm
RUN apt-get update && apt autoremove -y && apt-get install -y \
		libjpeg62-turbo-dev \
		libpng-dev \
    && docker-php-ext-install -j$(nproc) mysqli \
    && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd bcmath pdo pdo_mysql \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && touch /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_file_uploads = 1000;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 32M;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "track_errors = On;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 32M;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "date.timezone = Asia/Almaty" >> /usr/local/etc/php/conf.d/custom.ini