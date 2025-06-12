<?php

function conectarDB() : mysqli {
    $db = new mysqli('mysql-bienesraicesmvc.alwaysdata.net', '417786', 'Crisrb1218$', 'bienesraicesmvc_cristopher'); // Forma orientada a objetos

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
};