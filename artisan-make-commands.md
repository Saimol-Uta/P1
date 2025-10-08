## Comandos útiles de `php artisan make` (guía rápida)

Este documento recoge ejemplos y anotaciones en español para crear automáticamente artefactos comunes en Laravel usando `php artisan make`. Está pensado para ayudarte a generar modelos, controladores, migraciones, fábricas, seeders y más de forma rápida.

### Convenciones rápidas
- Usa PascalCase para nombres de clases: `Estudiante`, `EstudianteController`.
- Los nombres de archivos y clases son sensibles a mayúsculas por convención PSR-4. En Windows funcionan sin problema, pero mantén la convención.
- Ejecuta los comandos desde la raíz del proyecto (la carpeta que contiene `artisan`).

### Ejemplo: crear un modelo con migración, controlador y factory

Un comando común que verás en ejemplos es:

```
php artisan make:model Estudiante -m -c -f
```

Explicación:
- `make:model Estudiante` crea `app/Models/Estudiante.php`.
- `-m` crea una migración (en `database/migrations`).
- `-c` crea un controlador (por defecto `app/Http/Controllers/EstudianteController.php`).
- `-f` crea una factory (en `database/factories`).

Atajo útil: `--all` o `-a` crea varios artefactos a la vez (migration, factory, seeder y un controlador tipo resource):

```
php artisan make:model Estudiante -a
```

Nota sobre `-mcr` del ejemplo: puedes combinar banderas en una sola invocación; por ejemplo `php artisan make:model Estudiante -m -c -r` (abreviado `-mcr`) crea el modelo, la migración y un controlador resource. En versiones actuales de Laravel la bandera `-r` (o `--resource`) sí existe para `make:model` y su efecto es indicar que el controlador generado deberá ser un resource controller.

En otras palabras:

- `-c` o `--controller` crea el controlador.
- `-r` o `--resource` convierte ese controlador en un controlador resource (con los métodos index, create, store, show, edit, update, destroy).

Si prefieres generar el controlador por separado también puedes usar:

```
php artisan make:controller EstudianteController --resource --model=Estudiante
```

Esto genera un controlador resource con los métodos REST y enlaza el `--model` para type-hint del modelo.

### Comandos comunes y su uso

- Modelo (con opciones):
  - `php artisan make:model Nombre` — crea el modelo.
  - `php artisan make:model Nombre -m` — añade migración.
  - `php artisan make:model Nombre -f` — añade factory.
  - `php artisan make:model Nombre -s` — añade seeder.
  - `php artisan make:model Nombre -c` — crea un controller básico.
  - `php artisan make:model Nombre -a` — crea migration, factory, seeder y controller resource.

- Controlador:
  - `php artisan make:controller NombreController` — controlador básico.
  - `php artisan make:controller NombreController --resource` — controlador resource (index, show, create, store, edit, update, destroy).
  - `php artisan make:controller NombreController --invokable` — controlador con un solo método `__invoke()`.
  - `php artisan make:controller NombreController --resource --model=Nombre` — controller resource con type-hint al modelo.

- Migración:
  - `php artisan make:migration create_estudiantes_table` — nueva migración.

- Seeder / Factory:
  - `php artisan make:seeder EstudiantesSeeder` — crea un seeder en `database/seeders`.
  - `php artisan make:factory EstudianteFactory --model=Estudiante` — crea una factory vinculada al modelo.

- Otros útiles:
  - `php artisan make:middleware NombreMiddleware`
  - `php artisan make:request EstudianteRequest` — para validaciones form request.
  - `php artisan make:job NombreJob`
  - `php artisan make:listener NombreListener`
  - `php artisan make:command NombreCommand` — comando artisan personalizado.
  - `php artisan make:policy NombrePolicy --model=Nombre` — policy ligada a un modelo.

### Tips y buenas prácticas

- Usa `--resource` cuando quieras un controlador con las acciones REST ya esqueleto.
- Si necesitas generar todo lo relacionado con un recurso nuevo, `make:model -a` es muy práctico.
- Revisa siempre `php artisan route:list` después de crear controladores y registrar rutas para verificar que todo esté conectado.
- Cuando crees migraciones, ejecútalas con `php artisan migrate` (en desarrollo). Para resetear y volver a migrar: `php artisan migrate:fresh --seed`.

### Cómo probar rápido (PowerShell)

Abre PowerShell en la raíz del proyecto y copia/pega los comandos siguientes según lo que necesites crear. Ejemplos:

```
php artisan make:model Estudiante -m -c -f
php artisan make:controller EstudianteController --resource --model=Estudiante
php artisan make:seeder EstudiantesSeeder
php artisan migrate
php artisan db:seed --class=EstudiantesSeeder
php artisan route:list
```

### Resumen

- `php artisan make:model Estudiante -m -c -f` es la forma práctica de crear modelo + migración + controller + factory.
- Preferible usar PascalCase y ejecutar desde la raíz del proyecto.
- Para controladores resource y binding de modelos usa `make:controller --resource --model=Nombre`.

Si quieres, puedo añadir ejemplos concretos para tu proyecto (por ejemplo, crear el modelo `Estudiante` con migración, factory y un seeder con datos de ejemplo). Dime si los nombres de tablas/columnas específicos que quieres.

### Comandos adicionales útiles para el desarrollo

Aquí tienes una recopilación de comandos que aceleran tareas diarias durante el desarrollo en Laravel (ejecutar desde la raíz del proyecto en PowerShell).

- Servir la aplicación en local (valible para desarrollo):

```
php artisan serve
```

- Migraciones y seeds rápidas:

```
php artisan migrate            # Ejecuta migraciones pendientes
php artisan migrate:fresh     # Borra todas las tablas y re-migra (útil en dev)
php artisan migrate:fresh --seed  # Re-migra y corre los seeders
php artisan db:seed --class=NombreSeeder
```

- Comandos para limpiar caches (útiles tras cambios en config/rutas/views):

```
php artisan config:cache
php artisan route:cache
php artisan view:clear
php artisan cache:clear
```

- Crear enlace público para almacenamiento (si usas storage):

```
php artisan storage:link
```

- Ejecutar pruebas:

```
php artisan test           # Ejecuta tests con PHPUnit/Pest según configuración
./vendor/bin/phpunit      # Ejecuta PHPUnit directamente (Windows: vendor\bin\phpunit.bat)
```

- Herramientas de frontend (si usas npm/vite):

```
npm install
npm run dev      # Vite: modo desarrollo
npm run build    # Build para producción
```

- Composer (gestión de dependencias):

```
composer install
composer update
composer dump-autoload
```

- Git (flujo común):

```
git status
git add .
git commit -m "mensaje"
git push
```

- Debug y logs:

```
tail -f storage/logs/laravel.log  # En Linux/macOS; en Windows usa Get-Content -Wait storage\logs\laravel.log
php artisan tinker                 # REPL para probar código rápidamente
```

### Atajos y notas finales

- Si tu proyecto usa Docker, adapta los comandos (por ejemplo `docker compose exec app php artisan ...`).
- Antes de commitear, corre `composer test` o `php artisan test` para asegurarte de que no rompes la CI.
- Usa `php artisan route:list` y `php artisan route:cache` con precaución (route:cache no funciona con closures en rutas).

Con esto tienes un conjunto práctico de comandos que cubren la mayoría de tareas diarias. ¿Quieres que ejecute alguno de estos ahora en tu proyecto (por ejemplo, crear el modelo `Estudiante` con migración y seed) y haga los ajustes automáticos en los archivos generados?
