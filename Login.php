<?php
    session_start();

    require_once("classes/Panier.php");
    require_once("config/config.inc.php");
    require_once('include/Fonctions.inc.php');

  $Message="";

  if(isset($_POST['submit'])) // le formulaire vient d'etre valide
    {
        $login=escape($_POST['login']);
        $passe=escape($_POST['passe']);

        openDB($dbURL,$dbUName,$dbPWord);
        selectDB($dbName);

        $result=query("SELECT *
               FROM client
               WHERE login='$login' AND motpasse='$passe'");
        
        if(mysql_num_rows($result)==0)
            $Message="Ce compte n'existe pas!<br />\n
                      Incrivez-vous <a href='Saisie.php'>ici</a>";
        else
        {
            $_SESSION['login']=$_POST['login'];
            header("Location:http://localhost/Eshopping/Accueil.php");

        }

        closeDB();
        
    }
?>
            <?php include 'include/header.php'; ?>

            <div id="content">
                <?php include 'include/nav.php'; ?>

                
                  <h2>Formulaire d'identification</h2>
                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                      <table border="0">
                         <tr><td>Login : </td>
                             <td><input type="TEXT" name="login"  value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>"></td>
                         </tr>
                         <tr><td>Mot de passe : </td>
                             <td><input type="PASSWORD" name="passe"  value="<?php if(isset($_POST['passe'])) echo $_POST['passe']; ?>"></td>
                         </tr>
                         <tr>
                             <td colspan="2"><a href="Saisie.php">Nouveau Client ?</a></td>
                         </tr>
                         <tr>
                            <td colspan="2">&nbsp;</td>
                         </tr>
                         <tr>
                            <td><input type="SUBMIT" name="submit" value="Envoyer" /></td>
                         </tr>

                         <tr>
                            <td colspan="2">&nbsp;</td>
                         </tr>
                      </table>
                    </form>

                <?php
                   if(!empty($Message)) echo "\n\n<br />$Message\n";

                ?>
            <?php include 'include/footer.php'; ?>