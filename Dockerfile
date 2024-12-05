FROM php:8.2-fpm

# Instalações necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Configurar diretório do projeto
WORKDIR /var/www

# Copiar arquivos para o container
COPY . .

# Instalar dependências do Composer e npm
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Definir permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Porta para o PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
