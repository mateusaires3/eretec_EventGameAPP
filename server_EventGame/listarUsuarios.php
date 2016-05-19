<?php
                     

 if ($_GET['ajax'] == 'listarUsuarios') {

 $id = $_GET['valor'];

 header('Access-Control-Allow-Origin: *');  

 require ('connectionSQL.php');

 $stmt = $conexao_pdo->prepare("SELECT * FROM t_users");

 $stmt->execute();

 $rows = array();

      while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $r;
     }
        
 echo json_encode($rows);


 }

 
?>