# GreenGrow

Proyecto de TFG de Imanol Callejo Baranda 2023/2024

## Tabla de contenidos
- [Estructura de carpetas](#estructura)



## Estructura de carpetas
assets/:            Contiene los recursos estáticos del frontend como archivos CSS, JavaScript e imágenes.
 > css/:                Estilos CSS para el diseño del sitio.
 > js/:                 Archivos JavaScript para la funcionalidad del frontend.
 > img/:                Imágenes utilizadas en el proyecto.
controllers/:       Aquí se encuentran los controladores de PHP que manejan las solicitudes del usuario y coordinan la lógica de la aplicación.
models/:            Contiene los modelos de PHP que representan los datos y la lógica de negocios de la aplicación.
views/:             Almacena las vistas que se renderizan y se envían al cliente.
 > includes/:     Aquí se almacenan los archivos PHP que se importarán en todas las páginas del proyecto. En este caso, header.php contendrá la barra de navegación y footer.php contendrá el pie de página.
 > home/: Vistas específicas para la sección de inicio.

home/:              Vistas específicas para la sección de inicio.

.gitignore:         Archivo que especifica qué archivos y carpetas se deben ignorar en el control de versiones Git.
index.php:          Punto de entrada principal de la aplicación donde se manejan todas las solicitudes.
config.php:         Archivo de configuración donde se pueden definir variables de configuración globales.