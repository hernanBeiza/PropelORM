# PropelORM
Ejemplo de uso de PropelORM, Slimframework y PHP

## Configuración

- Revisar config. En esta debe estar los datos correctos de conexión a la DB
- Revisar composer.json, el script propel:reverse. DEbe tener los datos correctos de conexión a la DB

## Generar esquema de una db existente

Ejecutar
```
composer propel:reverse
```

## Atención

- Atención a las llaves de la tabla usuariotarea
- Revisar namespace del esquema. Debe ser PropelORMAPI\ORM
``
<database name="default" defaultIdMethod="native" defaultPhpNamingMethod="underscore" namespace="PropelORMAPI\ORM">
``
- Agregar el atributo isCrossRef="true" en la tabla relacional UsuarioTarea (si no se hace esto y se egeneran los modelos, al usar addTarea arrojará eerror de metodo sin definir "addTarea")

``
  <table name="usuariotarea" idMethod="native" phpName="Usuariotarea"  isCrossRef="true">
``

## Generar configuración de conexión a la db

Ejecutar

```
composer propel:config
```

Recordar revisar la carpeta de config. En esta debe estar la configuración correcta a la DB

## Generar clases desde el esquema creado anteriormente

Ejecutar
```
composer propel:build
```

## Esquema ER

![ER](C:\Users\skizo\Documents\GitHub\PropelORM\docs\ER.png)