<?php

/**
 * @brief  Produit
 * Classe pour stocker les infos sur un produit
 * @author Tinesoft
 */
class Produit
{
    private $numero;
    private $libelle;
    private $prix;
    private $uniteVente;
    private $tabDescriptifs;
    private $tabProprietes;
    private $tabRubriques;

    /**
     * @brief 
     * Constructeur de la classe Produit
     */
     public function Produit($numero,$libelle,$prix,$unite,$tabDescriptifs,$tabProprietes,$tabRubriques)
     {
        $this->numero=$numero;
        $this->libelle=$libelle;
        $this->prix=$prix;
        $this->uniteVente=$unite;
        $this->tabDescriptifs=$tabDescriptifs;
        $this->tabProprietes=$tabProprietes;
        $this->tabRubriques=$tabRubriques;

     }
     
     public function _construct($numero,$libelle,$prix,$unite,$tabDescriptifs,$tabProprietes,$tabRubriques)
     {
        $this->numero=$numero;
        $this->libelle=$libelle;
        $this->prix=$prix;
        $this->uniteVente=$unite;
        $this->tabDescriptifs=$tabDescriptifs;
        $this->tabProprietes=$tabProprietes;
        $this->tabRubriques=$tabRubriques;

     }
     public function getNumero()
     {
         return $this->numero;
     }

     public function getLibelle()
     {
         return $this->libelle;
     }
        
     public function getPrix()
     {
         return $this->prix;
     }   

     public function getUniteVente()
     {
         return $this->uniteVente;
     }

     public function getTabProprietes()
     {
         return $this->tabProprietes;
     }

     public function getTabDescriptifs()
     {
         return $this->tabDescriptifs;
     }

     public function getTabRubriques()
     {
         return $this->tabRubriques;
     }
   
     public function setTabDescriptifs($tabDescriptifs)
     {
         $this->descripstif=$tabDescriptifs;
     }

     public function setNumero($libelle)
     {
         $this->libelle=$libelle;
     }

     public function setLibelle($libelle)
     {
         $this->libelle=$libelle;
     }
     public function setUniteVente($unite)
     {
         $this->uniteVente=$unite;
     }
     public function setPrix($prix)
     {
         $this->prix=$prix;
     }
     public function setTabProprietes($tabProprietes)
     {
         $this->tabProprietes=$tabProprietes;
     }
     public function setTabRubriques($tabRubriques)
     {
         $this->tabRubriques=$tabRubriques;
     }
     
     public function getPhoto()
     {
         //on recherche si une propriete "Photo" existe
         for($i=0;$i<count($this->tabProprietes);$i++)
         {  
             if($this->tabProprietes[$i]->getNom()=="Photo")
             {
                $valeur=$this->tabProprietes[$i]->getValeur();
                unset($this->tabProprietes[$i]);
                return $valeur;
             }
             
         }         
         //sinon, on renvoie une image par défaut
         return "photo_defaut.png";         
     }
     
     public function afficherDescriptifs()
     {
         $n=count($this->tabDescriptifs);
         for($i=0 ; $i<$n ; $i++)
            $this->tabDescriptifs[$i]->afficher();

         if($n=="")
            echo "\t<li>Aucun descriptif trouvé.<li>\n";

     }

     public function afficherAutresProp()
     {
         $n=count($this->tabProprietes);
         for($i=0 ; $i<$n ; $i++)
            $this->tabProprietes[$i]->afficher();

         if($n=="")
            echo "\t<li>Aucune autre propriete trouvée.<li>\n";

     }
     
     public function afficherAutresRub()
     {
         $n=count($this->tabRubriques);
         for($i=0 ; $i<$n ; $i++)
            $this->tabRubriques[$i]->afficher();

         if($n=="")
            echo "\t<li>Aucune autre rubrique trouvée.<li>\n";
     }
     
     
    





    
}
?>
