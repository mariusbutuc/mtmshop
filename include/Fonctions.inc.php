<?php
/**
 * Ce fichier contient les fonctions de bases qui sont utilisées dans
 * la plupart des pages: exemple determiner si une variable est vide,...
 * 
 */
    
 /**
  * fonction qui renvoie vraie si la chaine est vide
  */
  function est_vide($chaine)
  {
    return (trim($chaine) == "");
  }

  /**
   * fonction qui retire tous les ' ' dans la chaine
   */

  function trim_all($chaine)
  {
    return str_replace(' ','',$chaine);
  }

  /*
Methode qui execute une requete SQL, et affiche
une erreur si la requete n' a pas aboutie.
Retourne le resultat de la requete SQL
*/
function  query($requete)
{
    $resultat=mysql_query($requete) or die("$requete : ". mysql_error());
    return $resultat;
}

/*
Methode qui connecte l'utilisateur donné
à la bdd et affiche l'erreur si elle se produit.
Retourne l'identifiant de connexion.
*/
function  openDB($dbURL,$dbUName,$dbPWord)
{
    $connexion = mysql_connect($dbURL,$dbUName,$dbPWord)
                     or die ("Erreur de connexion à la base <em>$dbName</em>: ".mysql_error());
    return $connexion;
}

/*Methode qui connecte l'utilisateur donné
à la bdd et affiche l'erreur si elle se produit.
Retourne l'identifiant de connexion.
*/
function  closeDB()
{
    mysql_close()   or die ("Erreur de fermeture de la base <em>$dbName</em>: ".mysql_error());

}
/*
Methode selectionne la base donnée
et affiche l'erreur si elle se produit.
*/
function selectDB($dbName)
{
    mysql_select_db($dbName)
      or die("Impossible de sélectionner la base <em>$dbName</em>: ".mysql_error());

}

/**
* méthode qui echappe la variable passée en parametre
* @param <type> $varaiable : Variable à echapper
*/
  function escape($variable)
  {
      if(!is_array($variable))
        return addslashes(rtrim($variable));

      foreach($variable as $cle=>$valeur)
        $variable[$cle]=addslashes(rtrim($valeur));
      return $variable;
  }

  /**
   * méthode qui (desechappe) :) la variable passée en parametre
   * @param <type> $varaiable : Variable à desechapper
   */
  function unescape($variable)
  {
      if(!is_array($variable))
        return stripslashes(rtrim($variable));

      foreach($variable as $cle=>$valeur)
        $variable[$cle]=stripslashes(rtrim($valeur));
      return $variable;

  }
/**
 * methode qui verifie si le code postal donné est valide
 * @param <type> $codepostal
 * @return <type> true ou false
 */
  function code_valide($codepostal)
  {
      return eregi("^[0-9]{5}$",$codepostal);

  }

  /**
   * methode qui vérifie si le telephone donné est valide
   * @param <type> $tel
   * @return <type> true ou false
   */
  function telephone_valide($tel)
  {
      return eregi("^0[0-9]{9}",$tel);

  }

  function getNbArticlesPanier()
  {

    $panier;
    //si le panier n'existe pas encore, on en cree
    //un, sinon on le recupere de la session.
    if(!isset($_SESSION["panier"]))
    {
        $panier=new Panier();
    }
    else
    {
        $panier=unserialize( $_SESSION["panier"]);
    }

    return $panier->getNbArticles();
  }

    /*
    Methode qui retourne les rubriques engistrées dans la table
    'rubrique'. Retourne un tableau de noms de  Rurbiques.
    */
    function getRubriques($dbURL,$dbUName,$dbPWord,$dbName)
    {
        $tabRubriques=array();
        
        openDB($dbURL,$dbUName,$dbPWord);
        selectDB($dbName);

        $result = query("SELECT nom FROM rubrique");

        while($ligne = mysql_fetch_assoc($result))
        {
            $nom = $ligne['nom'];
            //on ajoute la rubrique au tableau résultat
            $tabRubriques[] = $nom;

        }
        closeDB();
        return $tabRubriques;
    }

?>
