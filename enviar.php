<?php

session_start();

if (isset($_POST['enviar'])) {

  //Variaveis de POST, Alterar somente se necessário 
  //====================================================
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $assunto = $_POST['subject']; 
  $mensagem = $_POST['mensagem'];
  //====================================================
  
  //REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
  //==================================================== 
  $email_remetente = "contato@kraimondi.tech"; // deve ser uma conta de email do seu dominio 
  //====================================================
  
  //Configurações do email, ajustar conforme necessidade
  //==================================================== 
  $email_destinatario = "contato@kraimondi.tech"; // pode ser qualquer email que receberá as mensagens
  $email_reply = "$email"; 
  $email_assunto = "Contato pelo site: $assunto"; // Este será o assunto da mensagem
  //====================================================
  
  //Monta o Corpo da Mensagem
  //====================================================
  $email_conteudo = "Nome: $nome \n"; 
  $email_conteudo .= "Email: $email \n\n";
  $email_conteudo .= "$mensagem \n"; 
  //====================================================
  
  //Seta os Headers (Alterar somente caso necessario) 
  //==================================================== 
  $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
  //====================================================
  
  //Enviando o email 
  //==================================================== 
  if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){ 
    $_SESSION['cmsg']=1; 
  } else{ 
    $_SESSION['cmsg']=2;
  } 
  
  header('Location: /index.php#contact');
  //====================================================
} 
?>