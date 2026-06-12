HUELLAS FELICES

Proyecto e-commerce desarrollado en Laravel para taller de programación I.

-----------------------------------------------------------------------------------------------

DESCRIPCIÓN DEL SITIO

Este sitio pretende brindar una manera efizcas y sencilla de relación cliente-proveedor de tal forma que pueda ser fácil
el acceso a compras, servicios de turnos o emergencias. 

-----------------------------------------------------------------------------------------------

Tecnologías utilizadas
. Laravel
. PHP
. SQLite
. Bootstrap 5
. JavaScript
. Blade
. Tidio(chatBot)
. Google authenticator(para el uso de mails)

-----------------------------------------------------------------------------------------------

Instalación

Requisitos

. PHP 8.2 o superior
. Composer
. Node.js y npm
. Git

-----------------------------------------------------------------------------------------------

PASO 1

Clonar repositorio

git clone https://github.com/ArielAlegre12/Proyecto-taller-group

Ingresar al proyecto:

cd Proyecto-taller-group

-----------------------------------------------------------------------------------------------

PASO 2

Instalar dependencias

composer install

npm install

-----------------------------------------------------------------------------------------------

PASO 3

Configurar entorno

Renombrar .env.copy a .env

-----------------------------------------------------------------------------------------------

PASO 4

Base de datos

mover el archivo database.sqlite a la carpeta database

-----------------------------------------------------------------------------------------------

PASO 5, IMPORTANTE

descomprimir el productos.zip y mover la carpeta "productos" a storage/app/public/
esto es para que cargue las imagenes de los productos, porque el gitignore no deja subir a git la carpeta

-----------------------------------------------------------------------------------------------

PASO 6

Ejecutar servidor

Montar el proyecto en laravel y probar(si se sigue todos estos pasos deberia funcionar)


-----------------------------------------------------------------------------------------------

Funcionalidades principales

. Catálogo de productos
. Carrito de compras
. Checkout 
. Gestión de productos
. Gestión de usuarios
. Panel administrativos
. Filtros
. Activación/desactivación de productos
. Integración de chatbot Tidio
. Generar resumenes de ventas y descargarlas en pdf(domPDF)

-----------------------------------------------------------------------------------------------

Usuarios de prueba

Administrador

Email:

admin@test.com

Contraseña:

123456789

Cliente

cliente@test.com

Contraseña:

12345678

-----------------------------------------------------------------------------------------------

Pruebas de implementación

Antes de esta entrega realizamos pruebas de: 
. Registro e inicio de sesión, si se registra un cliente lleva a la vista de inicio y si es un admin al panel de administración.
. Compra de productos, si se hace de manera sin logearse se pedira que lo haga al intentar "seguir compra" en el menú del carrito, los productos del carrito(sin logearse) se sumaran a su carrito personal junto a los productos que ya hayan quedado registrados anteriormente allí.
. Actualización automática de stock(recién al momento de finalizar una compra), también si un cliente tiene en su carrito un 
producto que su stock paso de 1 a 0 (se actualizó), no se le permitira la compra y se le indicará que ya no hay stock de ese producto.
. Activación y desactivación de productos, lo puede ser el admin o de manera automática al pasar a stock 0, la activación también puede ser automática una vez se hayan agregado productos a su stock.
. Filtros de productos, ventas, usuarios, turnos y consultas.
. Panel administrativo.
. Paginación
. Validaciones de formularios
. Checkout y métodos de pago simulados


Problemas encontrados y soluciones que tuvimos

Problema:

Los productos stock 0 seguían apareciendo en la tienda.

Solución:

Se implementó lógica automática para desactivar productos sin stock.

Problema:

La paginación perdía el estado visual del acordeón de productos inactivos.

Solución:

Se utilizó request() para mantener abierto el acordeón dependiendo de la página y filtros activos.

Problema:

El scroll se reiniciaba al cambiar filtros 

Solución:

Se implemento un sistema de preservación de scroll utilizando sessionStorage.


-----------------------------------------------------------------------------------------------

Integrantes

. Alegre, Ariel Santiago
. Colman, Lucas Joaquín 