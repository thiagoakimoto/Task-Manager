<?php
require_once '../database/conn.php';

//receber a descrição que eu escrevi no input

$description = $_POST['description'];

if ($description) {
    $sql = $conn->prepare("INSERT INTO task (description) VALUES (?)");
    $sql->bind_param("s", $description);
    $sql->execute();

    //faz com que os dados voltem para o index.php e não ficar no create
    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}

?>