#
# PHP Deps
#
FROM composer:1.8 as vendor

LABEL maintainer="adam.jarvis2012@gmail.com"

COPY database/ database/

COPY composer.json composer.json
COPY composer.lock composer.lock

WORKDIR /app

RUN composer install \
	--ignore-platform-reqs \
	--no-interaction \
	--no-plugins \
	--no-scripts \
	--prefer-dist

#
# Frontend
#
FROM node:8.15 as frontend

RUN mkdir -p /app/public

COPY package.json webpack.mix.js /app/
COPY resources/js/ /app/resources/js/
COPY resources/sass/ /app/resources/sass/

WORKDIR /app

RUN npm install && npm run development

#
# Application code
#
FROM php:7.2-apache-stretch

RUN mkdir -p /srv/www/charlog

COPY . /srv/www/charlog
COPY --from=vendor /app/vendor/ /srv/www/charlog/vendor/
COPY --from=frontend /app/public/js/ /srv/www/charlog/public/js/
COPY --from=frontend /app/public/css/ /srv/www/charlog/public/css/
COPY --from=frontend /app/mix-manifest.json /srv/www/charlog/mix-manifest.json

COPY .docker/vhost.conf /etc/apache2/sites-available/001-charlog.conf

RUN docker-php-ext-install pdo \
    pdo_mysql json ctype tokenizer bcmath

RUN chown -R www-data:www-data /srv/www/charlog \
	&& a2enmod rewrite \
	&& a2ensite 001-charlog.conf \
	&& a2dissite 000-default.conf
