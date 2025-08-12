<?php
    $servername = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname= "adocao_Luan";


    $conn = new mysqli($servername, $usuario, $senha, $dbname);
    print('hellow');


    if ($conn->connect_error) {

        die("Falha na conexão: " . $conn->connect_error);
    } 
    // else {
    //     header("./index.html", true, 01);
    // }

?>