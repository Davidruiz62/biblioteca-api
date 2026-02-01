# API REST de Biblioteca (Laravel)

API REST desarrollada en Laravel para la gestión de una biblioteca de libros.  
Permite realizar operaciones CRUD completas, aplicar filtros y marcar libros como leídos o no leídos, manejando validaciones y errores básicos.

## Instalación

Primero, se debe clonar el repositorio;  
git clone https://github.com/Davidruiz62/biblioteca-api.git  
cd biblioteca-api  

Segundo, se deben instalar las dependencias;  
composer install  

Tercero, se debe copiar el archivo de configuración;  
cp .env.example .env  

Cuarto, generar la clave de la aplicación;  
php artisan key:generate  

## Cómo ejecutar el proyecto

Una vez finalizada la instalación, se debe ejecutar el servidor de desarrollo;  
php artisan serve  

Por defecto, la aplicación se ejecutará en la siguiente dirección;  
http://127.0.0.1:8000  

Durante el desarrollo también se ha utilizado el puerto 8001;  
http://127.0.0.1:8001  

## Explicación de la estructura del proyecto

- **BookController**   
  Se encarga de gestionar las peticiones HTTP, validar los datos de entrada y devolver las respuestas.

- **BookService**   
  Contiene la lógica, se gestionan los libros, se aplican filtros y se realizan las operaciones CRUD.

- **routes/api.php**   
  En este archivo se especifican los distintos endpoints disponibles.

- **storage/books.json**   
  Se utiliza la persistencia simple para el almacenamiento de los datos

## Mejoras futuras 

- Implementar una base de datos relacional para la persistencia de los datos, sustituyendo el archivo JSON por una solución más escalable.

- Documentar la API utilizando Swagger u OpenAPI para facilitar su uso y comprensión.

- Implementar paginación y ordenación en el listado de libros.

- Añadir autenticación y autorización para proteger los endpoints de la API.



