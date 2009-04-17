<?php


/**
 * @brief  Commande
 * Classe pour pour gerer les infos sur les commandes
 * @author Tinesoft
 */
class Commande
{
    private $id;
    private $idClient;
    private $date;
    private $montant;
    private $tabIdProduitsCmd;


    /**
     * @brief 
     * Constructeur de la classe Commande
     */
     public function _construct($id,$idClient,$date,$montant)
     {
         $this->id=$id;
         $this->idClient=$produit;
         $this->date=$date;
         $this->montant=$montant;
     }

     public function getId()
     {
         return $this->id;
     }

     public function getIdClient()
     {
         return $this->idClient;
     }

     public function getMontant()
     {
         return $this->montant;
     }

     public function getDate()
     {
         return $this->date;
     }

     public function afficher()
     {

     }
}
?>
