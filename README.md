# PropelORM

- Ejemplo de uso de PropelORM, Slimframework y PHP

## Requerimientos

- composer
- slimframework
- php

## Configuración

- Revisar config. En esta debe estar los datos correctos de conexión a la DB
- Revisar composer.json, el script propel:reverse. Debe tener los datos correctos de conexión a la DB

## Generar esquema de una db existente

- Ejecutar

```
composer propel:reverse
```

## Atención

- Atención a las llaves de la tabla usuariotarea
- Revisar namespace del esquema. Debe ser PropelORMAPI\ORM

```html
<database name="default" defaultIdMethod="native" defaultPhpNamingMethod="underscore" namespace="PropelORMAPI\ORM">
```

- Agregar el atributo isCrossRef="true" en la tabla relacional UsuarioTarea (si no se hace esto y se egeneran los modelos, al usar addTarea arrojará error de metodo sin definir "addTarea")

```html
<table name="usuariotarea" idMethod="native" phpName="Usuariotarea" isCrossRef="true">
```

## Generar configuración de conexión a la db

- Ejecutar

```bash
composer propel:config
```

- Recordar revisar la carpeta de config. En esta debe estar la configuración correcta a la DB

## Generar clases desde el esquema creado anteriormente

- Ejecutar

```
composer propel:build
```

## Esquema ER

![ER](docs\ER.png)
