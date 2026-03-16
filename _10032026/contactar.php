<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CURSO DE PROGRAMACIÓN WEB: CONTACTAR</title>
      <style>
         body {
            font-family: Verdana, Arial, sans-serif;
            font-size: 19px;
         }
      </style>
   </head>
   <body>
      <h1>CONTACTAR</h1>
      <p>
         Si deseas contactarnos, por favor envíanos un correo electrónico a
         <a href="mailto:prueba@gmail.com">
            prueba@gmail.com
         </a>
      </p>
      <?php
         $uno = 1;
         $dos = 2;
         $tres = 3;

         echo '<div>',
            $uno,
            '<br/>',
            $dos,
            '<br/>',
            $tres,
            '</div>';
         
         echo '<pre>';
         $valorDevuelto = var_dump($uno, $dos, $tres);
         var_dump($valorDevuelto);
         echo '</pre>';

         echo '<pre>';
         $valorDevuelto = print_r($uno);
         var_dump($valorDevuelto);
         echo '</pre>';

         printf('%d - %s', 5+3, 'AB' . (8/2));

         echo 5+3, '-', 'AB' . (8/2);
      ?>
   </body>
</html>