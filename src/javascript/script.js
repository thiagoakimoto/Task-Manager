// Quando o documento (página) estiver completamente carregado, execute a função abaixo
$(document).ready(function () {

    // Quando um botão com a classe "edit-button" for clicado
    $(".edit-button").on("click", function () {
        // Encontre o elemento mais próximo com a classe "task" (que representa uma tarefa)
        var task = $(this).closest(".task");
        
        // Esconda a parte que mostra o progresso da tarefa
        task.find(".progress").addClass("hidden");
        // Esconda a descrição da tarefa
        task.find(".task-description").addClass("hidden");
        // Esconda os botões de ação da tarefa
        task.find(".task-actions").addClass("hidden");
        // Mostre a parte que permite editar a tarefa
        task.find(".edit-task").removeClass("hidden");
    });

    // Quando a caixa de seleção com a classe "progress" for clicada
    $(".progress").on("click", function () {
        // Verifique se a caixa de seleção está marcada
        if ($(this).is(":checked")) {
            // Se estiver marcada, adicione a classe "done" (que pode mudar a aparência)
            $(this).addClass("done");
        } else {
            // Se não estiver marcada, remova a classe "done"
            $(this).removeClass("done");
        }
    });

    // Quando o estado da caixa de seleção "progress" mudar (ser marcada ou desmarcada)
    $(".progress").on("change", function () {
        // Pegue o ID da tarefa a partir de um atributo de dados (data-task-id)
        const id = $(this).data('task-id');
        // Verifique se a caixa está marcada e defina a variável 'completed' como 'true' ou 'false'
        const completed = $(this).is(':checked') ? 'true' : 'false';
        
        // Envie uma requisição AJAX para o servidor para atualizar o progresso da tarefa
        $.ajax({
            url: "../../actions/update-progress.php", // O endereço do arquivo que vai processar a requisição
            method: "post", // O método HTTP que estamos usando (neste caso, POST)
            data: {id: id, completed: completed}, // Os dados que estamos enviando (ID da tarefa e se está completa ou não)
            dataType: 'json', // Esperamos receber uma resposta em formato JSON
            success: function (response) { // Se a requisição for bem-sucedida
                if (response.success) {
                    // Aqui você pode adicionar código para o que fazer se a atualização for bem-sucedida
                } else {
                    // Se a resposta indicar que houve um erro, mostre um alerta
                    alert("Erro ao editar a tarefa");
                }
            },
            error: function () {
                // Se houver um erro na requisição, mostre um alerta
                alert('Ocorreu um erro');
            }
        });
    });

});