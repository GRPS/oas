FROM ovalbsol/edgecumbe

# Configuration for Apache
RUN rm -rf /etc/apache2/sites-enabled/000-default.conf
ADD build/000-default.conf /etc/apache2/sites-available/
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/
RUN a2enmod rewrite

# EXPOSE 80
EXPOSE 443

# Change website folder rights and mount directory
RUN chown -R www-data:www-data /var/www/html
ADD ./ /var/www/html


# FROM ovalbsol/oas
#
# RUN pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && sed -i '1 a xdebug.remote_autostart=1' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && sed -i '1 a xdebug.remote_mode=req' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && sed -i '1 a xdebug.remote_handler=dbgp' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && sed -i '1 a xdebug.remote_connect_back=1' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && sed -i '1 a xdebug.remote_port=9000' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && sed -i '1 a xdebug.remote_enable=1' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && sed -i '1 a xdebug.idekey=PHPSTORM' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && sed -i '1 a xdebug.remote_host=172.17.0.2' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

##Start CRON JOBS
RUN echo "deb [check-valid-until=no] http://archive.debian.org/debian jessie-backports main" > /etc/apt/sources.list.d/jessie-backports.list
RUN sed -i '/deb http:\/\/deb.debian.org\/debian jessie-updates main/d' /etc/apt/sources.list
RUN apt-get -o Acquire::Check-Valid-Until=false update

RUN apt-get install cron -y
ADD ./crontab /etc/cron.d/application-cron
RUN echo >> /etc/cron.d/application-cron && crontab -u root /etc/cron.d/application-cron
RUN rm -f /var/run/crond.pid && cron

RUN apt-get install -y supervisor

COPY supervisord.conf /etc/supervisord.conf
CMD ["/usr/bin/supervisord"]