<?php
	include_once("dBug.php");
	require_once("config/config.inc.php");
	require_once("include/Fonctions.inc.php");
	
	openDB($dbURL, $dbUName, $dbPWord);
	selectDB($dbName);
	
	$q = $_GET['q'];
	$punct = array("!", ",", ".", ":", ";", "?");
	$q = preg_replace('/\s\s+/', ' ', str_replace($punct, "", $q));
	$keywords = explode(" ", $q);
	
	$like = implode("%' OR nom LIKE '%", $keywords);
	$query = "SELECT id FROM produit WHERE libelle LIKE '%" . $like . "%'";
	
	
	//$query = "SELECT id_prod FROM produit_descriptif WHERE id_desc IN
	//			(SELECT id FROM descriptif WHERE nom LIKE '%" . $like . "%')";
	$query="SELECT p.id FROM produit p, produit_descriptif pd, descriptif d
			WHERE d.id=pd.id_desc AND pd.id_prod=p.id AND nom LIKE '%" . $like . "%'" ;
	$result = mysql_query($query) or die("$query<br />".mysql_error());
	new dBug($result); 
?>