<?php 
include_once '../database/conn.php';


//recebe o id da tarefa que eu quero deletar
// Aqui estamos pegando um número que vem da URL (o endereço da página) e guardando na variável $id
$id = $_GET['id'];

// Verificamos se a variável $id tem algum valor (ou seja, se não está vazia)
if ($id) {
    // Se $id tem um valor, preparamos uma instrução para apagar uma tarefa do banco de dados
    $sql = $conn->prepare("DELETE FROM task WHERE id = ?");

    // Aqui estamos dizendo que o lugar do '?' na instrução é um número (o 'id' que pegamos)
    $sql->bind_param("i", $id);

    //executamos a instrução que vai apagar a tarefa
    $sql->execute();

    // Depois de apagar a tarefa, redirecionamos o usuário para a página principal (index.php)
    header('Location: ../index.php');

    exit();
} else {
    // Se $id não tem valor (ou seja, não foi passado um 'id' na URL), também redirecionamos para a página principal
    header('Location: ../index.php');
    exit();
}
?>