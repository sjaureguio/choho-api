# API REST - Solución a prueba técnica

Para Dessarrolar la prueba en cuestión se usó PHP como lenguaje de programación, con el framework Laravel Lumen en su versión 8:

## Requisitos para ejecutar el proyecto de manera local
- PHP >= 7.3
- MYSQL >= 5.7
## Manual de Instalación (entorno local)

1. Clona o descarga el proyecto del siguiente respositorio: [http://github.com/sjaureguio/choho-api](http://github.com/sjaureguio/choho-api "Clic")
2. Desde la consola o terminal, nos ubicamos en nuestro proyecto <code>cd choho-api/</code>
3. En la ruta del proyecto, ejecuta los siguientes comandos <br>
    
    <code>- composer install</code><br>
    <code>- cp .env.example .env</code><br>
    <code>- php artisan key:generate</code>
    
4. Crear una bd con el nombre de "choho"
5. En la carpeta public del proyecto se encuentra la BD con el nombre de <strong>choho.sql</strong>. El cuál, debe de ser restablecido.
6. Iniciamos el servidor PHP para desarrollo en el puerto 8000 <br>
    <code>php -S localhost:8000 -t public/</code><br>
7. Para ver el resultado ingresar a la siguiente url: [http://localhost:8000/api/orders](http://localhost:8000/api/orders) <br> <br>
    <img src="./public/images/json.png" alt="Resultado">
7. Finalmente, para ver el resultado en una vista ingresar a: [http://localhost:8000/orders](http://localhost:8000/orders) <br> <br>

