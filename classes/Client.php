<?php

/**
 * @brief  Client
 * Classe pour stocker et manipuler plus facilement
 * les informations sur un client de la boutique
 * @author Tinesoft
 */
class Client
{
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $adresse;
    private $telephoneFixe;
    private $telephonePortable;
    private $email;
    private $login;
    private $motPasse;
    private $coordBancaires;

    /**
     * @brief 
     * Constructeur de la classe Client
     */
     public function _construct($nom,$prenom,$date,$adresse,$telFixe,$telPortable,$email,$login,$motPasse,$coordBancaires)
     {
         $this->nom=$nom;
         $this->prenom=$prenom;
         $this->dateNaissance=$date;
         $this->adresse=$adresse;
         $this->telephoneFixe=$telFixe;
         $this->telephonePortable=$telPortable;
         $this->email=$email;
         $this->login=$login;
         $this->motPasse=$motPasse;
         $this->coordBancaires=$coordBancaires;

     }


     public function getNom()
     {
         return $this->nom;
     }

     public function getPrenom()
     {
         return $this->prenom;
     }

     public function getAdresse()
     {
         return $this->adresse;
     }

     public function getDateNaissance()
     {
         return $this->dateNaissance;
     }

     public function getEmail()
     {
         return $this->email;
     }

     public function getLogin()
     {
         return $this->login;
     }

     public function getMotPasse()
     {
         return $this->motPasse;
     }

     public function getCoordBancaires()
     {
         return $this->coordBancaires;
     }
  
     public function getTelephoneFixe()
     {
         return $this->telephoneFixe;
     }

     public function getTelephonePortable()
     {
         return $this->telephonePortable;
     }

     public function setNom($nom)
     {
         $this->nom=$nom;
     }
    
     public function setPrenom($prenom)
     {
        $this->prenom=$prenom;
     }

     public function setAdresse($adresse)
     {
         $this->adresse=$adresse;
     }

     public function setDateNaissance($date)
     {
        $this->dateNaissance=$date;
     }

     public function setEmail($mail)
     {
         $this->email=$mail;
     }

     public function setLogin($login)
     {
         $this->login=$login;
     }

     public function setMotPasse($mot)
     {
         $this->motPasse=$mot;
     }

     public function setCoordBancaires($coordonnees)
     {
        $this->coordBancaires=$coordonnees;
     }

     public function setTelephoneFixe($telephone)
     {
        $this->telephonePortable=$telephone;
     }

     public function setTelephonePortable($telephone)
     {
        $this->telephonePortable=$telephone;
     }
}
?>
