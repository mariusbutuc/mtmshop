<?php

/**
 * @brief  Propriete
 * Classe de base pour stocker les infos d'une propriete
 * @author Tinesoft
 */
class Propriete
{

    private $nom;
    private $valeur;
    /**
     * @brief
     * Constructeur de la classe Propriete
     */
    public function Propriete($nom,$valeur)
     {
         $this->nom=$nom;
         $this->valeur=$valeur;
     }

    public function _construct($nom,$valeur)
     {
         $this->nom=$nom;
         $this->valeur=$valeur;
     }

     public function getNom()
     {
         return $this->nom;
     }

     public function setNom($nom)
     {
         $this->nom=$nom;

     }

      public function getValeur()
     {
         return $this->valeur;
     }

     public function setValeur($valeur)
     {
         $this->valeur=$valeur;

     }

     public function afficher()
     {
         echo "\t<li><a href='AccesPar.php?propriete=$this->nom'>$this->nom</a></li>\n";
     }


}
?>
