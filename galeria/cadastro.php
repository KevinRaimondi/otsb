<?php
// Conexão com o banco de dados
require ("conexao.php");

$path = "../img/profile/";
$msg = '';

// Se o usuário clicou no botão cadastrar efetua as ações
if (isset($_POST['btnConfirmar'])) {

  // Recupera os dados dos campos
  $usuario = $_POST['usuario'];
  $email = $_POST['email'];
  $senha = $_POST['passwordinput'];
  $senhaConfim = $_POST['passwordinputConfirm'];
  $foto = $_FILES["file-input"];

  $msg = validar($senha, $senhaConfim, $conn, $usuario, $email );

  if(empty($msg)){ 
  // Se a foto estiver sido selecionada
    if (!empty($foto["name"])) {

    // Largura máxima em pixels
      $largura_max = 151;
    // Altura máxima em pixels
      $altura_max = 151;
    // Tamanho máximo do arquivo em bytes
      $tamanho = 100000;

      $error = array();

      // Verifica se o arquivo é uma imagem
      if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
        $error[1] = "Isso não é uma imagem.";
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
        $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
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

        $msg = inserir($conn, $usuario, $email, $senha, $nome_imagem, $caminho_imagem );

      }

    // Se houver mensagens de erro, exibe-as
      if (count($error) != 0) {
        foreach ($error as $erro) {
          $msg = $erro;
        }
      }
    }else{
      $nome_imagem = "2dd945d3c0471656ce5f0a4bb587bcbf.jpg";
      $msg = inserir($conn, $usuario, $email, $senha, $nome_imagem, "" );
    }
  }
}

function validar($senha, $senhaConfim, $conn, $usuario, $email ){

  $msg = "";

  if($senha != $senhaConfim){
    $msg = "<p style='color: red; font: bold;'>As senhas não conferem!</p>";
  }else{

    $verificarExistenciaLogin = mysqli_query($conn,"SELECT * FROM usuarios WHERE  nome = '$usuario'");
    $rowUsuarios = mysqli_num_rows($verificarExistenciaLogin);

    if ($rowUsuarios > 0){
      $msg = "<p style='color: red; font: bold;'>Já existe um usuário cadastrado!</p>";
    }else{

      $verificarExistenciaEmail = mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '$email'");
      $rowEmail = mysqli_num_rows($verificarExistenciaEmail);

      if ($rowEmail > 0){
        $msg = "<p style='color: red; font: bold;'>Já existe um e-mail cadastrado!</p>";
      }
    }

  }

  return $msg;
}

function inserir($conn, $usuario, $email, $senha, $nome_imagem, $caminho_imagem){

  $msg = "";

  // Insere os dados no banco
  $sql = mysqli_query($conn, "INSERT INTO usuarios VALUE ('', '".$usuario."', '".$email."', '".$senha."', '".$nome_imagem."')");

  // Se os dados forem inseridos com sucesso
  if ($sql){
    $msg = "Você foi cadastrado com sucesso.";
  }else{
    if(!empty($caminho_imagem)){
      unlink($caminho_imagem);
    }
  }

  return $msg;
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
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#intro">Home</a></li>
            <li><a href="#jogos">Jogos</a></li>
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="#contact">Contato</a></li>
            <li><a href="/galeria">Galeria</a></li>
            <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSfKUjGVnpolEFRAuxI2Ati2C28M1Doij9uQtZPqpjyZr0J6ww/viewform">Aliste-se Já</a></li>
      <!--    <li class="dropdown">
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
        <div class="col-lg-8">
          <div class="boxed-grey style-form">

            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">
              <fieldset>

                <!-- Form Name -->
                <legend>Cadastro</legend>
                <table class="align-center width-100">
                  <tr>
                   <td colspan="3" style="width: 49%;">
                    <!-- Text input-->
                    <label class="control-label" for="usuario">Usuário:</label>  
                    <input id="usuario" name="usuario" type="text" placeholder="Usuário" class="form-control input-md" required="">
                  </td>

                  <td style="width: 2%;"/>

                  <!-- Prepended text-->
                  <td style="width: 49%;">
                    <label class="control-label" for="">E-mail:</label>
                    <div class="input-group width-100">
                      <span class="input-group-addon">@</span>
                      <input id="email" name="email" class="form-control" placeholder="E-mail" type="email" required="">
                    </div>
                  </td>
                </tr>

                <!-- Password input-->
                <tr>
                  <td colspan="3" style="width: 49%;">
                    <label class="control-label" for="passwordinput">Senha:</label>
                    <input id="passwordinput" name="passwordinput" type="password" placeholder="Informe sua senha" class="form-control input-md" required="">
                  </td>

                  <td style="width: 2%;"/>

                  <td colspan="3" style="width: 49%;">
                    <label class="control-label" for="passwordinputConfirm">Confirme sua senha:</label>
                    <input id="passwordinputConfirm" name="passwordinputConfirm" type="password" placeholder="Confirme sua senha" class="form-control input-md" required="">
                  </td>
                </tr>

                <!-- File Button --> 
                <tr>
                  <td colspan="5">
                   <label class="control-label" for="filebutton">Foto do Perfil</label>
                   <input id="filebutton" name="file-input" class="input-file width-100" type="file" accept="image/jpeg">
                 </td>
               </tr>

             </table>

             <!-- Button (Double) -->
             <table class="align-center width-100">
              <tr>
                <td  style="width: 70%;" class="align-center">
                  <?=$msg?>
                </td>

                <td style="width: 21%;">
                  <button id="btnLimpar" name="btnLimpar" class="btn btn-default" type="reset">Limpar</button>
                  <button id="btnConfirmar" name="btnConfirmar" class="btn btn-primary" type="submit">Confirmar</button>
                </td>
              </tr>
            </table>

          </fieldset>
        </form>

      </div>
    </div>
  </div>
</div>

</section>

<!-- Core JavaScript Files -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/jquery.scrollTo.js"></script>
<script src="../js/wow.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/custom.js"></script>
<script src="contactform/contactform.js"></script>

</body>

</html>
