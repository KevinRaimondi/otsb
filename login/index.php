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
  $email = $_POST['email'];
  $senha = $_POST['passwordinput'];
  $enrypt = md5($senha);
  $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '$email' AND senha = '$enrypt'");
  $dados = mysqli_fetch_assoc($query);
  $row = mysqli_num_rows($query);
  if ($row > 0){
    $status = $dados['status'];
    if ($status == 0){
      $_SESSION['id']    = $dados['id'];
      $_SESSION['nome']  = $dados['nome'];
      $_SESSION['login'] = $dados['email'];
      $_SESSION['senha'] = $enrypt;
      $_SESSION['foto'] = $dados['foto'];
      header('Location: /painel');
    }else{
     $msg = toast_message("toast-error", "O usuário está desabilitado!");
   }
 }else{
  $msg = toast_message("toast-error", "Usúario ou senha invalido!");
}

}

function toast_message($tipo, $msg){

// Tipos: toast-success, toast-info, toast-error, toast-error;

  $retorno = "<div id='toast-container' class='toast-top-right'><div class='toast ".$tipo."' style=''><button id='close-toast' class='toast-close-button'>×</button><div class='toast-message'>".$msg."</div></div></div>";

  return $retorno;
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
  <link href="../toastr/toastr.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../color/default.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="../toastr/toastr.js"></script>
  <script type="text/javascript" src="../toastr/toastr.min.js"></script>
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
          <li class="active"><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Entrar</a></li>
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
    <?=$msg?>
    <div class="row centralizar-divs">
      <div class="col-lg-4">
        <div class="panel panel-default" >
          <div class="panel-heading">
            <div class="panel-title text-center">Entrar</div>
          </div>     

          <div class="panel-body" >

            <form id="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">           
              <div class="input-group width-100">
                <span class="input-group-addon" style="width: 12%;"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                <input id="email" name="email" class="form-control" placeholder="E-mail" type="email" value="<?php echo $email ?>" required="">
              </div>

              <div class="input-group width-100">
                <span class="input-group-addon" style="width: 12%;"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input id="passwordinput" name="passwordinput" type="password" placeholder="Informe sua senha" class="form-control input-md" required="">
              </div>              
              <a href="/recovery" style="color: #fff;">Esqueceu sua senha?</a>

              <div class="form-group">
                <!-- Button -->
                <div class="col-sm-12 controls">
                  <button id="btnLogin" name="btnLogin" type="submit" class="btn btn-primary pull-right"><i class="fa fa-sign-in"></i> Entrar</button>
                </div>
              </div>

            </form>     
          </div>   
          <div class="panel-footer ">
            Não tem uma conta! <a href="/cadastro"> Cadastre-se Aqui </a>
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
