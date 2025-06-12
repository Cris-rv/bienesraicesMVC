<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Conectarnos a la DB
$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);