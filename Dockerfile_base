# Usa la imagen oficial ya construida, no intentes construirla desde "scratch"
FROM ubuntu:22.04



# Aquí instalas lo que necesites para tu proyecto
RUN apt-get update && apt-get install -y \
    wget \
    curl \
    libnss3 \
    && rm -rf /var/lib/apt/lists/*

# Instalación lampp
RUN curl -X GET "https://deac-fra.dl.sourceforge.net/project/xampp/XAMPP%20Linux/8.2.4/xampp-linux-x64-8.2.4-0-installer.run?viasf=1" -o /opt/xampp.run

RUN chmod +x /opt/xampp.run && \
    /opt/xampp.run --mode unattended && \
    rm /opt/xampp.run

# Añadir el directorio bin del lampp al PATH

ENV PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/opt/lampp/bin"
  

# Comando por defecto
CMD ["/bin/bash"]

