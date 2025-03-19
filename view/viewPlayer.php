<?php
//LA VIEW POUR LA CLASS ViewPlayer

class ViewPlayer{

    //ATTRIBUTS
    private ?string $signUpMessage = '';
    private ?string $playerListe;

    //GETTER ET SETTER
    public function getSignUpMessage():string{
        return $this->signUpMessage;
    }
    public function setSignUpMessage(string $signUpMessage):self{
        $this->signUpMessage = $signUpMessage;
        return $this;
    }

    public function getPlayerListe(): ?string {return $this->playerListe;}
    public function setPlayerListe(?string $playerListe): self {$this->playerListe = $playerListe;return $this;}

    //METHODES
    /**
     * Fonction qui affiche le formulaire d'inscription
     * @return string
     */
    public function displayView():string{

        ob_start();
        ?>
        <h1>Accueil</h1>
        <h2>Inscription d'un joueur</h2>
        <form action='' method='POST'>
            <label for='pseudo'>Pseudo :</label><input type='text' name='pseudo' placeholder='Votre Pseudo'>
            <label for='email'>email :</label><input type='text' name='email' placeholder='Votre Email'>
            <label for='password'>Password :</label><input type='text' name='password' placeholder='Votre Mot de Passe'>
            <label for='score'>Votre score :</label><input type='text' name='score' placeholder='Votre score'>
            <input type="submit" name="signUp" value="S'inscrire">
        </form>
        <?php
        echo $this->getSignUpMessage();
        ?>
        
        <h1>list des joueurs</h1>
        <!--Afficher la liste des rôles -->
  
        
<?php
        echo $this->getPlayerListe();
        return ob_get_clean();
    }
    
}