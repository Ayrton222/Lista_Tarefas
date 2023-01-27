<?php
    /* 4 Passo: Enviando dados para o back */
    //Instanciando 
    require "../../Projeto_ListaTarefas/tarefa.model.php";
    require "../../Projeto_ListaTarefas/tarefa.service.php";
    require "../../Projeto_ListaTarefas/conexao.php";

    /*  6 Passo: Refactorin (somente ira exeutar apos a recuperação do valor acao) */

    //verificar se existe algum valor 'acao' se nao ele vai atribuir o valor (recuperar) na variavel
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
    if($acao == 'inserir'){
        
        $tarefa = new Tarefa();
        //setando o atributo tarefa
        $tarefa->__set('tarefa',$_POST['tarefa']);
    
        $conexao = new Conexao();
    
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();
    
        /* 5 Passo: Inserindo registro (feedback) */
    
        header('Location: nova_tarefa.php?inclusao=1');
    
    }else if($acao == 'recuperar'){
        /* 7 Passo: Listar registros */

        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
    } else if($acao == 'atualizar'){
        /* 9 Passo: Atualizando registros (Back end)  */
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_POST['id']);
        $tarefa->__set('tarefa',$_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        if($tarefaService->atualizar()){

            if( isset($_GET['pag']) && $_GET['pag'] == 'index'){ // passo 15
                header('location: index.php');
            }else{
                header('location: todas_tarefas.php');
            }
           
        }
    } else if($acao == 'remover'){
        /* 11 Passo: Remover registros (beck end) */
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if( isset($_GET['pag']) && $_GET['pag'] == 'index'){ // passo 15
            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');
        }
    } else if($acao == 'marcarRealizada'){
        /* 13 Passo: marcar como realizada (back end) */

        $tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->marcarRealizada();

        if( isset($_GET['pag']) && $_GET['pag'] == 'index'){ // passo 15
            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');
        }
    } else if($acao == 'recuperarTarefasPentendetes'){
        /* 15 Passo: listar tarefas pentendes (back end) */
        $tarefa = new Tarefa();
        $tarefa->__set('id_status',1);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperarTarefasPentendetes();
    }
   
?>