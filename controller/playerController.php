<?php
//LE CONTROLLER pour la class PlayerController
class PlayerController extends AbstractController{
    
    //ATTRIBUTS
    private ?ViewPlayer $player;
    
    //CONSTRUCTEUR
    public function __construct(?ViewPlayer $player,?ViewHeader $header,?ViewFooter $footer,?InterfaceModel $model) {
        parent::__construct($header, $footer, $model);
        $this->player = $player;
    }
    
    //METHODES
    public function render():void {
        //Récupération des données
        $playeurModel = $this->getModel();
       $message = $this->getModel()->add();

         //Puis Affichage
         echo $this->header->displayView();
         echo $this->player->setSignUpMessage($message)->displayView();
         echo $this->footer->displayView();
    }

    public function addPlayer():string{
        if(isset($_POST["signUp"])){
            //vérifier que les données sont présentes
            if(empty($_POST['pseudo'])|| empty($_POST['email'])|| empty($_POST['password'])|| empty($_POST['score'])){
                //msg erreur
                return '<p>Veuillez remplir tous les champs</p>';
            }
            //vérifier le format des données
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                //msg erreur
                return '<p>Email non valide</p>';
            }
            //nettoyer les données
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $score = sanitize($_POST['score']);
            $password = sanitize($_POST['password']);
             //hasher le mdp   
             $password = password_hash($password, PASSWORD_DEFAULT);
            //vérifier que l'email n'existe pas
            $data = $this->getModel()->setEmail($email)->getByEmail();
            var_dump($data);
    
            if($data){
                return '<p>Email déjà utilisé</p>';
            }
            //envoyer les données à la bdd
            return $this->getModel()->setPseudo($pseudo)->setPassword($password)->add();
    
        } 
    }

    public function getAllPlayers():string{

    }

    
}