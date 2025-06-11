<?php

function conectarDB() : mysqli {
    $db = new mysqli('127.0.0.1', 'root', 'root', 'Bienesraices_CRUD'); // Forma orientada a objetos

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
};