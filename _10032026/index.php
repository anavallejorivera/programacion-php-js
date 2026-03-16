<style>
	body {
		font-family: Arial, Helvetica, sans-serif;
	}
</style>
<script>
	alert('Hola mundo');
</script>

<?php
	function sumar($a, $b) {
		echo $a + $b;
	}

	$valor = 1 * 5 . ' Valor o cosa que me acabo de inventar';
	$curso = "PHP Y JAVASCRIPT $valor";
	$valor2 = 'Otra cosa $valor';

	$caracteresDeEscape = "\nPRUEBA\tPRU         EBA\"\\\$";
	echo '<p><br />' . $caracteresDeEscape . '</p>';

	print 'Hola mundo';
?>

<h1>BIENVENIDOS AL CURSO DE <?php echo '<i>' . $curso . '</i>'; ?></h1>
<p><?php echo $valor2;?></p>