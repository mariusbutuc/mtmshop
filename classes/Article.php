<?php


/**
 * @brief  Article
 * Classe representant un article du panier.
 * @author Tinesoft
 */
class Article
{
    private $id;
    private $libelle;
    private $prix;
    private $photo;
    private $quantite;
    /**
     * @brief 
     * Constructeur de la classe Article
     */
     public function Article($id,$libelle,$prix,$photo)
     {
        $this->id=$id;
        $this->libelle=$libelle;
        $this->prix=$prix;
        $this->photo=$photo;
        $this->quantite=0;
     }

     public function _construct($id,$libelle,$prix,$photo)
     {
        $this->id=$id;
        $this->libelle=$libelle;
        $this->prix=$prix;
        $this->photo=$photo;
     }

     public function getId()
     {
         return $this->id;
     }

     public function getLibelle()
     {
         return $this->libelle;
     }

     public function getPrix()
     {
         return $this->prix;
     }

     public function getPhoto()
     {
         return $this->photo;
     }

     public function getQuantite()
     {
         return $this->quantite;
     }

     public function setQuantite($quantite)
     {
         $this->quantite=$quantite;
     }

     public function getTotal()
     {
         return $this->prix* intval($this->quantite);
     }


     public function afficher()
     {
         echo "
            <tr>\n
                \t<td><input type='checkbox' name='panier_delete[]' value='$this->id' /></td>
                \t<td>\n
                    \t\t<h3>\n
                        \t\t\t<a href='ProduitInfo.php?id_produit=$this->id'>\n
                            $this->libelle
                        \t\t\t</a>
                    \t\t</h3>\n

                    \t\t<a href='ProduitInfo.php?id_produit=$this->id'>\n
                        \t\t\t<img src='images/$this->photo' alt='$this->libelle' />\n
                    \t\t</a>\n
                \t\t</td>\n

                \t\t<td>\n
                    \t\t\t<input type='text' size='3' name='quantite' value='$this->quantite' />\n
                \t\t</td>\n

                \t\t<td>\n
                    \t\t\t<span class='prix'>".$this->getTotal()." &euro;</span>\n
                \t\t</td>\n
            </tr>\n";

         
     }
}
?>
