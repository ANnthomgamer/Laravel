#  Laravel - Implantación de Aplicaciones Web

Este repositorio contiene el trabajo práctico para la asignatura de **Implantación de Aplicaciones Web**, enfocado en el despliegue y gestión de entornos Laravel.

---
##  Índice
1. [Dependencias](#dependencias)
   - [Instalación de Docker en Ubuntu](#instalación-de-docker-en-ubuntu)
   - [Instalación de Docker en RHEL](#instalación-de-docker-en-rhel)
2. [Guía de Uso y Despliegue](#guía-de-uso-y-despliegue)
   - [1. Descargar Dockerfile (Recomendado)](#1-descargar-dockerfile-recomendado)
   - [Crear imagen a partir del Dockerfile](#crear-imagen-a-partir-del-dockerfile)
   - [Construir y levantar el entorno](#construir-y-levantar-el-entorno)



## Dependencias
### [Instalación de docker en Ubuntu](https://docs.docker.com/engine/install/ubuntu/)
Instalación de docker en ubuntu
```bash
# Add Docker's official GPG key:
sudo apt update
sudo apt install ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

# Add the repository to Apt sources:
sudo tee /etc/apt/sources.list.d/docker.sources <<EOF
Types: deb
URIs: https://download.docker.com/linux/ubuntu
Suites: $(. /etc/os-release && echo "${UBUNTU_CODENAME:-$VERSION_CODENAME}")
Components: stable
Signed-By: /etc/apt/keyrings/docker.asc
EOF

sudo apt update
```

```bash
 sudo apt install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

```bash
 sudo groupadd docker
```

```bash
 sudo usermod -aG docker $USER
```

```bash
sudo systemctl enable docker
```

### [Instalación de docker en RHEL](https://docs.docker.com/engine/install/rhel/)

Instalar plugins DNF y añadir repositorio
```bash
 sudo dnf -y install dnf-plugins-core
 sudo dnf config-manager --add-repo https://download.docker.com/linux/rhel/docker-ce.repo
```

Instalar la ultima  version de docker
```bash
 sudo dnf install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

Habilitar el servicio
```bash
 sudo systemctl enable --now docker
```

Añadir grupo de docker para poder usarlo en el usuario
```bash
 sudo groupadd docker
```

```bash
 sudo usermod -aG docker $USER
```


##  Guía de Uso y Despliegue

Puedes utilizar este proyecto de varias formas, dependiendo de si quieres el código fuente completo o solo los archivos de configuración para Docker.

### 1. Descargar Dockerfile (Recomendado)
Ideal si quieres trabajar directamente sobre el código o ver el historial de cambios.

``` bash
wget [https://github.com/ANnthomgamer/Laravel/blob/main/Dockerfile](https://raw.githubusercontent.com/ANnthomgamer/Laravel/refs/heads/main/Dockerfile/Dockerfile)
```

#### Crear imagen a partir del Dockerfile

```bash
docker build -t laravel_juangial .
```

#### Construir y levantar el entorno
Posteriormente,  lanzar el contenedor desde la imagen recientemente creada


