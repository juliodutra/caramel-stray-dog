# Sidewalk Donations Platform

## Setup Instructions
1. Clone repository
2. Run `composer install`
3. Configure database in `config/app_local.php`
4. Run migrations: `bin/cake migrations migrate`
5. Configure OAuth providers

## Requirements
- PHP 8.1+
- MySQL 8.0+
- Composer
- OAuth App Credentials

## Features
- Donation posting
- Geolocation-based discovery
- OAuth authentication
- Pickup verification system

## LINUX installation
**Requirements:**

- Linux server (Ubuntu/Debian recommended)
- PHP 8.1+
- Composer
- MySQL 8.0+
- Apache/Nginx
- Git

### Installation Steps:
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install dependencies
sudo apt install -y php php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-bcmath

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install MySQL
sudo apt install -y mysql-server
sudo mysql_secure_installation

# Clone CakePHP project
git clone https://github.com/your-username/sidewalk-donations.git
cd sidewalk-donations

# Install project dependencies
composer install

# Configure database
mysql -u root -p
> CREATE DATABASE sidewalk_donations;
> CREATE USER 'sidewalk_user'@'localhost' IDENTIFIED BY 'strong_password';
> GRANT ALL PRIVILEGES ON sidewalk_donations.* TO 'sidewalk_user'@'localhost';
> FLUSH PRIVILEGES;
> EXIT;

# Configure environment
cp config/app_local.example.php config/app_local.php
Edit database credentials in app_local.php

# Run database migrations
bin/cake migrations migrate

# Set proper permissions
sudo chown -R www-data:www-data /path/to/sidewalk-donations
sudo chmod -R 755 /path/to/sidewalk-donations

# Apache configuration (/etc/apache2/sites-available/sidewalk-donations.conf)
<VirtualHost *:80>
    ServerName donations.yourdomain.com
    DocumentRoot /path/to/sidewalk-donations/webroot
    
    <Directory /path/to/sidewalk-donations/webroot>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

# Enable site and restart
sudo a2ensite sidewalk-donations
sudo systemctl restart apache2
```

### Security Recommendations:

- Use HTTPS
- Configure OAuth securely
- Implement rate limiting
- Use strong, unique passwords
- Regular security updates

### Testing:
```bash
# Run unit tests
bin/cake test
```

### Check code quality
```bash
composer require --dev cakephp/cakephp-codesniffer
vendor/bin/phpcs src
```
### OAuth Setup:

- Register app on Google/Facebook Developer Consoles
- Configure client IDs in `config/oauth.php`
- Install OAuth plugin: `composer require league/oauth2-client`