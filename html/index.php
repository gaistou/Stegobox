 <!DOCTYPE html>
<html>
<body>

<h1> Bienvenue sur Stegobox</h1>
<h2> Cacher un texte dans un image </h2>
<br/>
<form method="post" action="reception.php" enctype="multipart/form-data">
	<label for="mon_fichier">Fichier (tous formats | max. 1 Mo) : </label><br/>
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
    <input type="file" name="mon_fichier" id="mon_fichier"/> <br/>
    <br/>
    <label for="mon_texte">Texte a cacher | max. 50 caractères :</label><br/>
    <input type="text" name="mon_texte" id="mon_texte" /><br/>
    <br/>
    <label for="mon_mdp">Passphrase : </label><br/>
    <input type="password" name="mon_mdp" id="mon_mdp" /><br/>
    <br/>
    <input type="submit" name="submit" value="Envoyer" />
</form>
<br/>

<h2> Decrpyter une image </h2>
<form method="post" action="decrypt.php">
	<label for="mon_image">Nom de l'image a decrypter (avec l'extension)</label><br/>
    <input type="text" name="mon_image" id="mon_image" /><br/>
    <br/>
    <label for="mon_mdp">Passphrase : </label><br/>
    <input type="password" name="mon_mdp" id="mon_mdp" /><br/>
    <br/>
    <input type="submit" name="submit" value="Envoyer" />
</form>

<br/>

<h2> Listing des images </h2>

<?php

$dir = 'uploads/*.{jpg,jpeg,gif,png}';
$files = glob($dir,GLOB_BRACE);
  
foreach($files as $image)
{ 
	$name = substr($image, 8);
	echo "<br/>";
	echo "<figure>";
	echo '<img src="'.$image.'" height="300" width="300"/>';
	echo '<figcaption>'.$name.'</figcaption>';
	echo "</figure>";
}
?>



</body>
</html> 