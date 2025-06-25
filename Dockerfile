# Menggunakan base image PHP FPM dengan versi yang sesuai
FROM php:8.2-fpm-alpine 
# Atau versi PHP yang Anda gunakan (misalnya php:8.1-fpm-alpine)

# Instal ekstensi PHP yang dibutuhkan oleh CodeIgniter
# PASTIKAN 'mysqli' ADA DI SINI!
RUN docker-php-ext-install pdo pdo_mysql mysqli opcache \
    && docker-php-ext-enable opcache

# Menginstal Composer (opsional, jika Anda menggunakan Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Mengatur working directory di dalam container
WORKDIR /var/www/html

# Menyalin semua file proyek Anda ke dalam container
COPY . .

# Pastikan folder cache CodeIgniter bisa ditulis
# Sesuaikan path jika Anda memindahkan folder cache CI3
RUN chown -R www-data:www-data application/cache \
    && chown -R www-data:www-data application/logs \
    && chmod -R 775 application/cache \
    && chmod -R 775 application/logs

# Menginstal dependensi Composer jika ada (misalnya: spark-packages/codeigniter-restserver)
# RUN composer install --no-dev --optimize-autoloader

# Mengekspos port PHP-FPM
EXPOSE 9000

# Perintah default (bisa dikosongkan karena akan dikelola oleh PHP-FPM)
CMD ["php-fpm"]