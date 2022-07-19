<?php
    if(isset($_POST['email'])) {
        $data = $_POST['email'] . ";";
        $ret = file_put_contents('emails.txt', $data, FILE_APPEND | LOCK_EX);
        if($ret === false) {
            die('Erro ao gravar o arquivo');
        }
        else {
            echo "<p>Obrigado por se inscrever!<p>";
        }
    }
    else {
        die('Uxi deu ruim!');
    }
?>