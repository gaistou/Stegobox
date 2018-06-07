<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$uploads_dir = "uploads";

if(isset($_POST['mon_image']) AND isset($_POST['mon_mdp']))
{
	if(!file_exists($_POST['mon_image'].".txt"))
	{	
		$retour = shell_exec("./steghide_decrypt.sh ".$uploads_dir."/".$_POST['mon_image']." ".$_POST['mon_mdp']." 2>&1");
		echo $retour;
		echo "<br/>";
	}
	else
	{
		echo "Le message a déjà été révelé";
	}

	$file = fopen($_POST['mon_image'].".txt", 'r');
	$message = fgets($file);
	echo "<br/>";
	echo $message;
	fclose($file);
}
?>