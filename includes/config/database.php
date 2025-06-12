<?php

function conectarDB() : mysqli {
    $db = new mysqli('190.106.222.203', '417786', 'Crisrb1218$', 'bienesraicesmvc_cristopher'); // Forma orientada a objetos

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
};