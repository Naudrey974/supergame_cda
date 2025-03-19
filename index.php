<?php
// Ressources
include './env.php';
include './utils/utils.php';
include './view/header.php';
include './view/footer.php';
include './abstract/AbstractController.php';
include './view/viewPlayer.php';
include './controller/playerController.php';
include './interface/interfaceModel.php';
include './model/playerModel.php';

echo "Accueil";
$playerModel = new PlayerModel(connect());

$player = new PlayerController(
  new ViewPlayer(),
  new ViewHeader(),
  new ViewFooter(),
  $playerModel
    
);
$player->render();