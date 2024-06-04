FROM nginx:stable-alpine

ADD ./nignx/conf.d/app.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/html