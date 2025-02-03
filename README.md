para executar o laravel pulse
./vendor/bin/sail shell
sail shell
apt-get update && apt-get install -y libmysqlclient-dev
docker-php-ext-install pdo_mysql
sail restart
sail artisan pulse:restart