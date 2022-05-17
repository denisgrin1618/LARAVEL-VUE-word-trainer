FROM nginx:alpine

RUN rm /etc/nginx/conf.d/default.conf
# COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./conf.d/laravel.conf /etc/nginx/conf.d/laravel.conf
# COPY ./certs/ /etc/nginx/certs/
# COPY ./.htpasswd /etc/nginx/.htpasswd

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]