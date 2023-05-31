#### Todo #####

## Authenticate
    - Integrate with Google
    - Integrate with Facebook
    - Integrate with Telegram

## Payment & Booking
    - Integrate With ABA
    - Send Invoice & Reciept

## User Dashboard
    - Booking tracking
    - Logout
## Rooms, Tourism
    - Filter function

## Deploy

sudo apt-get update
sudo apt-get install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get install php8.1 php8.1-mbstring php8.1-gettext php8.1-zip php8.1-fpm php8.1-curl php8.1-mysql php8.1-gd php8.1-cgi php8.1-soap php8.1-sqlite3 php8.1-xml php8.1-redis php8.1-bcmath php8.1-imagick php8.1-intl -y

sudo apt-get install git composer -y

### Configure Nginx for Laravel
 sudo nano /etc/nginx/sites-available/sitename.conf

server {
    listen 80;
    server_name site-name.com;
    root /var/www/html/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}

 sudo ln -s /etc/nginx/sites-available/sitename.conf /etc/nginx/sites-enabled/sitename.conf

 sudo systemctl restart nginx

 ## Google
http://bookteletours.com

GOOGLE_CLIENT_ID="935459284602-lcb0jc13sv5fbk1e8in9ns3mr3ojgg6j.apps.googleusercontent.com"
GOOGLE_CLIENT_SECRET="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"
GOOGLE_REDIRECT_URI="http://bookteletours.com/auth/google/callback"

## Facebook
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URI=

## Telegram
TELEGRAM_BOT_NAME=
TELEGRAM_TOKEN=
TELEGRAM_REDIRECT_URI=

# ABA
ABA_PAYWAY_API_CHECKOUT_URL='https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase'
ABA_PAYWAY_API_CHECKOUT_STATUS_URL='https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/check-transaction'
ABA_PAYWAY_API_KEY='23067516389ac2ffda22d459419164712b2ad1ce'
ABA_PAYWAY_MERCHANT_ID='ec376230'
