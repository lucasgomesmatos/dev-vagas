<?php

require __DIR__ . "/vendor/autoload.php";

use \App\Entity\Vaga;


$vagas = Vaga::getVagas();

// $dotenv = Dotenv\Dotenv::create(__DIR__);
// $dotenv->load();

// echo "<pre>";
// print_r($env);
// echo "</pre>";

include __DIR__ . "/includes/header.php";
include __DIR__ . "/includes/listagem.php";
include __DIR__ . "/includes/footer.php";