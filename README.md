# MODULO SERIALNUMBERS PARA DOLIBARR ERP & CRM


## LICENSE

Terms of Use, Maintenance and Support:
https://shop.2byte.es/content/6-condiciones-de-uso-mantenimiento-y-asistencia-modulos

## INSTALLING

### Advanced setup

Para que la posición del selector de número de series aparezca antes que el REF de cada módulo se debe agregar el siguiente código, justo antes del REF en el formulario.

En módulo proyectos, /projet/card.php line 525
En módulo propale, /comm/propal/card.php line 1523
En módulo commande, /commande/card.php line 1558

Para los otros módulo, el número de serie se define más abajo y se registra posterior al envío del formulario, por lo que no es necesario que se despliegue en la cabecera del formulario.

```php
/*
 * $modulo debe tomar el valor según el módulo donde se ejecute
 * Proyectos: project
 * Presupuesto: propale
 * Pedidos: commande
*/
if(isset($conf->global->MAIN_MODULE_NUMBERSERIES) and $conf->global->MAIN_MODULE_NUMBERSERIES == 1){
	require_once DOL_DOCUMENT_ROOT."/custom/numberseries/lib/numberseries.lib.php";
	numberseriesShowOnHead($modulo, $object, $extrafields);
}else{
	//codigo por defecto formulario REF
}
```

En el caso de pedidos, se puede agregar una validación para agregar el número de serie de manera automática al validar el pedido, de esta forma no generar REF con valores (PROV...)

```php
/*
 *
 */
if($conf->global->SET_AUTOMATIC_REF_BY_NUMBERSERIES == 1){
	$object->ref = GETPOST('ref');
}
```