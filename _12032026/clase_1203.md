# Clase 12/03/2026 — Explicación detallada

## Estructura de la carpeta

Esta es la **tercera clase del curso** (12 de marzo de 2026). Es casi idéntica a la clase anterior (`_11032026`), pero con mejoras clave en el archivo `tipos.php` y la adición de `phpinfo.php` y `snippets.php`.

```
_12032026/
├── index.php          ← Punto de entrada principal
├── phpinfo.php        ← Diagnóstico del servidor (NUEVO)
├── lecciones/         ← Ejercicios individuales
│   ├── contactar.php      ← Funciones de salida + OOP básica
│   ├── fechasCarbon.php   ← Placeholder para Carbon
│   ├── formatosDatos.php  ← JSON en JavaScript
│   ├── index.html         ← Texto de prueba
│   ├── index.php          ← Página de bienvenida con imagen base64
│   ├── snippets.php       ← Archivo vacío para fragmentos (NUEVO)
│   └── tipos.php          ← Tipos de datos y arrays (MEJORADO)
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

Igual que en la clase anterior:
- Define la variable global `$nombreApp`.
- Carga la vista principal con `require_once`.

---

## 2. `phpinfo.php` — Diagnóstico del servidor (NUEVO)

```php
phpinfo();
var_dump($_SERVER);
```

Este archivo es **nuevo** respecto a `_11032026`. Sirve para inspeccionar el servidor:

### `phpinfo()`

Genera una página entera con **toda la configuración de PHP**:
- Versión de PHP instalada
- Módulos activos (mysqli, curl, gd, etc.)
- Directivas de configuración (`php.ini`)
- Variables de entorno del sistema
- Información del servidor Apache/XAMPP

Es una herramienta de **diagnóstico** — en producción nunca deberías dejar este archivo accesible porque expone información sensible del servidor.

### `$_SERVER`

Es una **variable superglobal** (disponible en cualquier parte del código sin necesidad de declararla). Es un array asociativo con información sobre:

| Clave | Contenido |
|---|---|
| `$_SERVER['SERVER_NAME']` | Nombre del servidor (ej: `localhost`) |
| `$_SERVER['REQUEST_METHOD']` | Método HTTP (GET, POST...) |
| `$_SERVER['SCRIPT_FILENAME']` | Ruta completa del archivo que se ejecuta |
| `$_SERVER['REMOTE_ADDR']` | IP del visitante |
| `$_SERVER['HTTP_USER_AGENT']` | Navegador del visitante |
| `$_SERVER['DOCUMENT_ROOT']` | Carpeta raíz del servidor web |

---

## 3. `vistas/inicio.php` — Plantilla HTML

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

Idéntica a la clase anterior. La variable `$nombreApp` viene del `index.php` que hace el `require_once`.

**Nota**: Al inicio del archivo hay un texto suelto `strict` — parece un error o residuo de haber escrito `declare(strict_types=1)` pero sin la sintaxis correcta. No causa error porque PHP no lo interpreta como código (está fuera de `<?php ?>`), pero se imprime como texto en el navegador.

---

## 4. `lecciones/tipos.php` — Tipos de datos y Arrays (MEJORADO)

Este es el archivo que más ha cambiado respecto a `_11032026`. Ahora el `declare(strict_types=1)` está **correctamente en la primera línea** y hay mucho más contenido sobre arrays.

### `declare(strict_types=1)` — Ahora bien colocado

```php
<?php
declare(strict_types=1);
```

En la clase anterior (`_11032026`) estaba mal ubicado (después de código). Ahora está en la **primera instrucción** del archivo, donde debe estar para funcionar. Con esto activado, PHP no convierte tipos automáticamente en llamadas a funciones.

### Variables y tipos básicos

```php
$nombreCliente = '';              // string vacío
$importe = 8897907908;            // integer (número entero)
$totalDespuesImpuestos = 98797.78; // float (número decimal)
$telefono = '654885875';          // string (¡NO número!)
$nombreCliente = 'Yo';           // reasignación
```

**¿Por qué `$telefono` es string y no int?**
- Los teléfonos pueden empezar por `0` (ej: `0034654...`). Si fuera número, PHP eliminaría los ceros iniciales.
- No vas a hacer operaciones matemáticas con un teléfono.
- **Regla**: si no vas a sumar/restar/multiplicar el dato, hazlo string.

### Arrays indexados (por posición)

```php
$notas = [5, 7, 10, 7, 8];
```

| Posición | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| Valor | 5 | 7 | 10 | 7 | 8 |

### Arrays asociativos y mixtos

```php
$notas = [
   3 => 5,          // clave numérica explícita: 3
   'mates' => 7,    // clave string
   1000,            // sin clave → PHP asigna 4 (siguiente después de 3)
   15 => 10,        // clave numérica explícita: 15
   'lengua' => 7,   // clave string
   8                // sin clave → PHP asigna 16 (siguiente después de 15)
];
```

El array resultante es:

| Clave | Valor | ¿Por qué esa clave? |
|---|---|---|
| `3` | `5` | Clave explícita |
| `'mates'` | `7` | Clave string explícita |
| `4` | `1000` | PHP autoasigna: siguiente int después de 3 |
| `15` | `10` | Clave explícita |
| `'lengua'` | `7` | Clave string explícita |
| `16` | `8` | PHP autoasigna: siguiente int después de 15 |

**Lección clave**: PHP asigna automáticamente la clave numérica como el **mayor entero usado + 1**. Las claves string no afectan este conteo.

### Modificar y añadir elementos

```php
$notas[2] = 178;    // Crea la clave 2 con valor 178 (no existía)
$notas[] = 'Esto es una prueba a ver que pasa';  // Clave 17 (16 + 1)
```

- `$notas[2] = 178`: Asigna valor a la clave `2`. Como no existía, la **crea**.
- `$notas[] = ...`: Los corchetes vacíos `[]` añaden un elemento al final con la siguiente clave numérica disponible.

### Arrays anidados (multidimensionales)

```php
$prueba = [
   'a' => 2,
   'b' => 'ASDF',
   'c' => array(4, 5, 6)    // Un array DENTRO de otro array
];

