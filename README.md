# Desafio Desenvolvedor Web Backend Pleno/Sênior CONVICTI

Este projeto tem como objetivo cumprir
com todos os requisitos de um sistema de vendas proposto pela empresa
CONVICTI.

## Documentação da api

[Link Documentação](https://documenter.getpostman.com/view/2153586/2s8ZDX4NXX)

Para que o projeto funcione em sua maquina, é necessário que tenha o Docker instalado
e também o Docker Compose.

Tutorial de instalação do Docker e do Docker Compose para ubuntu 22.04

Docker:https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-22-04

Docker Compose: https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-22-04

# OBSERVAÇÂO

-   Existe um middleware que verifica se um vendedor esta logado por um dispositivo mobile. Esta verificação é um dos requisitos que estavam fora de escopo, mas para fins de teste, se alterar a variavel do seu .env APP_DEBUG=true para APP_DEBUG=false, este middleware passara a funcionar e caso você tente acessar a url de vendas logado com um vendedor, você sera deslogado imediatamente.
-   Todas as variaveis e requisições foram colocadas em inglês, como isso não estava definido nos requisitos, realizei toda a confecção do sistema na linguagem inglês.
-   Há um arquivo no diretório raiz do projeto que é um export gerado pelo postman, caso queira importar para testes, o arquivo é este:

```bash
  api.postman_collection.json
```

## Instalação

Clone o repositório com o comando a seguir:

```bash
  git clone https://github.com/CristianBernardes/desafio-convicti.git
```

Abra a pasta do projeto com o comando:

```bash
  cd desafio-convicti
```

Copie o arquivo .env.example para .env com o seguinte comando:

```bash
  cp .env.example .env
```

Supondo que você tem o docker e o docker compose1 instalados em sua maquina, inicie os containers com o comando a seguir:

```bash
docker compose up -d
```

Após iniciar o containers, execute o seguinte comando para conectar ao container via ssh:

```bash
docker exec -it desafio-app bash
```

Já dentro do container do app, execute o seguinte comando para instalar todas as dependencias:

```bash
composer install
```

Ainda dentro do container, execute os seguintes comandos para executar as migrations com os seeders e realizar alguns testes unitarios:

```bash
php artisan migrate --seed && php artisan test
```

Este comando ira popular a base de dados com os dados necessários e realizar testes para validar se esta tudo ok!
