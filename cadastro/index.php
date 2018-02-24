<?php
// Conexão com o banco de dados
require ("../conexao.php");

$path = "../img/profile/";
$msg = '';

$usuario = "";
$email = "";

session_start();

if(isset($_SESSION["login"]) || isset($_SESSION["senha"])){
  header('Location: /painel');
}else{
  session_destroy();
}

// Se o usuário clicou no botão cadastrar efetua as ações
if (isset($_POST['btnConfirmar'])) {

  // Recupera os dados dos campos
  $usuario = $_POST['usuario'];
  $email = $_POST['email'];
  $senha = $_POST['passwordinput'];
  $senhaConfim = $_POST['passwordinputConfirm'];
  $foto = $_FILES["file-input"];
  $token = $_POST['token'];

  $msg = validar($senha, $senhaConfim, $conn, $usuario, $email, $token);

  if(empty($msg)){ 
  // Se a foto estiver sido selecionada
    if (!empty($foto["name"])) {

    // Largura máxima em pixels
      $largura_max = 150;
    // Altura máxima em pixels
      $altura_max = 150;
    // Tamanho máximo do arquivo em bytes
      $tamanho = 100000;

      $error = array();

      // Verifica se o arquivo é uma imagem
      if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
        $error[1] = toast_message("toast-error", "Formato de imagem Invalido!");
      } 

    // Pega as dimensões da imagem
      $dimensoes = getimagesize($foto["tmp_name"]);

    // Verifica se a largura da imagem é maior que a largura permitida
    //if($dimensoes[0] > $largura) {
    //  $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
    //}

    // Verifica se a altura da imagem é maior que a altura permitida
    //if($dimensoes[1] > $altura) {
    //  $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
    //}

    // Verifica se o tamanho da imagem é maior que o tamanho permitido
      if($foto["size"] > $tamanho) {
        $error[2] = toast_message("toast-error", "A imagem deve ter no máximo ".$tamanho." bytes!");
      }

      $largura_orig = $dimensoes[0];
      $altura_orig = $dimensoes[1];

      $image_p = imagecreatetruecolor($largura_max, $altura_max);
      $image = imagecreatefromjpeg($foto["tmp_name"]);
      imagecopyresampled($image_p, $image, 0, 0, 0, 0, $largura_max, $altura_max, $largura_orig, $altura_orig);   

    // Se não houver nenhum erro
      if (count($error) == 0) {

      // Pega extensão da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

          // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

          // Caminho de onde ficará a imagem
        $caminho_imagem = $path . $nome_imagem;

        // Faz o upload da imagem para seu respectivo caminho
        imagejpeg($image_p, $caminho_imagem);
        //move_uploaded_file($image_p["tmp_name"], $caminho_imagem);

        $msg = inserir($conn, $usuario, $email, $senha, $nome_imagem, $caminho_imagem, $token);

        $usuario = "";
        $email = "";

      }

    // Se houver mensagens de erro, exibe-as
      if (count($error) != 0) {
        foreach ($error as $erro) {
          $msg = $erro;
        }
      }
    }else{
      $nome_imagem = "2dd945d3c0471656ce5f0a4bb587bcbf.jpg";
      $msg = inserir($conn, $usuario, $email, $senha, $nome_imagem, "", $token);

      $usuario = "";
      $email = "";
    }
  }
}

function validar($senha, $senhaConfim, $conn, $usuario, $email, $token){

  $msg = "";

  if($senha != $senhaConfim){
    $msg = toast_message("toast-error", "As senhas não correspondem!");
  }else if (strlen($senha) < 8) {
    $msg = toast_message("toast-error", "Senha com no minimo 8 caracteres!");
  }else{

    $verificarExistenciaToken = mysqli_query($conn,"SELECT * FROM tokens WHERE  token = '$token'");
    $rowToken = mysqli_num_rows($verificarExistenciaToken);

    if ($rowToken == 0){
      $msg = toast_message("toast-error", "Token Invalido!");
    }else{

      $verificarExistenciaLogin = mysqli_query($conn,"SELECT * FROM usuarios WHERE  nome = '$usuario'");
      $rowUsuarios = mysqli_num_rows($verificarExistenciaLogin);

      if ($rowUsuarios > 0){
        $msg = toast_message("toast-error", "Já existe um usuário cadastrado!");
      }else{

        $verificarExistenciaEmail = mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '$email'");
        $rowEmail = mysqli_num_rows($verificarExistenciaEmail);

        if ($rowEmail > 0){
          $msg = toast_message("toast-error", "Já existe um e-mail cadastrado!");
        }
      }

    }

  }

  return $msg;
}

