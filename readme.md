# Registro al examen de ingreso a la educación media superior

# Contribuir

:+1: :tada: Primero que nada gracias por tomarte el tiempo para contribuir a este proyecto :+1: :tada:

### Antes de hacer tu contribución por favor lee la guía de estilo del código [Guía de estilo del código](https://gitlab.com/ajcarrillo/guia_desarrollo/).
El estilo del código es especialmente importante si estamos en un equipo de desarrollo o si nuestro proyecto lo van a usar en algún momento otros desarrolladores. Pero, cuando trabajamos en un proyecto propio, también es una buena costumbre usar un estilo de código claro y optimizado. Nos ayudará a revisar mejor el código y a entenderlo si en algún momento tenemos que modificarlo o queremos reutilizarlo.

Para contribuir a este proyecto sigue los siguientes pasos:
 
 ```
 $ git clone https://gitlab.com/ajcarrillo/paenms
 $ git checkout -b devTuNombre
 
 // Despues de hacer tu contribución
 $ git pull origin master
 // Corrige conflictos, si los hay
 $ git push origin devTuNombre
 ```
 
 Crea tu merge request en el sitio de gitlab.
 
 * Clona el proyecto
 * Crea tu rama de trabajo
 * Haz tu contribución
 * Baja los últimos cambios en la rama `master`, arregla conflictos si los hay
 * Sube tu contribución
 * Y haz un merge request a la rama `master` del proyecto.

## :baby_bottle: Baby Steps I

* Copiar y renombrar el archivo `/.env.example` a `.env`

### Archivo .env

Aquí se encuentra contenidas algunas variables y configuraciones de vital importancia para que el proyecto funcione.

La variable `APP_KEY` se rellena automáticamente ejecutando el comando:

```
$ php artisan key:generate
```

## :baby_bottle: Baby Steps II

### Configuración y creacion de bases de datos.

Puedes crear las bases de datos ejecutando los siguientes scripts:

Base de datos educacionmedia:
```sql
DROP DATABASE IF EXISTS educacionmedia;
CREATE DATABASE educacionmedia
   CHARACTER SET = 'utf8mb4'
   COLLATE = 'utf8mb4_unicode_ci';
```

Para crear migraciones, ejecutar seeder o correr migraciones de la base de datos de `educacionmedia` sigue el proceso normal de creación de dichos componentes.

## :baby_bottle: Baby Steps III

### Autenticación oauth2, proyecto jarvis

* En el sistema `jarvis` crea el cliente para este proyecto.
* Copia el `client id` y el `secret key`
* Ve al archivo `.env` de este proyecto y pega el `cliente id` en la variable `JARVIS_PASS_CLIENT_ID` y el `secret key` en `JARVIS_PASS_SECRET`
