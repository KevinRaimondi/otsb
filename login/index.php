<?php
// Conexão com o banco de dados
require ("../conexao.php");
$msg = '';
$email = "";

session_start();

if(isset($_SESSION["login"]) || isset($_SESSION["senha"])){
  header('Location: /painel');
}else{
  session_destroy();
}

// Se o usuário clicou no botão login efetua as ações
if (isset($_POST['btnLogin'])) {

  session_start();
  session_destroy();
  $email = $_POST['email'];
  $senha = $_POST['passwordinput'];
  $enrypt = md5($senha);
  $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '$email' AND senha = '$enrypt'");
  $dados = mysqli_fetch_assoc($query);
  $row = mysqli_num_rows($query);
  if ($row > 0){
    session_start();
    $_SESSION['id']    = $dados['id'];
    $_SESSION['nome']  = $dados['nome'];
    $_SESSION['login'] = $dados['email'];
    $_SESSION['senha'] = $dados['senha'];
    $_SESSION['senha'] = $dados['foto'];
    header('Location: /painel');
  }else{
    $msg = "<span style='color: red;'>Usúario ou senha invalido</span>";
    echo $enrypt. "ENTRADA";
  }

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
          <li class="active"><a href="/login">Entrar</a></li>
        </ul>
      </div>

      <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
        <ul class="nav navbar-nav">
          <li><a href="/">Home</a></li>
          <li><a href="#jogos">Jogos</a></li>
          <li><a href="#sobre">Sobre</a></li>
          <li><a href="#contact">Contato</a></li>
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
            <div class="panel-title text-center">Entrar</div>
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

              <div class="input-group width-100">
                <span class="input-group-addon" style="width: 12%;"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input id="passwordinput" name="passwordinput" type="password" placeholder="Informe sua senha" class="form-control input-md" required="">
              </div>
              
              <table class="width-100">
                <tr>
                  <td style="width: 40%;" class="align-left">
                    <a href="/recovery">Esqueceu sua senha?</a>
                  </td>

                  <td style="width: 60%;" class="align-right">
                    <span>Não tem conta?</span><a href="/cadastro" style="text-decoration: underline;"> cadastre-se.</a>
                  </td>
                </tr>
              </table>

              <div class="form-group">
                <!-- Button -->
                <div class="col-sm-12 controls">
                  <button id="btnLogin" name="btnLogin" type="submit" class="btn btn-primary pull-right"><i class="fa fa-sign-in"></i> Entrar</button>
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
