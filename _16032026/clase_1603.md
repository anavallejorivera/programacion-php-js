# Clase 16/03/2026 — Explicación detallada

## Estructura general del proyecto

La carpeta representa una clase del curso (16 de marzo de 2026) y está organizada siguiendo un patrón **MVC simplificado**: configuración separada, vistas separadas, assets (CSS/JS) separados, y lecciones individuales.

```
_16032026/
├── index.php          ← Punto de entrada principal
├── phpinfo.php        ← Diagnóstico del servidor
├── assets/            ← Recursos estáticos (CSS, JS, imágenes)
├── config/            ← Configuración global
├── lecciones/         ← Ejercicios individuales del curso
├── src/               ← (vacío, reservado para clases PHP)
└── vistas/            ← Plantillas HTML reutilizables
```

---

## 1. Punto de entrada: `index.php`

```php
require_once 'config/config.php';
require_once 'vistas/inicio.php';
```

- **`require_once`**: Incluye un archivo PHP una sola vez. Si ya fue incluido, no lo vuelve a cargar. Si el archivo no existe, PHP **detiene la ejecución** con un error fatal.
- Primero carga la **configuración** (variables globales como el nombre de la app), y luego carga la **vista principal** que genera el HTML.
- Este patrón es el concepto de **"controlador frontal"** (front controller): un único archivo recibe todas las peticiones y decide qué mostrar.

---

## 2. Diagnóstico: `phpinfo.php`

```php
phpinfo();
var_dump($_SERVER);
```

- **`phpinfo()`**: Muestra toda la información de la configuración de PHP en el servidor (versión, módulos activos, directivas, etc.). Es una herramienta de **diagnóstico**.
- **`$_SERVER`**: Es una variable **superglobal** de PHP (un array asociativo) que contiene información sobre el servidor y la petición HTTP actual (IP del cliente, método HTTP, ruta del script, etc.).
- **`var_dump()`**: Muestra el tipo y valor de una variable de forma detallada. Muy útil para **depuración**.

---

## 3. Configuración: `config/config.php`

```php
$nombreApp = 'Tienda virtual del curso de PHP';
```

- Define una variable global `$nombreApp` que se usa en todas las vistas como **título de la aplicación**.
- Separar la configuración en su propio archivo es una **buena práctica**: si necesitas cambiar el nombre de la app, solo modificas un archivo.

---

## 4. Vistas (plantillas HTML reutilizables)

### `vistas/head.generico.php`

```html
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title><?php echo $nombreApp; ?></title>
   <link rel="stylesheet" href="assets/css/main.css">
   <script src="assets/js/main.js"></script>
</head>
```

- Es una **plantilla parcial** que contiene la parte `<head>` del HTML, reutilizable en cualquier página.
- **`<?php echo $nombreApp; ?>`**: Inserta dinámicamente el valor de la variable definida en `config.php` dentro del `<title>`.
- Enlaza el archivo CSS y JS de la carpeta `assets/`.

### `vistas/inicio.php`

```php
require_once 'head.generico.php';
```

- Incluye el `<head>` genérico y luego define el `<body>` con `<header>`, `<main>` y `<footer>`.
- Usa `$nombreApp` dentro de un `<h1>` como título visible.
- El `<main>` y `<footer>` están vacíos: están preparados para ir añadiendo contenido.

---

## 5. Assets (recursos estáticos)

### `assets/css/main.css`

```css
* { margin: 0; padding: 0; box-sizing: border-box; }
h1 { text-align: center; }
```

- **Reset CSS**: El selector `*` aplica a **todos** los elementos, eliminando márgenes y padding por defecto del navegador.
- **`box-sizing: border-box`**: Hace que el padding y border se incluyan dentro del ancho/alto total del elemento (¡muy importante para maquetación!).

### `assets/js/main.js` — Vacío

Preparado para código JavaScript futuro.

---

## 6. Lecciones (ejercicios del curso)

### `lecciones/tipos.php` — Tipos de datos

```php
declare(strict_types=1);
```

- **`declare(strict_types=1)`**: Activa el **modo estricto de tipos**. PHP normalmente convierte tipos automáticamente (ej: `"5"` → `5`). Con esto activado, si una función espera un `int` y le pasas un `string`, PHP lanza un error.

**Conceptos que se practican:**

| Concepto | Ejemplo |
|---|---|
| Variables string | `$nombreCliente = 'Yo'` |
| Variables numéricas (int) | `$importe = 8897907908` |
| Variables numéricas (float) | `$totalDespuesImpuestos = 98797.78` |
| Arrays indexados | `$notas = [5, 7, 10, 7, 8]` — se acceden por posición (0, 1, 2...) |
| Arrays asociativos | `$notas = ['mates' => 7, 'lengua' => 7]` — se acceden por clave |
| Arrays mixtos | Mezcla de claves numéricas y string |
| Arrays anidados | `'c' => array(4, 5, 6)` — un array dentro de otro |
| Añadir elementos | `$notas[] = 'texto'` — añade al final |
| Acceso anidado | `$prueba['c'][1]` — accede al segundo elemento del sub-array |

---

### `lecciones/contactar.php` — Funciones de salida y OOP básica

Este archivo es muy completo. Enseña muchas cosas:

**Funciones de salida en PHP:**

