<?php 
session_start();

function debugga($nomeDato, $valore) {
	$_SESSION[$nomeDato] = $valore;
}

if(isset($_GET["view"])) {
	var_dump($_SESSION);
}

?>