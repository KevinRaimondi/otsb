<?php
// Conexão com o banco de dados
require ("../conexao.php");
$msg = '';
$email = "";
$status = 0;

session_start();

if(isset($_SESSION["login"]) || isset($_SESSION["senha"])){
  header('Location: /painel');
}else{
  session_destroy();
}

// Se o usuário clicou no botão enviar efetua as ações
if (isset($_POST['btnEnviar'])) {

  $email = $_POST['email'];

  $verificarExistenciaEmail = mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '$email'");
  $rowEmail = mysqli_num_rows($verificarExistenciaEmail);
  $dados = mysqli_fetch_assoc($verificarExistenciaEmail);

  if ($rowEmail == 0){
    $msg = "<span style='color: red;'>O e-mail não existe</span>";
  } else {
    $status = $dados['status']; 
    if ($status != 0){
      $msg = "<span style='color: red;'>O usuário está desabilitado!</span>";
    }
  }

  if(empty($msg)){ 

   $senha = gerarSenha();

   $enrypt = md5($senha);

  // Insere os dados no banco
   $sql = mysqli_query($conn, "UPDATE `usuarios` SET `senha` = '".$enrypt."' WHERE `usuarios`.`email` = '".$email."'");

  // Se os dados forem atualizado com sucesso
   if ($sql){

    $email_remetente = "contato@kraimondi.tech";
    $email_destinatario = $email;
    $email_reply = $email_remetente;
    $email_assunto = "OTSB - Esqueceu sua senha?"; 
    $email_conteudo = "Sua nova senha é: ".$senha;
    $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );

    if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){ 
      $msg = "<span>Sua nova senha foi enviada por e-mail</span>";
    }else{
      $msg = "<span style='color: red;'>Houve algum problema ao enviar sua nova senha!</span>";
    }

  }else{
    $msg = "<span style='color: red;'>Não foi possivel recuperar sua conta.</span>";
  }

}
}

function gerarSenha($size = 8){
 $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
 $randomString = '';
 for($i = 0; $i < $size; $i = $i+1){
  $randomString .= $chars[mt_rand(0,60)];
}
return $randomString;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>OTSB - Operation Tactics Snow Black</title>

  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <!-- Fonts -->

  <script src="https://use.fontawesome.com/0ca22a4c02.js"></script>
  <link href="../css/animate.css" rel="stylesheet" />
  <!-- Squad theme CSS -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../color/default.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
  <script type="text/javascript">
    $(document).ready(function(){
      $(".ifancybox").fancybox({
        'width' : '95%',
        'height' : '95%',
        'autoScale' : false,
        'transitionIn' : 'none',
        'transitionOut' : 'none',
        'type' : 'iframe'
      });
    });
  </script>

  <style type="text/css">
  a{
    color: white;
  }
</style>

  <!-- =======================================================
  Theme Name: Squadfree
  Theme URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
  Author: BootstrapMade
  Author URL: https://bootstrapmade.com
  ======================================================= -->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
  <!-- Preloader -->
  <div id="preloader">
    <div id="load">
      <i class="fa fa-circle-o-notch fa-spin fa-4x fa-fw margin-bottom"></i>
    </div>
  </div>

  <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand slogan" href="/">
          <h1>OTSB</h1>
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div class="collapse navbar-collapse navbar-right navbar-main-collapse" style="padding-left: 10px;">
        <ul class="nav navbar-nav">
          <li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Entrar</a></li>
        </ul>
      </div>

      <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
        <ul class="nav navbar-nav">
          <li><a href="/">Home</a></li>
          <li><a href="/#jogos">Jogos</a></li>
          <li><a href="/#sobre">Sobre</a></li>
          <li><a href="/#contact">Contato</a></li>
          <li><a href="/galeria">Galeria</a></li>
          <li><a class="ifancybox" href="https://docs.google.com/forms/d/e/1FAIpQLSfKUjGVnpolEFRAuxI2Ati2C28M1Doij9uQtZPqpjyZr0J6ww/viewform">Aliste-se Já</a></li>
          <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a href="#">Example menu</a></li>
          <li><a href="#">Example menu</a></li>
          <li><a href="#">Example menu</a></li>
          </ul>
        </li-->
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>

<!-- Section: intro -->
<section id="intro" class="intro">

  <div class="container">
    <div class="row centralizar-divs">
      <div class="col-lg-4">
        <div class="panel panel-default" >
          <div class="panel-heading">
            <div class="panel-title text-center">Recupere sua senha</div>
          </div>     

          <div class="panel-body" >

            <form id="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
              <div style="margin: 0; text-align:  center;">
                <?=$msg?>
              </div>
              
              <div class="input-group width-100">
                <span class="input-group-addon" style="width: 12%;"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                <input id="email" name="email" class="form-control" placeholder="E-mail" type="email" value="<?php echo $email ?>" required="">
              </div>

              <div class="form-group">
                <!-- Button -->
                <div class="col-sm-12 controls">
                  <button id="btnEnviar" name="btnEnviar" type="submit" class="btn btn-primary pull-right">Enviar</button>
                </div>
              </div>

            </form>     

          </div>                     
        </div>  
      </div>
    </div>
  </div>

</section>

<!-- Core JavaScript Files -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/jquery.scrollTo.js"></script>
<script src="../js/wow.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/custom.js"></script>

</body>

</html>
