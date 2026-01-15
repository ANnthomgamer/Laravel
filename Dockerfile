# Usa la imagen oficial ya construida, no intentes construirla desde "scratch"
FROM ubuntu:22.04


# PATH
ENV PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"



# Aquí instalas lo que necesites para tu proyecto
RUN apt-get update && apt-get install -y \
    wget \
    curl \
    libnss3 \
    iproute2 \
    && rm -rf /var/lib/apt/lists/*

# Instalación lampp
RUN curl -X GET "https://deac-fra.dl.sourceforge.net/project/xampp/XAMPP%20Linux/8.2.4/xampp-linux-x64-8.2.4-0-installer.run?viasf=1" -o /opt/xampp.run

RUN chmod +x /opt/xampp.run && \
    /opt/xampp.run --mode unattended && \
    rm /opt/xampp.run


# Añadir el directorio bin del lampp al PATH
ENV PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/opt/lampp/bin"

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar bin/composer


# Crear proyecto
WORKDIR /opt/lampp/htdocs
RUN composer create-project --prefer-dist laravel/laravel Tienda
WORKDIR /opt/lampp/htdocs/Tienda

 
# Crear plantilla
WORKDIR /opt/lampp/htdocs/Tienda/resources/views
RUN mkdir layouts
WORKDIR /opt/lampp/htdocs/Tienda/resources/views/layouts
RUN <<EOF  cat >  /opt/lampp/htdocs/Tienda/resources/views/layouts/app.blade.php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
EOF


EXPOSE 8000

# Comando por defecto
CMD ["/bin/bash"]
# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
