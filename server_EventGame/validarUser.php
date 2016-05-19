<?php
        header('Access-Control-Allow-Origin: *');  
        require('connectionSQL.php');
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

                		$usuarioL = $_POST['usuarioL'];
                		$senhaL = $_POST['senhaL'];
                		
                        $stmt = $conexao_pdo->prepare("SELECT id,usuario,senha FROM t_users WHERE usuario = '$usuarioL' AND senha = '$senhaL' LIMIT 1");
                        $stmt->execute();
                        $result = array();
                        while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $result = $r;
                        }
                        
                        if ($result > 0) {
                        	echo json_encode($result);
                        }
                      


                }

?>