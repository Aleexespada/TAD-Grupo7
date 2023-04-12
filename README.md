# TAD-Grupo7

Color: Negro

Integrantes:
- Antonio Manuel Mérida Borrero
- Carlos Herrera Dominguez
- Alejandro Enrique Espada Pino



## Aranque del proyecto con Docker-compose

En primer lugar, tendrás que abrir una consola situada en esta carpeta .

Una vez situado en dicha carpeta podrás empezar a lanzar comandos para levantar el proyecto en local.  

#### Crear contenedores

Creamos y construimos las imagenes de Docker para los servicios especificados en el archivo '**docker-compose.yml**'

```
docker-compose up
```

###### ACLARACIÓN
Es posible que el contenedor de laravel no se levante debido a que en windows puede que tengamos que ejecutar ciertos comandos antes.

Pararemos el resto de contenedores y desde la carpeta '**my-project**' ejecutaremos:
```
composer install
```
Con esto instalaremos las dependencias definidas en el archivo **composer.json** y se debe crear una carpeta llamada **vendor**.

También debemos instalar las dependencias de NPM definidas en el archivo **package.json** con:

```
npm install
```
Y en esta ocasión vemos cómo se crea la carpeta node_modules.

También debemos de generar el fichero .env, que por seguridad está excluido del repositorio, se toma como plantilla el archivo **.env.example**, podemos lanzar este comando:
```
cp .env.example .env
```

#### Levantamos todos los contenedores de docker
```
docker-compose -p my-proyect up -d 
```
Este proyecto despliega con docker compose. Se levantarán 3 contenedores:
1. Laravel 9. Expondrá el puerto 8000. => http://localhost:8000
2. MySQL 5.7. Expondrá el puerto 3306.
3. PhpMyAdmin. Expondrá el puerto 8080. => http://localhost:8080 (credenciales: laravel / laravel)  

Laravel quedará levantado por defecto al arrancar el su contenedor.  
  
  
  
#### Actualizar credenciales para la MySQL
Los valores por defecto de las credenciales para la base de datos han sido cambiados, esto se podrá ver en el fichero yaml de docker compose, por ello tendremos que actualizar las credenciales para Lareval.
1. Abrimos el fichero '.env' en la carpeta 'my-proyect'
2. Buscamosla variable 'DB_DATABASE' y le damos el valor 'laravel'
3. Buscamosla variable 'DB_USERNAME' y le damos el valor 'laravel'
4. Buscamosla variable 'DB_PASSWORD' y le damos el valor 'laravel'


### Generación de la key y link carpeta storage
La clave de aplicación es una cadena aleatoria almacenada en la clave APP_KEY dentro del archivo .env. Notarás que también falta.

Para crear la nueva clave e insertarla automáticamente en el .env:

1. Lanza el siguiente comando en la consola abierta
```
docker ps
```
2. Copia el 'container id' situado en la columna de la izquierda del contendedor de laravel 9
3. Entra en el contenedor y lanza una consola bash con el siguiente comando
```
docker exec -i -t <container id copiado> /bin/bash
```
4. Lanzamos el comando:
```
php artisan key:generate
```
5. Lanzamos el comando para el link de la carpeta storage:
```
php artisan storage:link
```
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
