# Clase 11/03/2026 — Explicación detallada

## Estructura de la carpeta

Esta es la **segunda clase del curso** (11 de marzo de 2026). Respecto a la clase anterior (`_10032026`), el proyecto ha evolucionado: ahora hay **subcarpetas** que separan las lecciones de la estructura principal.

```
_11032026/
├── index.php          ← Punto de entrada (ahora con configuración y vista)
├── lecciones/         ← Ejercicios individuales
│   ├── contactar.php      ← Funciones de salida + OOP básica
│   ├── fechasCarbon.php   ← Placeholder para futuras lecciones
│   ├── formatosDatos.php  ← JSON en JavaScript
│   ├── index.html         ← Texto de prueba
│   ├── index.php          ← Página de bienvenida con imagen base64
│   └── tipos.php          ← Tipos de datos y strict_types
├── src/               ← (vacío, reservado para clases PHP)
└── vistas/
    └── inicio.php     ← Plantilla HTML principal
```

---

## 1. `index.php` — Punto de entrada

```php
$nombreApp = 'Tienda virtual del curso de PHP';
require_once 'vistas/inicio.php';
```

Comparado con la clase anterior (`_10032026`), ahora el `index.php`:
- **Define una variable de configuración** (`$nombreApp`) que se usará en la vista.
- **Carga una vista** usando `require_once`, separando la lógica de la presentación.

### `require_once` vs `require` vs `include`

| Instrucción | Si el archivo no existe | Si ya fue incluido |
|---|---|---|
| `require` | **Error fatal** (detiene PHP) | Lo incluye de nuevo |
| `require_once` | **Error fatal** (detiene PHP) | **No lo incluye** otra vez |
| `include` | **Warning** (sigue ejecutando) | Lo incluye de nuevo |
| `include_once` | **Warning** (sigue ejecutando) | **No lo incluye** otra vez |

Se usa `require_once` porque si la vista no existe, no tiene sentido seguir, y si accidentalmente se intenta cargar dos veces, solo se carga una.

---

## 2. `vistas/inicio.php` — Plantilla HTML

```html
<!DOCTYPE html>
<html lang="es">
<head>
   <title><?php echo $nombreApp; ?></title>
   <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }
      h1 { text-align: center; }
   </style>
</head>
<body>
   <h1><?php echo $nombreApp; ?></h1>
</body>
</html>
```

**Conceptos importantes:**

- **`<?php echo $nombreApp; ?>`**: La variable `$nombreApp` fue definida en `index.php` antes del `require_once`. Como `require_once` es como "copiar y pegar" el archivo, la variable sigue disponible aquí. Esto se llama **ámbito global**.
- El CSS hace un **reset** (elimina márgenes/padding por defecto) y centra los `<h1>`.

### La parte comentada al final:

```php
<?php
$prueba = 'Esto es una prueba';
```

- Después de cerrar `</html>`, se abre un nuevo bloque PHP. Esto funciona, pero es **mala práctica** — el HTML ya terminó, cualquier salida PHP aquí podría causar problemas (por ejemplo, con las cabeceras HTTP).
- La variable `$prueba` se define aquí probablemente como ejercicio para usar más adelante.

---

## 3. `lecciones/tipos.php` — Tipos de datos

```php
<?php
// Tipos de datos en PHP
//https://www.php.net/manual/es/language.types.php
$numero = 'noveas';
$yoquese = $numero * 35;
```

### Type juggling (conversión automática de tipos)

- `$numero` es un **string** (`'noveas'`).
- PHP intenta multiplicar un string por un número (`* 35`). Como `'noveas'` no se puede convertir a número, PHP lo convierte a `0`.
- `$yoquese` valdrá `0` (0 × 35 = 0).
- Esto se llama **type juggling**: PHP convierte tipos automáticamente para intentar completar la operación. Puede generar resultados inesperados — por eso existe `strict_types`.

### `var_dump()` para inspeccionar variables

```php
$nombreCliente = '';
var_dump($nombreCliente);
```

- `$nombreCliente` es un string **vacío** (`''`).
- `var_dump()` mostrará: `string(0) ""` — es un string de longitud 0.

### `declare(strict_types=1)` — Modo estricto

```php
declare(strict_types=1);
```

- **Debe ir en la primera línea del archivo** para funcionar correctamente. Aquí está después de varias líneas de código, lo que significa que **no tendrá efecto real** en este archivo.
- Cuando está bien colocado, activa la verificación estricta: PHP ya no convierte tipos automáticamente en llamadas a funciones. Si una función espera `int` y le pasas `string`, lanza un `TypeError`.

### Reasignación de variables

```php
echo $nombreCliente;        // Imprime '' (vacío)
$nombreCliente = 'Juan';    // Ahora vale 'Juan'
```

- En PHP, las variables son **dinámicas**: puedes reasignarlas libremente e incluso cambiar su tipo. `$nombreCliente` primero fue `''` (string vacío) y luego `'Juan'`.

---

## 4. `lecciones/contactar.php` — Funciones de salida y OOP

### Funciones de salida