$prueba[] = 'A ver que sale';    // Clave 0 (primera numérica disponible)
var_dump($prueba['c'][1]);       // Accede al segundo elemento del sub-array → int(5)
```

- `array(4, 5, 6)` es la **sintaxis antigua** para crear arrays (equivalente a `[4, 5, 6]`). Ambas funcionan igual.
- `$prueba['c']` devuelve `[4, 5, 6]`, y luego `[1]` accede a la posición 1: **`5`**.
- `var_dump()` muestra: `int(5)`.

**Estructura visual de `$prueba`:**

```
$prueba = [
   'a' => 2,
   'b' => 'ASDF',
   'c' => [4, 5, 6],       ← $prueba['c'][1] = 5
   0   => 'A ver que sale'  ← añadido con $prueba[]
]
```

---

## 5. `lecciones/contactar.php` — Funciones de salida y OOP

Idéntico a la clase anterior. Resumen de lo que cubre:

| Concepto | Descripción |
|---|---|
| `echo`, `var_dump()`, `print_r()`, `printf()` | Diferentes formas de imprimir en PHP |
| Funciones anónimas (closures) | `$fn = function() { ... };` |
| Funciones variables | `$fn2 = 'mifuncion'; $fn2();` |
| Interpolación en comillas dobles | `"Valor: {$array['key']}"` |
| Clases y objetos (POO) | `class`, `new`, `->`, `public` |

---

## 6. `lecciones/index.php` — Página de bienvenida

Igual que en `_11032026`:
- Imagen del logo PHP incrustada en **base64** (Data URI).
- Enlace al ebook de PHP 7.
- Texto introductorio del curso.

---

## 7. Archivos sin cambios / placeholder

| Archivo | Contenido |
|---|---|
| `lecciones/formatosDatos.php` | JSON en JavaScript (`console.log(datos.ciudades[3])` → "Sevilla") |
| `lecciones/fechasCarbon.php` | Solo un `echo`. Placeholder para librería Carbon |
| `lecciones/snippets.php` | Solo `<?php`. **Nuevo**: reservado para fragmentos de código |
| `lecciones/index.html` | Texto aleatorio de prueba |
| `src/` | Carpeta vacía, reservada para clases PHP |

---

## Evolución respecto a la clase anterior (_11032026)

| Cambio | _11032026 | _12032026 |
|---|---|---|
| `phpinfo.php` | No existía | **Nuevo**: diagnóstico del servidor con `phpinfo()` y `$_SERVER` |
| `snippets.php` | No existía | **Nuevo**: archivo para fragmentos de código |
| `tipos.php` | Básico: type juggling, `strict_types` mal colocado | **Mejorado**: `strict_types` correcto, arrays indexados, asociativos, mixtos, anidados |
| Nuevos conceptos | Type juggling, `var_dump` básico | Arrays mixtos, claves auto-asignadas, arrays multidimensionales, `array()` vs `[]` |
| `vistas/inicio.php` | Limpio | Tiene un texto residual `strict` al inicio (probable error) |

---

## Resumen de conceptos aprendidos en esta clase

| Concepto | Dónde se practica |
|---|---|
| `phpinfo()` y `$_SERVER` | `phpinfo.php` |
| `declare(strict_types=1)` bien colocado | `lecciones/tipos.php` |
| Arrays indexados | `$notas = [5, 7, 10, 7, 8]` |
| Arrays asociativos | `'mates' => 7` |
| Arrays mixtos (claves numéricas + string) | `$notas` con claves mixtas |
| Auto-asignación de claves numéricas | `1000` sin clave → PHP asigna `4` |
| Arrays anidados/multidimensionales | `$prueba['c'] => array(4, 5, 6)` |
| Acceso a arrays anidados | `$prueba['c'][1]` → `5` |
| Añadir elementos con `[]` | `$notas[] = 'texto'` |
| Sintaxis antigua `array()` vs moderna `[]` | `array(4, 5, 6)` = `[4, 5, 6]` |
