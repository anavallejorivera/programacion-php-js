# Clase 10/03/2026 — Explicación detallada

## Estructura de la carpeta

Esta es la **primera clase del curso** (10 de marzo de 2026). La estructura es muy sencilla — solo 3 archivos sin subcarpetas:

```
_10032026/
├── index.php       ← Página principal con los primeros conceptos de PHP
├── index.html      ← Archivo HTML de prueba
└── contactar.php   ← Página de contacto con funciones de salida
```

---

## 1. `index.php` — Tu primer archivo PHP

Este archivo enseña los **fundamentos más básicos** de PHP mezclado con HTML.

### Estilos CSS y JavaScript inline

```html
<style>
   body { font-family: Arial, Helvetica, sans-serif; }
</style>
<script>
   alert('Hola mundo');
</script>
```

- Antes del código PHP hay HTML normal: un bloque `<style>` que cambia la fuente de toda la página, y un `<script>` que muestra una **alerta** del navegador con "Hola mundo".
- Esto demuestra que un archivo `.php` puede contener **HTML, CSS y JavaScript normalmente**. PHP solo se ejecuta dentro de las etiquetas `<?php ... ?>`.

### Funciones en PHP

```php
function sumar($a, $b) {
   echo $a + $b;
}
```

- **`function`**: Palabra clave para declarar una función.
- **`$a, $b`**: Son **parámetros** (valores que recibe la función). En PHP todas las variables empiezan con `$`.
- **`echo $a + $b`**: Imprime directamente el resultado de la suma.
- **Nota**: Esta función se declara pero **nunca se llama** en el código. Es solo una práctica de sintaxis.

### Variables y tipos de comillas

```php
$valor = 1 * 5 . ' Valor o cosa que me acabo de inventar';
$curso = "PHP Y JAVASCRIPT $valor";
$valor2 = 'Otra cosa $valor';
```

| Línea | Qué hace | Resultado |
|---|---|---|
| `$valor = 1 * 5 . ' Valor...'` | Multiplica `1 * 5 = 5`, luego **concatena** (`.`) con el string | `"5 Valor o cosa que me acabo de inventar"` |
| `$curso = "... $valor"` | Comillas **dobles**: PHP **interpola** (sustituye) `$valor` por su contenido | `"PHP Y JAVASCRIPT 5 Valor o cosa..."` |
| `$valor2 = '... $valor'` | Comillas **simples**: PHP **NO interpola**. El `$valor` se queda literal | `"Otra cosa $valor"` |

**Lección clave**:
- **Comillas dobles `"`** → Las variables dentro se reemplazan por su valor
- **Comillas simples `'`** → Todo es texto literal, nada se reemplaza

### Operador de concatenación (`.`)

```php
$valor = 1 * 5 . ' Valor o cosa...';
```

- En PHP, el **punto (`.`)** une/concatena strings. Es el equivalente al `+` de JavaScript para strings.
- PHP primero calcula `1 * 5 = 5`, luego lo convierte a string y lo une con el texto.

### Caracteres de escape

```php
$caracteresDeEscape = "\nPRUEBA\tPRU         EBA\"\\\$";
```

| Secuencia | Significado |
|---|---|
| `\n` | **Salto de línea** (new line) — en HTML no se ve, pero sí en el código fuente |
| `\t` | **Tabulación** (tab) |
| `\"` | Comilla doble **literal** (escapada para que no cierre el string) |
| `\\` | Barra invertida **literal** |
| `\$` | Signo de dólar **literal** (escapado para que PHP no lo interprete como variable) |

**Importante**: Los caracteres de escape **solo funcionan con comillas dobles**. Con comillas simples, `\n` se imprime tal cual.

### Funciones de salida: `echo` vs `print`

```php
echo '<p><br />' . $caracteresDeEscape . '</p>';
print 'Hola mundo';
```

| Función | Características |
|---|---|
| `echo` | Puede imprimir **varios valores** separados por comas. No devuelve ningún valor. Es ligeramente más rápido. |
| `print` | Solo puede imprimir **un valor**. Siempre devuelve `1`. |

Ambos son **construcciones del lenguaje**, no funciones reales (por eso no necesitan paréntesis).

### Mezclar PHP y HTML

```html
<h1>BIENVENIDOS AL CURSO DE <?php echo '<i>' . $curso . '</i>'; ?></h1>
<p><?php echo $valor2;?></p>
```

- Puedes **salir de PHP** (cerrar `?>`) y escribir HTML normal, y luego volver a **entrar** (`<?php`).
- `<?php echo ... ?>` dentro de una etiqueta HTML inserta contenido dinámico.
- `'<i>' . $curso . '</i>'` concatena etiquetas HTML con la variable para que el texto salga en **cursiva**.

