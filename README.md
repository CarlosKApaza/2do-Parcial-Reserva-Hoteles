# 🏨 Segundo Parcial: Sistema Distribuido de Reserva de Hoteles

Este proyecto implementa una arquitectura distribuida basada en el patrón **API Gateway (Motor de Reservas)**. El sistema permite gestionar reservas de habitaciones interactuando con nodos independientes que utilizan diferentes protocolos de comunicación (REST y GraphQL).

## 🚀 Estructura del Proyecto

El sistema se divide en cuatro componentes principales:

1.  **Motor de Reservas (Orquestador):**
    * **Tecnología:** Laravel 12.
    * **Función:** Actúa como punto de entrada único. Gestiona la seguridad mediante **JWT (JSON Web Tokens)** y orquesta las peticiones hacia los hoteles según el destino elegido.
    * **Puerto:** `8000`.

2.  **Hotel Gran Sucre (Nodo REST):**
    * **Tecnología:** Laravel (API).
    * **Comunicación:** Protocolo **RESTful** (JSON).
    * **Puerto:** `8001`.

3.  **Hotel Mirador Andino (Nodo GraphQL):**
    * **Tecnología:** Node.js + Express + Sequelize.
    * **Comunicación:** Protocolo **GraphQL** (Queries y Mutations).
    * **Puerto:** `4000`.

4.  **Agencia Online (Cliente Web):**
    * **Tecnología:** HTML5, CSS3 y JavaScript (Vanilla).
    * **Función:** Interfaz gráfica para el usuario final que consume los servicios del Motor de Reservas.

## 🛠️ Tecnologías Utilizadas

* **Lenguajes:** PHP 8.x, JavaScript (Node.js).
* **Base de Datos:** MySQL (MariaDB).
* **Protocolos:** REST, GraphQL, HTTP.
* **Seguridad:** Firebase JWT.
* **ORM:** Eloquent (Laravel) y Sequelize (Node.js).

## 🗄️ Base de Datos

Se incluyen los scripts SQL necesarios para recrear el entorno en la carpeta `/Bases de Datos`:
* `bd_gran_sucre.sql` (Inventario Nodo REST).
* `bd_mirador_andino.sql` (Inventario Nodo GraphQL).
* `bd_motor_reservas.sql` (Historial de auditoría y logs de transacciones).

## 📝 Instrucciones de Instalación

1.  **Bases de Datos:** Importar los 3 archivos `.sql` en phpMyAdmin.
2.  **Motor y Gran Sucre:** Ejecutar `composer install` y configurar el archivo `.env`. Levantar con `php artisan serve --port=XXXX`.
3.  **Mirador Andino:** Ejecutar `npm install` y levantar con `node server.js`.
4.  **Cliente Web:** Abrir el archivo `index.html` en un navegador (se recomienda usar Live Server).

---
*Desarrollado por Carlos Daniel Kevin Apaza Villca - Sistemas Distribuidos 2026*