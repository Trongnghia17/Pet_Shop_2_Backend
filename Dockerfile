# Sử dụng PHP 8.2 với Alpine Linux
FROM php:8.2-fpm

# Cài đặt các extension PHP cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài đặt Node.js và npm nếu sử dụng Vite
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copy mã nguồn Laravel vào container
WORKDIR /var/www
COPY . .

# Cấp quyền cho storage và bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Cài đặt Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port 9000 để PHP-FPM hoạt động
EXPOSE 9000

# Lệnh chạy mặc định khi container khởi động
CMD ["php-fpm"]

