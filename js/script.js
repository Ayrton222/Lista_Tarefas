function editar(id, txt_tarefa){
    /* 8 Passo: Atualizando registros (Front end) */

    //criando form de edição
    let form = document.createElement('form')
    form.action = 'tarefa_controller.php?acao=atualizar'
    form.method = 'post'
    form.className = 'row'

    //criando input para entrada do texto
    let inputTarefa = document.createElement('input')
    inputTarefa.type = 'text'
    inputTarefa.name = 'tarefa'
    inputTarefa.className = 'col-9 form-control'
    inputTarefa.value = txt_tarefa

    //criando um input hidden para guardar o id da tarefa
    let inputId = document.createElement('input')
    inputId.type = 'hidden'
    inputId.name = 'id'
    inputId.value = id

    //criando botao para envio do forms
    let button = document.createElement('button')
    button.type = 'submit'
    button.className = 'col-3 btn btn-info'
    button.innerHTML = 'Atualizar'

    //Incluindo inputTarefa no form
    form.appendChild(inputTarefa)

    //incluir inputId no form
    form.appendChild(inputId)

    //incluindo o button no form
    form.appendChild(button)

    //teste
    //console.log(form)

    //selecionar a div tarefa
    let tarefa = document.getElementById('tarefa_'+id)

    //limpar o texto da tarefa para inclusao do forms
    tarefa.innerHTML = ''	

    //inclusao do forms na pagina
    tarefa.insertBefore(form,tarefa[0]) // inserir apos o elemento ser renderizado

    //alert(txt_tarefa)
}

function remover(id){
    /* 10 Passo: removendo registros (front end) */

    location.href = 'todas_tarefas.php?acao=remover&id='+id;
}

function marcarRealizada(id){
    /* 12 Passo: marcar como realizado (front end) */
    location.href = 'todas_tarefas.php?acao=marcarRealizada&id='+id;
}