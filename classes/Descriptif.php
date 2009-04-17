<?php

/**
 * @brief  Descriptif
 * Classe de base pour stocker les infos d'un descriptif
 * @author Tinesoft
 */
class Descriptif
{

    private $nom;
    /**
     * @brief
     * Constructeur de la classe Descriptif
     */
    public function Descriptif($nom)
     {
         $this->nom=$nom;
     }

    public function _construct($nom)
     {
         echo "cons desc , v=$nom<br>";
         $this->nom=$nom;
     }

     public function getNom()
     {  
         return $this->nom;
     }

     public function setNom($nom)
     {
         $this->nom=$nom;

     }

     public function afficher()
     {
         echo "\t<li><a href='AccesPar.php?descriptif=$this->nom'>$this->nom</a></li>\n";
     }


}
?>
