<?php

    session_start();

    require_once("classes/Panier.php");
    require_once("config/config.inc.php");
    require_once('include/Fonctions.inc.php');

    $Message="";

    if(isset($_POST['submit'])) // le formulaire vient d'etre valide
        {
          if(    !isset($_POST["nom"]) 		|| est_vide($_POST["nom"])
              || !isset($_POST["prenom"]) 	|| est_vide($_POST["prenom"])
              || !isset($_POST["login"]) 	|| est_vide($_POST["login"])
              || !isset($_POST["coord_banc"]) 	|| est_vide($_POST["coord_banc"])
              || !isset($_POST["passe"]) 	|| est_vide($_POST["passe"])
              || !isset($_POST["adresse"]) 	|| est_vide($_POST["adresse"])
              || !isset($_POST["cp"]) 		|| est_vide($_POST["cp"])
              || !isset($_POST["ville"]) 	|| est_vide($_POST["ville"])
            )
            { // formulaire a re-afficher
              if(est_vide($_POST["nom"]))     $Message.="<li>Le nom</li>\n";
              if(est_vide($_POST["prenom"]))  $Message.="<li>Le prénom</li>\n";
              if(est_vide($_POST["login"]))   $Message.="<li>Le login</li>\n";
              if(est_vide($_POST["coord_banc"]))   $Message.="<li>Les coordonnées bancaires</li>\n";
              if(est_vide($_POST["passe"]))   $Message.="<li>Le mot de passe</li>\n";
              if(est_vide($_POST["adresse"])) $Message.="<li>L'adresse</li>\n";
              if(est_vide($_POST["cp"]))      $Message.="<li>Le code postal</li>\n";
              if(est_vide($_POST["ville"]))   $Message.="<li>La ville</li>\n";
            }
          else
            { // on enregistre le client si, tout est bien rempli

                $nom=escape($_POST['nom']);
                $prenom=escape($_POST['prenom']);
                $login=escape($_POST['login']);
                $passe=escape($_POST['passe']);
                $coord_banc=escape($_POST['coord_banc']);
                $adresse=escape($_POST['adresse']);
                $code=escape($_POST['cp']);
                $ville=escape($_POST['ville']);
                $pays=escape($_POST['pays']);
                $telephone=escape($_POST['telephone']);

                openDB($dbURL,$dbUName,$dbPWord);
                selectDB($dbName);

                query("INSERT INTO client(id,nom,prenom,login,motpasse,coord_banc,adresse,code_postal,ville,pays,telephone)
                      VALUES ('','$nom','$prenom','$login','$passe','$coord_banc','$adresse','$code','$ville','$pays','$telephone')");

                closeDB();
                
                header("Location:http://localhost/Eshopping/Accueil.php");

            }
        }
    ?>

            <?php include 'include/header.php'; ?>

            <div id="content">
                <?php include 'include/nav.php'; ?>


                  <h2>Formulaire d'Inscription</h2>

                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                      <table border="0">
                         <tr><td>Nom : </td>
                             <td><input type="TEXT" name="nom"     value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>"></td>
                         </tr>
                         <tr><td>Pr&eacute;nom : </td>
                             <td><input type="TEXT" name="prenom"  value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>"></td>
                         </tr>
                         <tr><td>Login : </td>
                             <td><input type="TEXT" name="login"  value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>"></td>
                         </tr>
                         <tr><td>Mot de passe : </td>
                             <td><input type="PASSWORD" name="passe"  value="<?php if(isset($_POST['passe'])) echo $_POST['passe']; ?>"></td>
                         </tr>
                         <tr><td>Coordonnees bancaires : </td>
                             <td><input type="TEXT" name="coord_banc"  value="<?php if(isset($_POST['coord_banc'])) echo $_POST['coord_banc']; ?>"></td>
                         </tr>
                         <tr><td>Adresse :</td>
                             <td><input type="TEXT" name="adresse" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>"></td>
                         </tr>
                         <tr><td>Code postal :</td>
                             <td><input type="TEXT" name="cp"      value="<?php if(isset($_POST['cp'])) echo $_POST['cp']; ?>"></td>
                         </tr>
                         <tr><td>Ville :</td>
                             <td><input type="TEXT" name="ville"   value="<?php if(isset($_POST['ville'])) echo $_POST['ville'];else echo "Metz"; ?>"></td>
                         </tr>
                         <tr><td>Pays :</td>
                             <td><select name="pays">
                                    <option value="France">France</option>
                                </select>
                             </td>
                         </tr>
                         <tr><td>Numero de téléphone :</td>
                             <td><input type="TEXT" name="telephone"   value="<?php if(isset($_POST['telephone'])) echo $_POST['telephone']; ?>"></td>
                         </tr>
                      </table>
                      <input type="SUBMIT" name="submit" value="Envoyer">
                  </form>

                    <?php
                       if(!empty($Message)) echo "\n\n<br />$Message\n";
                    ?>

              </div>
            <?php include 'include/footer.php'; ?>