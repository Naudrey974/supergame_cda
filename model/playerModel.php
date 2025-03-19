<?php
//MODEL POUR LA CLASS ModelPlayer

class PlayerModel implements InterfaceModel{

    //ATTRIBUTS
    private ?PDO $bdd;
    private ?int $id = null;
    private ?string $pseudo = null;
    private ?string $email = null;
    private ?int $score = null;
    private ?string $password = null;

    //GETTER ET SETTER
    public function getBdd(): ?PDO {return $this->bdd;}
    public function setBdd(?PDO $bdd): self {$this->bdd = $bdd;return $this;}

    public function getId(): ?int {return $this->id;}
    public function setId(?int $id): self {$this->id = $id;return $this;}

    public function getPseudo(): ?string {return $this->pseudo;}
    public function setPseudo(?string $pseudo): self {$this->pseudo = $pseudo;return $this;}

    public function getEmail(): ?string {return $this->email;}
    public function setEmail(?string $email): self {$this->email = $email;return $this;}

    public function getscore(): ?int {return $this->score;}
    public function setscore(?string $score): self {$this->score = $score;return $this;}

    public function getPassword(): ?string {return $this->password;}
    public function setPassword(?string $password): self {$this->password = $password;return $this;}

    public function __construct(?PDO $bdd) {
        $this->bdd = $bdd;
  }
   
  //methode
  public function add():string{
    try {
        $requete = $this->getBdd()->prepare(
            'INSERT INTO players (pseudo, email, psswrd,score) VALUES (?, ?, ?,?)'
        );
        $requete->bindParam(1, $this->pseudo, PDO::PARAM_STR);
        $requete->bindParam(2, $this->email, PDO::PARAM_STR);
        $requete->bindParam(3, $this->password, PDO::PARAM_STR);
        $requete->bindParam(4, $this->score, PDO::PARAM_INT);
        $requete->execute();
        return "Utilisateur ajouté";
    } catch (Exception $error) {
        die('Error : ' . $error->getMessage());
    }
}

public function getByEmail():array|null{
    try {
        $requete = $this->getBdd()->prepare('SELECT id, pseudo, email, psswrd, score FROM players
        WHERE email = ?');
        $requete->bindParam(1, $this->email, PDO::PARAM_STR);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

}

public function getAll():array | null{
    try {
        $requete = $this->getBdd()->prepare('SELECT id, pseudo, email, psswrd, score FROM players
        ORDER BY score DESC');
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
}
}