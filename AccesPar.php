</html>
<head>
	<title>Accès par attribut</title>
	<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="white">
<font face="verdana">

<?php
  include("Parametres.php");
  include("Fonctions.inc.php");
  $id=mysql_connect($host,$user,$pass);
  mysql_select_db($base) or die("Impossible de sélectionner la base : $base");

  $AttributChoisi=$_GET["AttributChoisi"];
?>

<p align="center"><br />Accès par <b><?php echo $AttributChoisi; ?></b><br />
<ul>
<?php
  //Recherche des valeurs pour l'AttributChoisi
  $resultat = query("select DISTINCT $AttributChoisi from vehicule");
            	
  while($nuplet = mysql_fetch_array($resultat))
    { echo '
		<li><a href="ListeAnnonces.php?AttributChoisi='.$AttributChoisi
				.'&ValeurChoisie='.$nuplet[$AttributChoisi].'">'
				.$nuplet[$AttributChoisi].'</a>';
    }
  mysql_close();
?>

</ul>
</p>

</font>
</body>
</html>