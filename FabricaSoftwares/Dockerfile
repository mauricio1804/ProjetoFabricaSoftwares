# Esse Dockerfile define como será montado o container da nossa
# aplicação php. Para mais informações sobre como esse arquivo
# funciona consulte a documentação em: https://docs.docker.com/reference/dockerfile/

# Criando uma variável de ambiente chamada username com valor coloque_seu_nome
# https://docs.docker.com/reference/dockerfile/#arg
ARG username=Mauricio

# Utilizando a imagem do docker hub do php 8.2
# https://docs.docker.com/reference/dockerfile/#from
FROM php:8.2-fpm

# Usando a variável de ambiente username definida acima
# https://docs.docker.com/reference/dockerfile/#user
USER $username 

# Rodando comando apt-get update do Linux para fazer atualização dos
# repositórios e posibilitar a instalação de outros pacotes com apt-get install
# https://docs.docker.com/reference/dockerfile/#run
RUN apt-get update \
    && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Usando um script da própria imagem para instalar algumas extensões
RUN docker-php-ext-install pdo_mysql mbstring mysqli gd bcmath

# Instalando o composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Expondo a aplicação na porta 9999 do container
# https://docs.docker.com/reference/dockerfile/#expose
CMD php artisan serve --host=0.0.0.0 --port=90
EXPOSE 90
