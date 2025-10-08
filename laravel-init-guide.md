## Guía rápida: instalar y comenzar un proyecto Laravel desde cero

Este documento recoge un manual de instalación y una lista completa de comandos útiles para crear, configurar y ejecutar un proyecto Laravel desde cero en un entorno típico de desarrollo (Windows). Está pensado para estudiantes y desarrolladores que comienzan con Laravel.

### Requisitos previos

- PHP 8.1 o superior (ver versión recomendada en la documentación de la versión de Laravel que vayas a usar).
- Composer (https://getcomposer.org)
- Git
- SQLite, MySQL o PostgreSQL (según prefieras) — para desarrollo se puede usar SQLite sin instalación adicional.
- Node.js + npm (para assets: Vite, Tailwind u otras dependencias)

Si usas Windows, recomendamos usar la terminal PowerShell o WSL (Windows Subsystem for Linux). Muchos desarrolladores prefieren WSL para evitar problemas de permisos y compatibilidad.

---

## Manual de instalación (paso a paso)

1) Instalar PHP

- En Windows puedes usar las builds de windows.php.net, XAMPP, Laragon o usar WSL con una distribución Linux.
- Confirma la versión en la terminal:

  php -v

2) Instalar Composer

- Sigue las instrucciones en https://getcomposer.org/download/
- Verifica:

  composer --version

3) Instalar Node.js y npm

- Descarga desde https://nodejs.org/ o usa nvm/nvm-windows.
- Verifica:

  node --version
  npm --version

4) (Opcional) Instalar Git

- Verifica:

  git --version

5) Crear el proyecto Laravel

Hay dos formas comunes: usar Composer create-project o el instalador de Laravel.

- Con Composer (recomendado):

  composer create-project laravel/laravel nombre-proyecto

- Con el instalador global de Laravel:

  composer global require laravel/installer
  laravel new nombre-proyecto

6) Entrar al directorio del proyecto

  cd nombre-proyecto

7) Instalar dependencias de Node (assets)

  npm install

8) Configurar variables de entorno

- Copia .env.example a .env:

  copy .env.example .env    # PowerShell

- Genera la clave de la aplicación:

  php artisan key:generate

- Configura la conexión a base de datos en `.env` (DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD). Para SQLite, crea el archivo y apunta la ruta:

  # ejemplo .env para sqlite
  DB_CONNECTION=sqlite
  DB_DATABASE="${PWD}\\database\\database.sqlite"

  # crear el archivo sqlite
  New-Item -ItemType File -Path .\database\database.sqlite

9) Ejecutar migraciones y seeders (si existieran)

  php artisan migrate
  php artisan db:seed    # opcional

10) Ejecutar servidor de desarrollo

  php artisan serve

11) Ejecutar el builder de assets (Vite)

  npm run dev

---

## Comandos útiles de Composer y Artisan

Comandos para crear y administrar el proyecto.

- composer create-project laravel/laravel nombre-proyecto
- composer install
- composer update

- php artisan list    # ver todos los comandos artisan
- php artisan --version

- php artisan serve --host=0.0.0.0 --port=8000    # servidor de desarrollo

- php artisan migrate:install
- php artisan migrate
- php artisan migrate:refresh    # revertir y volver a correr migraciones
- php artisan migrate:fresh --seed    # borrar todas las tablas y correr migraciones + seeders

- php artisan make:controller NombreController
- php artisan make:controller Api/NombreController --api    # controlador API
- php artisan make:model Nombre -m    # crear modelo y migración
- php artisan make:migration create_tabla_nombre_table
- php artisan make:seeder NombreSeeder
- php artisan db:seed --class=NombreSeeder

- php artisan make:middleware NombreMiddleware
- php artisan make:request NombreRequest
- php artisan make:job NombreJob
- php artisan make:event NombreEvent
- php artisan make:listener NombreListener
- php artisan make:command NombreCommand

- php artisan route:list
- php artisan route:clear

- php artisan cache:clear
- php artisan config:clear
- php artisan config:cache
- php artisan view:clear
- php artisan optimize

- php artisan storage:link    # enlazar storage/app/public a public/storage

---

## Comandos de Git y despliegue local

- git init
- git add .
- git commit -m "Inicializar proyecto Laravel"
- git remote add origin <url-repo>
- git push -u origin main

Para despliegue en producción, usa proveedores como Forge, Vapor, o Docker + CI/CD.

---

## Gestión de dependencias de frontend

- npm install
- npm run dev        # entorno de desarrollo (Vite)
- npm run build      # build para producción
- npm run prod       # alias común configurado en package.json

Si usas Tailwind, y otros paquetes, instálalos con npm/yarn y actualiza `resources/css/app.css` y `resources/js/bootstrap.js`.

---

## Bases de datos y Eloquent

- Crear migración: php artisan make:migration create_products_table --create=products
- Ejecutar migraciones: php artisan migrate
- Crear modelo y factory: php artisan make:model Product -mf    # -m migración, -f factory

---

## Debugging, tests y calidad de código

- Ejecutar tests: ./vendor/bin/phpunit o vendor\bin\phpunit (Windows)
- PHPStan / Psalm: agregar como dependencias dev y ejecutar para análisis estático
- Pint (Laravel Pint) para formateo: vendor\bin\pint

---

## Contrato (inputs/outputs) y casos límite rápidos

- Inputs: sistema con PHP, Composer, Node, Git.
- Outputs: proyecto Laravel funcional con servidor de desarrollo y assets compilados.
- Error modes: permisos de archivos, versiones incompatibles de PHP, extensiones faltantes (pdo, mbstring, openssl), variables de entorno mal configuradas.

Edge cases:
- Windows: rutas con backslashes en .env para sqlite; preferir WSL para evitar problemas.
- Versiones de PHP más antiguas: algunas características de Laravel no funcionarán.
- Composer memory_exhausted: usar COMPOSER_MEMORY_LIMIT=-1 composer install

---

## Lista exhaustiva de comandos prácticos (resumen rápido)

- Instalación y creación
  - composer create-project laravel/laravel nombre-proyecto
  - composer global require laravel/installer
  - laravel new nombre-proyecto

- Entorno y dependencias
  - copy .env.example .env    # PowerShell
  - php artisan key:generate
  - composer install
  - npm install

- Base de datos
  - New-Item -ItemType File -Path .\database\database.sqlite    # crear sqlite (PowerShell)
  - php artisan migrate
  - php artisan db:seed

- Desarrollo
  - php artisan serve
  - npm run dev

- Generadores (make)
  - php artisan make:controller NombreController
  - php artisan make:model Nombre -m -f
  - php artisan make:migration create_tabla_table

- Limpieza / Optimización
  - php artisan cache:clear
  - php artisan config:cache
  - php artisan route:cache
  - php artisan view:clear

---

## Recursos y enlaces útiles

- Documentación oficial Laravel: https://laravel.com/docs
- Composer: https://getcomposer.org
- Node.js: https://nodejs.org
- Guía sobre despliegue: https://laravel.com/docs/deployment

---

## Notas finales

Este archivo pretende ser una guía práctica y rápida para comenzar. Si quieres que la adapte a una versión específica de Laravel (por ejemplo Laravel 10 o 11), a un flujo con Docker, o a WSL, dime cuál y lo amplio con pasos concretos y comandos para ese escenario.
