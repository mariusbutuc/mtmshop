<?php
  /**
   * Creation des tables à  partir des requetes contenues dans le fichier
   * @param <type> $fichier
   */
  function creer_tables($fichier)
  {
      //on cree un tableau contenant chaque requete sql de creation de table
      //(les requetes se trouvent dans le fichier 'Tables.sql' séparés par ';'
      //la derniere case est supprimée car étant vide.
      $TabRequetes=explode(";",file_get_contents($fichier));
      unset($TabRequetes[count($TabRequetes)-1]);

      foreach($TabRequetes as $requete)
          query($requete);

  }

  /**
   * fonction  qui insere un descriptif dans la base de données.
   * Si il existe déja,aucune insertion n'est réalisée
   * Sinon, on l'insere. la fonction renvoie l'id du descr.
   * 
   * @param <type> : Descriptif à inserer
   * @return <type> : Id du descriptif.
   */
  function inserer_descriptif($descriptif)
  {
      //on verifie si le descriptif existe déja dans la table
      $r=query("SELECT  id FROM descriptif 
                WHERE nom='$descriptif'");

      if(mysql_num_rows($r)!=1)//le desciptif n'est pas encore dans la table
                                // on l'insere et on renvoie son id
      {
          $r=query("INSERT INTO descriptif(nom)
                    VALUES ('$descriptif')");

          return mysql_insert_id();             

      }
      else // le decriptif est déja dans la bdd
      {    // on renvoie juste son id
          return mysql_result($r, 0,"id");

      }      
      
  }
  
   /**
   * fonction  qui insere une rubrique dans la base de données.
   * Si elle existe déja,aucune insertion n'est réalisée
   * Sinon, on l'insere. la fonction renvoie l'id de la rubr.
   * 
   * @param <type>: Rubrique à inserer
   * @return <type> : Id de la rubrique
   */
  function inserer_rubrique($rubrique)
  {
     
      //on verifie si la rubrique existe déja dans la table
      $r=query("SELECT  id FROM rubrique 
                WHERE nom='$rubrique'");

      if(mysql_num_rows($r)!=1)//la rubrique n'est pas encore dans la table
                               // on l'insere et on renvoie son id
      {
          $r=query("INSERT INTO rubrique(nom)
                    VALUES ('$rubrique')");
          return mysql_insert_id();             

      }
      else // la rubrique est déja dans la bdd
      {    // on renvoie juste son id
         return mysql_result($r, 0,"id");

      }      
      
  }
  
     /**
   * fonction  qui insere une propriete dans la base de données.
   * Si elle existe déja,aucune insertion n'est réalisée
   * Sinon, on l'insere. la fonction renvoie l'id de la rubr.
   * 
   * @param <type>: propriete à inserer
   * @return <type> : Id de la propriete
   */
  function inserer_propriete($propriete)
  {
      //on verifie si la propriete existe déja dans la table
      $r=query("SELECT  id FROM propriete 
                WHERE nom='$propriete'");

      if(mysql_num_rows($r)!=1)//la propriete n'est pas encore dans la table
                               // on l'insere et on renvoie son id
      {
          $r=query("INSERT INTO propriete(nom)
                    VALUES ('$propriete')");

          return mysql_insert_id();             

      }
      else // la rubrique est déja dans la bdd
      {    // on renvoie son id
          return mysql_result($r, 0,"id");

      }      
      
  }
/**
 * fonction qui insere un produit décrit dans $ligne, dans la bdd.
 * @param <type> $ligne: Ligne contenant les informations sur le produit.
 * @param <type> $numero: Numero de la ligne dans le fichier 'Parametres.txt'
 * @return <type>
 */
  function insertion_produit($ligne,$numero)
  {

      $tableauChamps=explode(";",$ligne);
      $tableauProrietes=array();
      $tabDescriptifs=array();
      $tabRubriques=array();
      $tab=array();
      
      foreach( $tableauChamps as $champ)
      {
          if(eregi("^Propriete\((.+)\)=(.+)",$champ,$tab))
          {
              $tabProprietes[$tab[1]]=$tab[2];
          }
          else if(eregi("^Descriptif=(.+)",$champ,$tab))
          {
               $tabDescriptifs[]=$tab[1];
          }
          else if(eregi("^Rubriques=(.+)",$champ,$tabRubriques))
          {
              $tabRubriques[]=$tab[1];
          }
          else
          {
              echo "<p>
                        Erreur à la ligne '$numero': champs attendues :Propriete,Rubriques ou Descriptif.
                    </p>";
              return false;
          }
      }
      //on verifie que les champs obligatoires sont remplies
      $champsObligatoires="";
      if(! array_key_exists("Libelle",$tabProprietes))
            $champsObligatoires.="<li>Libelle</li>";

      if(! array_key_exists("Prix",$tabProprietes))
            $champsObligatoires.="<li>Prix</li>";

     if(! array_key_exists("UniteDeVente",$tabProprietes))
            $champsObligatoires.="<li>Prix</li>";

              
   
      //si les champs obligatoires d'un produit sont remplies
      // on insere le produit dans la base, sinon on affiche une erreur
      if($champsObligatoires!="")
      {
          echo "<p>
                    Erreur à la ligne $numero :<br />\n
                    Les champs suivants sont obligatoires:<br />\n
                    <ul>\n$champsObligatoires\n</ul>
               </p>";
          return false;
      }
      else
      {
          //on echappe les variables avant de les inserer
          $tabProprietes=escape($tabProprietes);
          $tabDescriptifs=escape($tabDescriptifs);
          $tabRubriques=escape($tabRubriques);
          
          //on insere le produit
          query("INSERT INTO produit(libelle,prix,unite_vente)
                 VALUES ('".$tabProprietes['Libelle']."','".
                 $tabProprietes['Prix']."','".$tabProprietes['UniteDeVente']."')");
          //on recupere son id
          $id_produit=mysql_insert_id();
           
             
          //on insere les descriptifs, si ils sont renseignés
          if(count($tabDescriptifs)>0)
          {   
              
              $tab=explode("|",$tabDescriptifs[0]);
              //variable pour mémoriser l'id du descriptif
              $id_descriptif;   
              
              foreach( $tab as $descriptif)
              {                                   
                 
                  $id_descriptif=inserer_descriptif($descriptif);                  
                  // on insere le descriptif du produit dans 'produit_descriptif'
                  $r=query("INSERT INTO produit_descriptif(id_prod,id_desc)
                               VALUES('$id_produit','$id_descriptif')");                      
                  
              }
          }
          
           //si aucune rubrique n'est rattaché au produit,
           // la rubrique par défaut est "Divers";
           if(count($tabRubriques)==0)
           {  
               $tabRubriques[]="Divers";
           }
           
          //on insere les rubriques
          $tab=explode("|",$tabRubriques[1]);
          //variable pour mémoriser l'id de la rubrique
          $id_rubrique;              
          foreach( $tab as $rubrique)
          {
                                
              $id_rubrique=inserer_rubrique($rubrique);  
              // on insere la rubrique  du produit dans 'produit_rubrique'
              $r=query("INSERT INTO produit_rubrique(id_prod,id_rubr)
                        VALUES('$id_produit','$id_rubrique')");                      

          }
          
          //on retire les proprietes fondamentales du produits
          //( car ayant déja été renseignées dans la produit
          unset($tabProprietes['Libelle'],$tabProprietes['Prix'],$tabProprietes['UniteDeVente']);
          
          //variable pour mémoriser l'id de la propriete
          $id_propriete;
          //on insere les autres prorietes du produit(photo, ...) 
          foreach( $tabProprietes as $propriete=>$valeur)
          {
              $id_propriete=inserer_propriete($propriete);        
              // on insere la propriete  du produit dans 'produit_propriete'
              $r=query("INSERT INTO produit_propriete(id_prod,id_prop,valeur_prop)
                        VALUES('$id_produit','$id_propriete','$valeur')");

          }            

          //tout s'est bien passé
          return true;

      }





  }
/**
 * fonction qui insere une rubrique décrite dans $ligne, dans la bdd.
 * @param <type> $ligne: Ligne contenant les informations sur la rubrique.
 * @param <type> $numero: Numero de la ligne dans le fichier 'Parametres.txt'
 * @return <type>
 */
  function insertion_rubrique($ligne,$numero)
  {
      $tableauChamps=explode(";",$ligne);
      $tabInfoRubrique=array();
      $tab=array();
      foreach( $tableauChamps as $champ)
      {
          if(eregi("^Nom=(.+)",$champ,$tab))
          { 
              $tabInfoRubrique['Nom']=$tab[1];
          }
          else if(eregi("^RubriquesSuperieures=(.+)",$champ,$tab))
          {
              $tabInfoRubrique['RubriquesSuperieures']=$tab[1];
          }
          else
          {
              echo "<p>
                        Erreur à la ligne '$numero': champs attendues :Nom ou RubriquesSuperieures.
                    </p>";
              return false;
          }
      }
      //on verifie que les champs obligatoires sont remplies
      $champsObligatoires="";

      if(! array_key_exists("Nom",$tabInfoRubrique))
            $champsObligatoires.="<li>Nom</li>";

      if(! array_key_exists("RubriquesSuperieures",$tabInfoRubrique))
            $champsObligatoires.="<li>RubriquesSuperieures</li>";

      if(count($tabInfoRubrique)<2)
       {
          echo "<p>
                    Erreur à la ligne $numero :<br />\n
                    Les champs suivants sont obligatoires:<br />\n
                    <ul>\n
                        <li>Nom</li>
                        <li>RubriquesSuperieures</li>
                    </ul>
               </p>";
          return false;
      }


      //si les champs obligatoires d'une rubrique sont remplies
      // on insere la rubrique dans la base, sinon on affiche une erreur
      if($champsObligatoires!="")
      {
          echo "<p>
                    Erreur à la ligne $numero :<br />\n
                    Les champs suivants sont obligatoires:<br />\n
                    <ul>\n$champsObligatoires\n</ul>
               </p>";
          return false;
      }
      else
      {
          //on echappe les variables avant de les inserer
          $tabInfoRubrique=escape($tabInfoRubrique); 
                    
          
          //on recupere l'id des rubriques superieures
          $tabIdRubSup=array();
          $tab= explode("|",$tabInfoRubrique['RubriquesSuperieures']);
          foreach($tab as $rubrique)
            $tabIdRubSup[]=inserer_rubrique($rubrique);       
                  
          //on recupere l'id de la rubrique fille
          $id_rubrique=inserer_rubrique($tabInfoRubrique['Nom']) ;
          
          //on insere les rubriques superieures de la rubrique
          query("INSERT INTO rubrique_superieure(id_rubr_fils,id_rubr_pere)
                 VALUES ('$id_rubrique','".implode("'),('$id_rubrique','",$tabIdRubSup)."');");

        
          //tout s'est bien passé
          return true;

      }


  }
?>
