<?php

require "conexion.php";

session_start();

$id = $_GET["id"];


$statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
//Para que no haya inyecciones sql
$statement->bindParam("id", $id);
$statement->execute();


if ($statement->rowCount() == 0) {

    http_response_code(404);
    echo ("HTTP 404 NOT FOUND");
    return;
}

//Para que no puedeas elminar el contacto de otro usuario
$contact = $statement->fetch(PDO::FETCH_ASSOC);

if ($contact["user_id"] != $_SESSION["user"]["id"]) {

    http_response_code(403);
    echo "no estas autorizado";
    return;
}



$statement = $conn->prepare("DELETE FROM contacts WHERE id = :id");
//Para que no haya inyecciones sql
$statement->bindParam("id", $id);
$statement->execute();

//Mensaje que se ha añadido un contacto
$_SESSION["flash"] = ["message" => "Contact {$_POST['name']} eliminado" ,  "type" => "danger"];

header("Location: home.php");

