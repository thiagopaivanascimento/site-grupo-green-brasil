<?php
      $nome     = strip_tags(trim($_POST['nome']));
      $email    = strip_tags(trim($_POST['email']));
      $titulo   = strip_tags(trim($_POST['titulo']));
      $mensagem = strip_tags(trim($_POST['mensagem']));
      $arquivo  = $_FILES['arquivo'];
     
      $tamanho = 5242880;
      $tipos   = array('application/pdf');
      
      if(empty($nome)){
     $msg = 'O Nome é Obrigatório';
      }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $msg = 'Digite um E-mail válido';
      }elseif(empty($titulo)){
     $msg = 'O Título é Obrigatório';
      }elseif(empty($mensagem)){
     $msg = 'A Mensagem é Obrigatória';
      }elseif(!is_uploaded_file($arquivo['tmp_name'])){
     $msg = 'O Arquivo é Obrigatório';
      }elseif($arquivo['size'] > $tamanho){
     $msg = 'O limite do tamanho do arquivo é de 5MB';
      }elseif(!in_array($arquivo['type'], $tipos)){
     $msg = 'O tipo do arquivo permitido é apenas PDF';
      }else{
        require('PHPMailer/class.phpmailer.php');
       
       $mail = new PHPMailer();
       /*$mail->IsSMTP();
       $mail->SMTPAuth = true;
       $mail->Port = 587;
       $mail->Host = 'smtp.seusite.com.br';
       $mail->Username = 'nome=seusite.com.br';
       $mail->Password = '********'; */
	   $mail->IsMail();
       /*$mail->SetFrom('contato=grupogreenbrasil.com.br', 'Grupo Green Brasil');*/
       $mail->AddAddress('contato@grupogreenbrasil.com.br', 'Grupo Green Brasil');
       $mail->Subject = 'Formulário de Contato';
       
       $body = "<strong>Nome :</strong>{$nome} <br />
            <strong>E-mail :</strong>{$email} <br />
            <strong>Titulo :</strong>{$titulo} <br />
            <strong>Mensagem :</strong>{$mensagem} <br />
            <strong>Arquivo :</strong> ".$arquivo['name'];
       
       $mail->MsgHTML($body);
       $mail->AddAttachment($arquivo['tmp_name'], $arquivo['name']);
       
       if($mail->Send())
           $msg = 'Sua Mensagem foi enviada com Sucesso!!!';
	   else
           $msg = 'Sua Mensagem não foi enviada, tente novamente';
       
      }
       
?>