<?php

include("Article.php");
/**
 * @brief  Panier
 * Classe représentant un panier d'articles
 * @author Tinesoft
 */
class Panier
{
    private $tabArticles;
    private $coutTotal;
    private $nbArticles;
    /**
     * @brief 
     * Constructeur de la classe Panier
     */
     public function Panier()
     {
         $this->tabArticles=array();
         $this->coutTotal=0;
         $this->nbArticles=0;

     }
     public function __construct()
     {
         $this->tabArticles=array();
         $this->coutTotal=0;
         $this->nbArticles=0;
     }

     public function getNbArticles()
     {
         return $this->nbArticles;
     }

      public function getTabArticles()
     {
         return $this->tabArticles;
     }

     public function getCoutTotal()
     {
         return $this->coutTotal;
     }
     public function getArticle($id)
     {
         return $this->tabArticles[$id];
     }
     /**
      * méthode qui ajoute un article dans le panier
      * @param <type> $article :Article à ajouter
      */
     public function ajouterArticle($article)
     {
         //si l'article n'est pas encore dans le panier on l'ajoute
         $id=$article->getId();
         if(!isset($this->tabArticles[$id]))
         {
            $this->tabArticles[$id]=$article;            
         }
         
         //on met à jour la qté de l'article et le cout total du panier
         $qte_article= $this->tabArticles[$id]->getQuantite();

         $this->tabArticles[$id]->setQuantite($qte_article+1);

         $this->coutTotal+=$article->getPrix();
         $this->nbArticles++;

     }
     /**
      * méthode qui retire un article donné du panier.
      * @param <type> $id : Identifiant de l'article à retirer
      */
     public function retirerArticle($id)
     {

         $qte_article  = $this->tabArticles[$id]->getQuantite();
         $prix_article = $this->tabArticles[$id]->getPrix();

         $this->coutTotal-=  $qte_article*$prix_article;

         unset($this->tabArticles[$id]);
          $this->nbArticles--;

     }

     public function afficher()
     {
         foreach ($this->tabArticles as $article)
         {
             $article->afficher();
         }
     }
}
?>