| Función | Qué hace |
|---|---|
| `echo` | Imprime uno o más valores. No es una función, es una **construcción del lenguaje**. Puede recibir múltiples valores separados por comas. |
| `var_dump()` | Muestra tipo + valor de las variables. Devuelve `NULL`. |
| `print_r()` | Muestra el valor de forma legible. Devuelve `1` (true). |
| `printf()` | Imprime una cadena con **formato** (como en C). `%d` = entero, `%s` = string. |

**Funciones anónimas (closures):**

```php
$fn = function() { return '<h2>Dentro de función anónima</h2>'; };
```

- Una función **sin nombre** almacenada en una variable. Se llama con `$fn()`.

**Funciones variables:**

```php
$fn2 = 'mifuncion';
echo $fn2();  // Llama a mifuncion()
```

- Si una variable contiene el nombre de una función (como string), puedes **llamarla** añadiendo `()`.

**Interpolación de variables en strings:**

```php
echo "Valor: $var1";              // Variable simple
echo "Valor: {$fn()}";            // Llamada a función
echo "Valor: {$saludo['key3']}";  // Acceso a array
echo "Valor: {$obj->key1}";      // Propiedad de objeto
```

- Dentro de comillas dobles (`"`), PHP **sustituye** las variables por su valor. Las llaves `{}` permiten expresiones complejas.

**Programación Orientada a Objetos (POO) básica:**

```php
class Saludo {
    public $key1 = 345;
    public function key3() { return 'texto'; }
}
$objSaludo = new Saludo();
echo $objSaludo->key1;      // Acceder a propiedad
echo $objSaludo->key3();    // Llamar a método
```

- **`class`**: Define una plantilla/molde para crear objetos.
- **`public`**: La propiedad/método es accesible desde fuera de la clase.
- **`new`**: Crea una instancia (objeto) de la clase.
- **`->`**: Operador para acceder a propiedades y métodos de un objeto.

---

### `lecciones/inicio_1.php` — Mezclar PHP y HTML + Heredoc/Nowdoc

- Muestra cómo **alternar** entre PHP y HTML en un mismo archivo.
- `<?php echo $nombreApp; ?>` dentro del `<title>` y `<h1>` — inyecta PHP en HTML.
- La parte comentada (con `//`) muestra conceptos avanzados de strings:
  - **Heredoc** (`<<<NOMBRE ... NOMBRE;`): Cadenas multilínea que **sí** interpolan variables (como comillas dobles).
  - **Nowdoc**: Cadenas multilínea que **NO** interpolan variables (como comillas simples).

---

### `lecciones/inicio_2.php` — printf() y sprintf()

**`printf()`** vs **`sprintf()`**:

| Función | Qué hace | Devuelve |
|---|---|---|
| `printf()` | Imprime directamente la cadena formateada | La longitud de la cadena impresa (int) |
| `sprintf()` | **No imprime nada**, solo devuelve la cadena formateada | La cadena formateada (string) |

**Especificadores de formato:**

| Código | Significado | Ejemplo |
|---|---|---|
| `%s` | String | `"Coraline"` |
| `%d` | Entero decimal | `100` |
| `%.2f` | Float con 2 decimales | `0.05` |
| `%c` | Carácter (por código ASCII) | `87` → `W` |

---

### `lecciones/inicio_3.php` — Strings como arrays

```php
$cadenaPlantilla[11] = 'W-kjkljkljkkhlk';
```

- En PHP, puedes acceder a caracteres individuales de un string como si fuera un array, por **posición** (empezando en 0).
- **Pero**: Si asignas un string largo a una posición, **solo se reemplaza un carácter** (el primero del string asignado, es decir `W`). El resto se ignora silenciosamente.

---

### `lecciones/formatosDatos.php` — JSON en JavaScript

```javascript
let datos = { "ciudades": ["Madrid", ...], "paises": [...], "colores": [...] }
console.log(datos.ciudades[3]); // "Sevilla"
```

- Este archivo es **JavaScript puro** (no PHP). Muestra el formato **JSON** (JavaScript Object Notation).
- Un objeto con 3 propiedades, cada una contiene un **array** de strings.
- `datos.ciudades[3]` accede a "Sevilla" (posición 3, empezando desde 0).

---

### `lecciones/fechasCarbon.php` — Placeholder

Solo tiene un `echo`. Preparado para futuras lecciones sobre la librería **Carbon** (manejo avanzado de fechas en PHP).

### `lecciones/snippets.php` — Vacío

Solo la etiqueta `<?php`. Reservado para fragmentos de código de ejemplo.

### `lecciones/index.html` — Texto de prueba

Contiene texto aleatorio sin sentido. Probablemente se usó para probar que el servidor sirve archivos HTML estáticos.

---

## Resumen visual: flujo de la aplicación

```
Usuario visita index.php
        │
        ▼
config/config.php  →  define $nombreApp
        │
        ▼
vistas/inicio.php  →  incluye head.generico.php
        │                      │
        │                      ▼
        │              Genera <head> con título,
        │              CSS y JS
        ▼
Genera <body> con header, main, footer
```

Los archivos en `lecciones/` son **ejercicios independientes** que se visitan directamente por su URL (ej: `http://localhost/programacion-php-js/_16032026/lecciones/contactar.php`).
