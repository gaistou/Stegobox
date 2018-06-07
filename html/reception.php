<!DOCTYPE html>
<html>
<body>

<h2> Traitement : </h2>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$maxsize = $_POST['MAX_FILE_SIZE'];
$image_ok = 0;
$texte_ok = 0;
$traitement_ok = 0;

if (isset($_FILES['mon_fichier']) AND $_FILES['mon_fichier']['error'] == 0)
{
	
	echo "<br/>transfert correct";

	if ($_FILES['mon_fichier']['size'] < $maxsize) 
	{
		echo "<br/>taille fichier ok";

		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );
		if(in_array($extension_upload,$extensions_valides))
		{
			echo "<br/>Extension correcte";

			$uploads_dir = 'uploads';
			$tmp_name = $_FILES["mon_fichier"]["tmp_name"];
			$name = basename($_FILES["mon_fichier"]["name"]);
        	move_uploaded_file($tmp_name, "$uploads_dir/$name");

        	echo "<br/> Fichier enregistré ! <br/><br/>";
        	$image_ok = 1;
		} 
		else
		{
			echo "<br/>Extension incorrecte";
		}
	}
	else 
	{
		$erreur = "<br/>Le fichier est trop gros";
		echo $erreur;
	}
}
else
{
	$erreur = $_FILES['mon_fichier']['error'];	
	echo "<br/>Erreur lors du transfert code : " + $erreur;	
}

if(isset($_POST['mon_texte']))
{
	echo "texte okay";

	$filename = $name . ".txt";
	$text_file = fopen("$uploads_dir/$filename", "w");
	fwrite($text_file, $_POST['mon_texte']);
	fclose($text_file);

	echo "<br/>texte enregistré<br/><br/>";

	$texte_ok = 1;
}
else
{
	echo "texte pas okay";
}

if($image_ok AND $texte_ok AND isset($_POST['mon_mdp']))
{
	$retour = shell_exec("./steghide_encrypt.sh ".$uploads_dir."/".$name." ".$uploads_dir."/".$filename." ".$_POST['mon_mdp']." 2>&1");
	echo $retour;

	echo "<br/Traitement terminé !!";
	$traitement_ok = 1;
}
else
{
	echo "abort : Image ou texte incorrect";
}

if($traitement_ok)
{
	echo "<div>";
	echo '<img src="'.$uploads_dir."/".$name.'" height="300" width="300"/>';
	echo "</div>";
}
?>
<br/>
<a href="index.php"> Retour vers l'accueil </a>

</body>
</html> 
