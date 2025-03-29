<?php
                        //Para abrir no terminal> php -S localhost:3306
//chamar a conexão com o banco de dados
include_once 'database/conn.php';


if ($conn) {
    $sql = $conn->query("SELECT * FROM task ORDER BY id ASC");
    $tasks = [];

    if ($sql->num_rows > 0) {
        $tasks = $sql->fetch_all(MYSQLI_ASSOC);
    }
} else {
    die("Falha na conexão com o banco de dados.");
}


?><!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/styles/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <title>To-do-list</title>
</head>
<body>

    <div id="to_do"> <!-- div# = atalho para id-->
        <h1>Things to do</h1>

        <!-- Criando formulário de enviar dados-->
        <form action="actions/create.php"  method="POST" class="to-do-form"><!-- Botão para adicionar tarefa-->
            <input type="text" name="description" placeholder="Write your task here" required>
            <button type="submit" class="form-button">
                <i class="fa-solid fa-plus"></i>
            </button>
        </form> 
  

        <!-- Criando a lista de tasks-->
        <div id="tasks">

        <!-- Loop para exibir as tasks direto do banco -->
        <?php foreach ($tasks as $task): ?>
            <div class="task"> <!-- div. = atalho-->
                <input 
                type="checkbox" 
                name="progress" 
                class="progress <?= $task['completed'] ? 'done' : ""?>"
                data-task-id="<?= $task['id']?>"
                <?= $task['completed'] ? 'checked' : "";/*Se a tarefa estiver completa, o checkbox aparece marcado*/?> 

                >
                <p class="task-description">
                    <?= $task['description'] //Mostrar a descrição da tarefa vindo do banco de dados
                    ?> 
                </p> 
 
                <div class="task-actions">
                    <a class="action-button edit-button" >
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <a href="actions/delete.php?id=<?= $task['id']?>" class="action-button delete-button" >
                        <i class="fa-regular fa-trash-can"></i>
                    </a>
                </div>
                <form action="actions/update.php" method ="post"class="to-do-form edit-task hidden">
                    <input 
                    type="text" 
                    class="hidden" 
                    name ="id" 
                    value="<?= $task['id']?>">

                    <input 
                    type="text"
                     name="description" 
                     placeholder="Edit your task" 
                     value="<?=$task['description']?>"
                     >
                    <button type="submit" class="form-button confirm button">
                        <i class="fa-solid fa-check"></i>
                    </button>
 
                </form>
            </div>
        <?php endforeach ?>
        </div>
    </div>

    <script src="src/javascript/script.js"></script>
</body>
</html>

