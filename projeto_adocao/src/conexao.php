<?php
$str = [
    "servername" => "localhost",
    "usuario" => "root",
    "senha" => "",
    "dbname" => "adocao_Luan"
];


$conn = new mysqli($str['servername'], $str['usuario'], $str['senha'], $str['dbname']);


if ($conn->connect_error) {

    die("Falha na conexão: " . $conn->connect_error);
}
// else {
//     header("./index.html", true, 01);
// }
