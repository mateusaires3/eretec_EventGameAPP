<?php
    header('Access-Control-Allow-Origin: *');   
    require('connectionSQL.php');
    $foto = "foto.png";
    // Verifica se algo foi postado para publicar ou editar
    if ( isset( $_POST ) && ! empty( $_POST ) ) {
        // Cria as variáveis
        foreach ( $_POST as $chave => $valor ) {
            $$chave = $valor;
            // Verifica se existe algum campo em branco
            if ( empty ( $valor ) ) {
                // Preenche o erro
                $erro = 'Existem campos em branco.';
            }
        }
        // Verifica se o usuário existe
        $pdo_verifica = $conexao_pdo->prepare('SELECT * FROM t_users WHERE usuario = ?');
        $pdo_verifica->execute( array( $usuario ) );
        // Captura os dados da linha
        $user = $pdo_verifica->fetch();
        $user = $user['usuario'];
        // Verifica se tem algum erro
        if ( ! $erro ) {
            // Se o usuário existir, return true pro ajax
            if ( ! empty( $user ) ) {
                $confirm = array('confirmacao' => 'erroCadastrar', );
                echo json_encode($confirm);
                // Se o usuário não existir, return false pro ajax
            } else {
                $pdo_insere = $conexao_pdo->prepare('INSERT INTO t_users (nome, usuario,senha, foto, profissao) VALUES (?, ?, ?, ?, ?)');
                $pdo_insere->execute( array($nome,$usuario, $senha, $foto, $profissao) );
                $confirm = array('confirmacao' => 'Cadastrado', );
                echo json_encode($confirm);
            }
        }
    }
?>