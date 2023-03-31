# TAD-Grupo7

Color: Negro

Integrantes:
- Antonio Manuel Mérida Borrero
- Carlos Herrera Dominguez
- Alejandro Enrique Espada Pino



## Aranque del proyecto con Docker-compose

En primer lugar, tendrás que abrir una consola situada en esta carpeta .

Una vez situado en dicha carpeta podrás empezar a lanzar comandos para levantar el proyecto en local.  
  


#### Levantamos todos los contenedores de docker
```
docker-compose -p my-proyect up -d 
```
Este proyecto despliega con docker compose. Se levantarán 3 contenedores:
1. Laravel 9. Expondrá el puerto 8000. => http://localhost:8000
2. MySQL 5.7. Expondrá el puerto 3306.
3. PhpMyAdmin. Expondrá el puerto 8080. => http://localhost:8080 (credenciales: laravel / laravel)  

Laravel quedará levantado por defecto al arrancar el su contenedor.  
  


#### Creación de ficheros PHP en Laravel con php artisan

Para esto tendremos que entrar dentro del contenedor que contiene Laravel. Los pasos a seguir serán los siguientes:

1. Lanza el siguiente comando en la consola abierta
```
docker ps
```
2. Copia el 'container id' situado en la columna de la izquierda del contendedor de laravel 9
3. Entra en el contenedor y lanza una consola bash con el siguiente comando
```
docker exec -i -t <container id copiado> /bin/bash
```
4. Lanza el comando de php artisan que necesites
5. Si necesitas cerrar esta consola lanza el siguiente comando
```
exit
```
  
    

#### Lanzamos el entorno de desarrollo
Con el uso de Bootstrap y Vite en las vistas de Laravel, es posible que el proyecto requiera lanzar un entorno de desarrollo, para ello lanzaremos el siguiente comando situandonos dentro dedel contenedor de Laravel 9 en la consola, como hemos explicado antes
```
npm run dev
```
Si es necesario lanzar este comando, el propio Laravel lo indicarán con un error muy explícito en la vista principal al visualizarse en el navegador.

  
  

##### Comandos de php artisan
- Crear modelo: sudo php artisan make:model EjemploModelo -m
- Crear controller: sudo php artisan make:controller EjemploController
- Crear seeder: sudo php artisan make:seeder ExempleSeeder
- Crear todas las tablas de /database/migrations/*: sudo php artisan migrate
- Insertar datos de prueba desde /database/seeders/*: sudo php artisan db:seed
- Iniciar proyecto: sudo php artisan serve
