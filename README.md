# Instalación

Es necesario que tu proyecto cuente como [composer](https://getcomposer.org/).

Ejecutar 
```bash
composer require todosoft/skd-api-dte
```

composer se encargara de instalar todas las dependencias.

# Como Usarlo

Este SDK se desarrollo para hacerte la vida más facil al momento de conectarte a nuestra API de Facturación Electrónica, más adelante te dejo unos ejemplos.

## Manejo de errores
El SDK capturara los errores devueltos por la API y te los retornara.

## Emitir un DTE

```PHP
<?php
use ToDoSoft\Dte;

$token = 'tu-token';

$dte = new Dte($token);

$dte->rutEmis = '11111111-1';
$dte->tipo_dte = 39; //boleta electrónica
$dte->rutRecep = '22222222-2'; //Datos no obligatorio para boleta electrónica
$dte->rznSocRecep = 'razon social'; //Datos no obligatorio para boleta electrónica
$dte->giroRecep = 'venta al por menor'; //Datos no obligatorio para boleta electrónica
$dte->dirRecep = 'calle juan perez 8'; //Datos no obligatorio para boleta electrónica
$dte->cmnaRecep = 'Santiago'; //Datos no obligatorio para boleta electrónica
$dte->items = ['nombre' => 'martillo', 'cantidad' => 10, 'precio' => 1000];

$respuesta = $dte->emitir();
```

Esta forma te permite emitir, consultar, generar pdfs de dtes y mas cosas de forma simple.

# Clases

Actualmente el SDK consta de 3 clases para uso publico. Te las listo a continuacion, junto con sus metodos y atributos publicos.

* \ToDoSoft\Empresa:
    * Recibe el $token al  momento de instanciarla.
    * Atributos: 
      * rut
      * razon_social
      * nr_resolucion
      * fc_resolucion
      * direccion
      * comuna
      * telefono
      * email
      * certificado
      * password_certificado
      * giro
      * codigo_actividad
    * Metodos: 
      * crear(): Permite crear una empresa, tomando los datos desde los atributos.
      * actualizar(): Actualiza la empresa, tomando los datos desde los atributos.
      * actualizarCertificado(): Actualiza el certificado personal de la empresa.
* \ToDoSoft\Dte
  * Recibe el $token al momento de instanciarla.
  * Atributos: 
    * rutEmis
    * tipo_dte
    * rutRecep
    * rznSocRecep
    * giroRecep
    * dirRecep
    * cmnaRecep
    * items
    * folio (Solo se utiliza para consultar DTES, no para crear)
  * Metodos: 
    * emitir(): Emite un DTE. tomando los datos desde los atributos.
    * consultarEstado(): Consulta el estado de un DTE directamente desde el SII.
    * generarPdf(): genera el PDF del dte.
* \ToDoSoft\Caf
  * Recibe el $token al momento de instanciarla
  * Atributos: 
    * caf
    * rut
  * Metodos:
    * getFolios(): Consulta los archivos CAFs cargados en la API.
    * setFolios(): Carga un nuevo archivo CAfs a la API.
  
  