function inserir($conn, $usuario, $email, $senha, $nome_imagem, $caminho_imagem, $token){

  $msg = "";

  $enrypt = md5($senha);

  // Insere os dados no banco
  $sql = mysqli_query($conn, "INSERT INTO usuarios VALUES ('', '".$usuario."', '".$email."', '".$enrypt."', '".$nome_imagem."', '0', '0', '".date('y-m-d')."')");

  // Se os dados forem inseridos com sucesso
  if ($sql){
    $sqlToken = mysqli_query($conn, "DELETE FROM `tokens` WHERE `tokens`.`token` = '".$token."'");
    $msg = toast_message("toast-success", "Você foi cadastrado com sucesso.");    
  }else{
    if(!empty($caminho_imagem)){
      unlink($caminho_imagem);
    }
    $msg = toast_message("toast-error", "Favor entra em contato com o administrador!");
  }

  return $msg;
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
    <?=$msg?>
    <div class="row centralizar-divs">
      <div class="col-lg-8">
        <div class="panel panel-default" >
          <div class="panel-heading">
            <div class="panel-title text-center">Cadastro</div>
          </div>     

          <div class="panel-body" >

            <form id="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

              <table class="align-center width-100">
                <tr>
                  <td colspan="3" style="width: 49%;">
                    <!-- Text input-->
                    <div class="input-group width-100">
                      <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input id="usuario" name="usuario" type="text" maxlength="18" placeholder="Usuário" class="form-control input-md" value="<?php echo $usuario ?>" required="">
                    </div>
                  </td>

                  <td style="width: 2%;"/>

                  <!-- Prepended text-->
                  <td style="width: 49%;">
                    <div class="input-group width-100">
                      <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                      <input id="email" name="email" class="form-control" placeholder="E-mail" type="email" value="<?php echo $email ?>" required="">
                    </div>
                  </td>
                </tr>

                <!-- Password input-->
                <tr>
                  <td colspan="3" style="width: 49%; height: 65px;">
                    <div class="input-group width-100" style="display: flex;">
                      <input id="passwordinput" name="passwordinput" type="password" placeholder="Informe sua senha" class="form-control input-md" required="">
                      <button id="btnPasswordinput" class="input-group-addon fa fa-eye" type="button" style="width: 11%;"></button>
                    </div>
                  </td>

                  <td style="width: 2%;"/>

                  <td colspan="3" style="width: 49%;">
                    <div class="input-group width-100" style="display: flex;">
                      <input id="passwordinputConfirm" name="passwordinputConfirm" type="password" placeholder="Confirme sua senha" class="form-control input-md" required="">
                      <button id="btnPasswordinputConfirm" class="input-group-addon fa fa-eye" type="button" style="width: 11%;"></button>
                    </div>
                  </td>
                </tr>

                <!-- File Button --> 
                <tr>
                  <td colspan="3" style="width: 49%; vertical-align: top;">
                    <input id="filebutton" name="file-input" class="input-file width-100" type="file" accept="image/jpeg">
                    <span style="font-size: 12px;">*Foto do perfil (150 x 150)</span>
                  </td>

                  <td style="width: 2%;"/>

                  <td colspan="3" style="width: 49%; vertical-align: top;">
                    <!-- Text input-->
                    <div class="input-group width-100">
                      <span class="input-group-addon" style="width: 11%;"><i class="fa fa-lock" aria-hidden="true"></i></span>
                      <input id="token" name="token" type="text" placeholder="Informe seu Token" class="form-control input-md" required="">
                    </div>
                  </td>
                </tr>

              </table>
            </br>
            <!-- Button (Double) -->
            <table class="align-center width-100">
              <tr>
                <td>
                  <button id="btnLimpar" name="btnLimpar" class="btn btn-default" type="button">Limpar</button>
                  <button id="btnConfirmar" name="btnConfirmar" class="btn btn-primary" type="submit">Confirmar</button>
                </td>
              </tr>
            </table>

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
