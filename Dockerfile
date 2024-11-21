# Use a lightweight PHP image as the base
FROM php:8.2-fpm-alpine

# Set the working directory
WORKDIR /app

# Copy the Laravel application files
COPY . .

# Install dependencies
RUN composer install --no-interaction --no-ansi --no-progress

# Expose the PHP-FPM port
EXPOSE 9000

# Start the PHP-FPM process
CMD ["php-fpm"]