| Función | Qué hace | Devuelve |
|---|---|---|
| `echo` | Imprime uno o más valores (no es función, es construcción del lenguaje) | Nada |
| `var_dump()` | Muestra tipo + valor detallado | `NULL` |
| `print_r()` | Muestra valor legible | `1` (true) |
| `printf()` | Imprime cadena con formato (`%d`, `%s`) | Longitud impresa |

### Funciones anónimas (closures)

```php
$fn = function (){
   return '<h2>Dentro de función anónima</h2>';
};
echo $fn();
```

- Una **función sin nombre** almacenada en variable. Se llama añadiendo `()` a la variable.

### Funciones variables

```php
function mifuncion(){
   return '<h2>Dentro de mifuncion()</h2>';
}
$fn2 = 'mifuncion';
echo $fn2();  // Llama a mifuncion()
```

- Si una variable contiene el **nombre** de una función como string, puedes invocarla con `()`.

### Interpolación en comillas dobles

```php
echo "Valor: $var1";                // Variable simple
echo "Valor: {$fn()}";              // Llamada a función
echo "Saludando: {$saludo['key3']}"; // Acceso a array
echo "Objeto: {$objSaludo->key1}";  // Propiedad de objeto
```

- Dentro de `""`, PHP sustituye variables por su valor.
- Las llaves `{}` permiten expresiones complejas: llamadas a funciones, acceso a arrays, propiedades de objetos.

### Programación Orientada a Objetos (POO) básica

```php
class Saludo {
   public $key1 = 345;
   public $key2 = 25;
   public function key3(){
      return 'Dentro de método key3()';
   }
}
$objSaludo = new Saludo();
echo $objSaludo->key1;     // 345
echo $objSaludo->key3();   // 'Dentro de método key3()'
```

| Concepto | Explicación |
|---|---|
| `class` | Define un molde/plantilla para crear objetos |
| `public` | La propiedad/método es accesible desde fuera |
| `new` | Crea una **instancia** (objeto) de la clase |
| `->` | Accede a propiedades y métodos del objeto |

---

## 5. `lecciones/index.php` — Página de bienvenida con imagen base64

```php
$miImagen = "R0lGODlhTgAwAPYAAA...";  // Cadena base64 muy larga
```

```html
<img src="data:image/gif;base64,<?php echo $miImagen;?>" alt="Logo de PHP" width="200">
```

### ¿Qué es base64?

- Es una forma de codificar datos binarios (como imágenes) en texto plano.
- Permite **incrustar imágenes directamente en el HTML** sin necesitar un archivo separado.
- `data:image/gif;base64,...` es un **Data URI**: le dice al navegador que los datos son una imagen GIF codificada en base64.

### Ventajas y desventajas

| Ventaja | Desventaja |
|---|---|
| No necesitas un archivo de imagen separado | El HTML se hace **enorme** |
| Funciona sin servidor de archivos | El navegador **no puede cachear** la imagen |
| Una sola petición HTTP | Es ~33% más grande que el archivo original |

### El resto del HTML

```html
<a href="https://...pdf">EBOOK: PHP 7 Real World Application Development</a>
<p>En este curso aprenderás los fundamentos de PHP...</p>
```

- Un enlace a un libro PDF de referencia.
- Texto introductorio del curso.

---

## 6. `lecciones/formatosDatos.php` — JSON en JavaScript

```javascript
<script>
let datos = {
   "ciudades" : ["Madrid", "Barcelona", "Valencia", "Sevilla", "Zaragoza"],
   "paises" : ["España", "Francia", "Italia", "Alemania", "Portugal"],
   "colores" : ["Rojo", "Verde", "Azul", "Amarillo"]
}
console.log(datos.ciudades[3]); // "Sevilla"
</script>
```

- Es **JavaScript puro**, no PHP. Demuestra la estructura **JSON** (JavaScript Object Notation).
- `datos` es un objeto con 3 propiedades, cada una es un array de strings.
- `datos.ciudades[3]` → Accede a la posición 3 (empezando desde 0): **"Sevilla"**.
- `console.log()` imprime en la **consola del navegador** (F12 → pestaña Console).

---

## 7. Archivos placeholder

### `lecciones/fechasCarbon.php`

```php
echo 'Estoy en el curso de fechas con Carbon';
```

Preparado para futuras lecciones sobre **Carbon** (librería para fechas en PHP).

### `lecciones/index.html`

Texto aleatorio de prueba para verificar que el servidor sirve HTML estático.

### `src/` — Vacío

Carpeta reservada para futuras clases de PHP (código fuente/lógica de negocio).

---

## Evolución respecto a la clase anterior (_10032026)

| Cambio | _10032026 | _11032026 |
|---|---|---|
| Estructura | 3 archivos sueltos | Carpetas organizadas (`lecciones/`, `vistas/`, `src/`) |
| Punto de entrada | Código directo | Usa `require_once` para cargar vistas |
| Configuración | No existía | Variable `$nombreApp` en `index.php` |
| Nuevos conceptos | Básicos: variables, echo, comillas | OOP, closures, interpolación avanzada, base64, tipos estrictos |
| Reutilización | Nada | Plantilla `inicio.php` reutilizable |
