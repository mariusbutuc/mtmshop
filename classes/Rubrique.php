<?php

/**
 * @brief  Rubrique
 * Classe de base pour stocker les infos d'une rubrique
 * @author Tinesoft
 */
class Rubrique
{

    private $nom;
    /**
     * @brief 
     * Constructeur de la classe Rubrique
     */
    public function Rubrique($nom)
     {
         $this->nom=$nom;
     }
    public function _construct($nom)
     {
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
         echo "\t<li><a href='AccesPar.php?rubrique=$this->nom'>$this->nom</a></li>\n";
     }


}
?>
