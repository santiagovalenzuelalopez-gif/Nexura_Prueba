# Nexura_Prueba

Prueba Técnica – CRUD Empleados
================================

Este proyecto implementa un sistema CRUD (Crear, Leer, Actualizar y Eliminar) para la gestión de empleados, utilizando PHP (POO con PDO) y MySQL.
La aplicación permite registrar empleados, asignarlos a un área y un rol, además de gestionar su información básica.

----------------------------------------
Estructura del proyecto
----------------------------------------
db/
  Database.php       # Clase de conexión a la BD
models/
  Empleado.php       # Modelo con métodos CRUD + gestión de roles
assets/
  css/styles.css     # Estilos básicos
  js/validation.js   # Validación en cliente
index.php            # Listado de empleados
form.php             # Crear / Editar empleados
sql/
  prueba_nexura.sql  # Script de creación de la BD

----------------------------------------
Requisitos
----------------------------------------
- PHP 8.0+
- MySQL 5.7+ o MariaDB
- Servidor local (XAMPP, Laragon, WAMP, etc.)
- Navegador web moderno

----------------------------------------
Instalación y configuración
----------------------------------------
1. Clonar el repositorio:
   gh repo clone santiagovalenzuelalopez-gif/Nexura_Prueba

2. Importar la base de datos:
   - Abrir phpMyAdmin o usar la terminal MySQL.
   - Crear la BD:
     CREATE DATABASE prueba_nexura;
   - Importar el archivo sql/prueba_nexura.sql

3. Configurar la conexión en db/Database.php si usas credenciales distintas:
   private static $host = "127.0.0.1";
   private static $db   = "prueba_nexura";
   private static $user = "root";
   private static $pass = "";

4. Ejecutar el proyecto:
   - Copiar la carpeta al directorio de tu servidor (htdocs en XAMPP).
   - Abrir en el navegador:
     http://localhost/Nexura_Prueba/index.php

----------------------------------------
Funcionalidades
----------------------------------------
- Listar empleados con su área y rol
- Crear nuevos empleados
- Editar empleados existentes
- Eliminar empleados
- Validación de campos en cliente y servidor
- Selección de área y rol mediante listas desplegables

----------------------------------------
Tecnologías usadas
----------------------------------------
- PHP 8 (POO con PDO)
- MySQL
- HTML5 / CSS3 / JavaScript
- XAMPP (desarrollo local)

----------------------------------------
Autor
----------------------------------------
Desarrollado por Santiago Valenzuela López como parte de una prueba técnica.