**Resultado visible en el navegador**:
> # BIENVENIDOS AL CURSO DE *PHP Y JAVASCRIPT 5 Valor o cosa que me acabo de inventar*
> Otra cosa $valor

---

## 2. `contactar.php` — Funciones de salida en detalle

### Estructura HTML

```html
<!DOCTYPE html>
<html lang="es">
<head>
   <title>CURSO DE PROGRAMACIÓN WEB: CONTACTAR</title>
   <style>
      body { font-family: Verdana, Arial, sans-serif; font-size: 19px; }
   </style>
</head>
```

- Es un documento HTML **completo** (a diferencia de `index.php` que no tiene `<!DOCTYPE>`).
- Usa estilos CSS inline para definir fuente y tamaño.

### Variables y `echo` con múltiples valores

```php
$uno = 1;
$dos = 2;
$tres = 3;

echo '<div>', $uno, '<br/>', $dos, '<br/>', $tres, '</div>';
```

- `echo` puede recibir **múltiples argumentos separados por comas**. Imprime cada uno en orden.
- `<br/>` es un salto de línea en HTML.
- Resultado: un `<div>` con los números 1, 2, 3 en líneas separadas.

### `var_dump()` — Depuración detallada

```php
$valorDevuelto = var_dump($uno, $dos, $tres);
var_dump($valorDevuelto);
```

- **`var_dump()`** muestra el **tipo y valor** de cada variable: `int(1) int(2) int(3)`.
- `var_dump()` **no devuelve nada** (devuelve `NULL`), por eso `$valorDevuelto` es `NULL`.
- El segundo `var_dump($valorDevuelto)` imprime `NULL`.

### `print_r()` — Salida legible

```php
$valorDevuelto = print_r($uno);
var_dump($valorDevuelto);
```

- **`print_r()`** imprime el valor de forma más legible (sin mostrar el tipo). Para `$uno = 1`, imprime simplemente `1`.
- A diferencia de `var_dump()`, `print_r()` **sí devuelve un valor**: devuelve `1` (true/éxito).
- Por eso `var_dump($valorDevuelto)` imprime `int(1)`.

### `printf()` — Cadenas con formato

```php
printf('%d - %s', 5+3, 'AB' . (8/2));
```

| Parte | Significado |
|---|---|
| `'%d - %s'` | Plantilla: `%d` será reemplazado por un entero, `%s` por un string |
| `5+3` | Se calcula como `8` → reemplaza `%d` |
| `'AB' . (8/2)` | `8/2 = 4`, concatena con `'AB'` → `'AB4'` → reemplaza `%s` |

**Resultado**: `8 - AB4`

### `echo` con múltiples valores y concatenación

```php
echo 5+3, '-', 'AB' . (8/2);
```

- Mismo resultado que el `printf` anterior: `8-AB4`.
- La **coma** separa argumentos de `echo` (imprime uno tras otro).
- El **punto** concatena strings antes de imprimirlos.

**Diferencia clave**: La coma en `echo` es más eficiente que el punto, porque no crea un string intermedio. Pero solo funciona con `echo`.

---

## 3. `index.html` — Archivo de prueba

```
KAHJSDDKJHFL SKLJHDF ÑLAKJDSÑF LKJ ÑL KFJ ÑLKJF ÑLDSKJ
ASDFPOIU1OP4RÑ LKJASDDFLÑKJ 
098709879807
```

- Es texto aleatorio sin sentido. Sirve para **verificar que el servidor web (Apache/XAMPP)** sirve correctamente archivos HTML estáticos.
- De paso demuestra la diferencia: si visitas `index.html`, el servidor lo entrega tal cual. Si visitas `index.php`, el servidor **ejecuta PHP primero** y luego entrega el resultado.

---

## Resumen de conceptos aprendidos en esta clase

| Concepto | Dónde se practica |
|---|---|
| Mezclar PHP con HTML | `index.php` |
| Variables (`$`) | Ambos archivos |
| Comillas dobles vs simples (interpolación) | `index.php` |
| Concatenación con `.` | `index.php` |
| Caracteres de escape (`\n`, `\t`, `\"`, `\\`, `\$`) | `index.php` |
| Funciones (`function`) | `index.php` |
| `echo` y `print` | `index.php` |
| `var_dump()` | `contactar.php` |
| `print_r()` | `contactar.php` |
| `printf()` (formato) | `contactar.php` |
| Diferencia `.html` vs `.php` | `index.html` vs `index.php` |
