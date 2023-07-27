Ejercicio práctico (SOLID Y CLEAN CODE) 

## 🚀 Rest sucursales Bits Americas
### 🐘 Requerimientos

1. [PHP 8.1](https://www.php.net/manual/en/install.php)
2. [Symfony 6](https://symfony.com/doc/current/index.html)
3. [Mysql 5.7](https://dev.mysql.com/downloads/mysql/5.7.html)
4. Servidor local

### 🛠️ Configuración
1. Clonamos el proyecto: `git clone https://github.com/jpdiaz663/taller-sucursales-bits-2023.git`
2. Instalar paquetes con composer: `composer install`
3. Crear su base datos sin tablas en su mananagment sql
4. Verificamos que este nuestro archivo .env sino lo creamos: (`cp .env .env.local`) puede modificar este archivo a su gusto
5. Dentro del archivo .env en `DATABASE_URL` tiene que verificar sus credenciales mysql y el nombre de la BD 
6. Creamos sus tablas en base a las entidades: `symfony console d:s:u -f --dump-sql`
7. Verificar en su BD si se encuentran las tablas: `user, office, currency`
8. Arrancamos el servidor local de symfony `symfony serve -d` o el sistema que tenga para iniciar el server

## 👩‍💻 Funcionalidades

Este proyecto es un api rest, su objetivo es hacer un CRUD con los verbos (POST, PUT, GET, DELETE) gestionando sucursales de BITS AMERICAS, tiene 2 versiones, 1 es creada con ApiPlatform es un paquete para gestion de proyectos REST, la segunda version es utilizando solo las herramientas que nos provee el framework symfony, nos enfocaremos a ejecutar las funcionalidad con la 2 versión.

### 🔥 Curl POST crear una sucursal

```bash
curl --location 'http://127.0.0.1:8000/api/v2/offices/' \
--header 'Content-Type: application/json' \
--data '{
  "code": "1001",
  "description": "Bits Colombia",
  "address": "CL 45#26-12",
  "rtn": "90956442112",
  "currency": "COP"
}'
```
### 🎯 Curl PUT actualiza una sucursal

```bash
curl --location --request PUT 'http://127.0.0.1:8000/api/v2/offices/1' \
--header 'Content-Type: application/json' \
--data '{
  "code": "1001",
  "description": "Bits Colombia",
  "address": "CL 45#26-12",
  "rtn": "90956442112",
  "currency": "COP"
}'
```
### 🎯 Curl GET by or ALL

by: 
```bash
curl --location 'http://127.0.0.1:8000/api/v2/offices/1'
```
all: 
```bash
curl --location 'http://127.0.0.1:8000/api/v2/offices/'
```
### 🔖 Curl DELETE

```bash
curl --location --request DELETE 'http://127.0.0.1:8000/api/v2/offices/1'
```

## 🤩 Resumen
Este proyecto esta hecho con clean code, buenas practicas de programación que nos ayudan a tener una mantenibilidad y escalabilidad en nuestro codigo, con el uso del framework symfony nos olbiga a tener buenas practicas, utilizamos patrones SOLID y patrones creacionales, patrones de diseño para el manejo de objetos, evitamos los Bad Code Smells, nos enfocamos en utilizarlos y aprovecharlos de la mejor manera, se seguira probando y mejorando a medida que vayamos aprendiendo un poco mas sobre las buenas practicas.

🎥 Links de estudio:
* [SOLID](https://bitsamericas.odoo.com/slides/principios-solid-y-clean-code-para-backend-20)
* [Code smells](https://mmantyla.github.io/BadCodeSmellsTaxonomy)
* [Type hinting](https://diego.com.es/type-hinting-en-php)
* [Arquitectura Hexagonal](https://pro.codely.tv/library/arquitectura-hexagonal/66748/about/)
* [CQRS: Command Query Responsibility Segregation](https://pro.codely.tv/library/cqrs-command-query-responsibility-segregation-3719e4aa/62554/about/)
* [Patron de estrategia](https://www.laraveltip.com/elimina-sentencias-if-else-y-switch-con-el-patron-estrategia/)
* [TellDontAsk](https://martinfowler.com/bliki/TellDontAsk.html)
* [LeyDemeter](https://devexpert.io/ley-de-demeter/)
