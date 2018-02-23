<?php
// Conexão com o banco de dados
require ("../conexao.php");
$permissao = 0;
$path = "../img/profile/";
$msg = '';
$email = '';

session_start();

if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
  header ("Location: /login");
}else{

  $id = $_SESSION["id"];
  $email = $_SESSION["login"];
  $senha = $_SESSION["senha"];

  $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");
  $dados = mysqli_fetch_assoc($query);
  $permissao =  $dados['permissao'];
}

if (isset($_POST['btnAtualizar'])) {

  $emailNovo = $_POST['email'];
  $senhaNova = $_POST['passwordinput'];
  $senhaNovaConfim = $_POST['passwordinputConfirm'];
  $senhaAtual = $_POST['passwordAtual'];
  $enryptSenhaAtual = md5($senhaAtual);
  $enryptSenhaNova = md5($senhaNova);

  if($enryptSenhaAtual == $senha){
    if((!empty($senhaNova) || !empty($senhaNovaConfim)) && (!empty($senhaNova) && empty($senhaNovaConfim)) || (!empty($senhaNovaConfim) && empty($senhaNova))){ 
      $msg = "<p id='mensagem' style='text-shadow: 0px 0px 5px #f00; margin: 0;'>As senhas não conferem!1</p>";
    }else if($senhaNova != $senhaNovaConfim){
      $msg = "<p id='mensagem' style='text-shadow: 0px 0px 5px #f00; margin: 0;'>As senhas não conferem!2</p>";
    }else if (strlen($senhaNova) < 8) {
      $msg = "<p id='mensagem' style='text-shadow: 0px 0px 5px #f00; margin: 0;'>Senha com no minimo 8 caracteres!</p>";
    }
    

    if(empty($msg)){
      if($email != $emailNovo){
        $sql = mysqli_query($conn, "UPDATE `usuarios` SET `email` = '".$emailNovo."', `senha` = '".$enryptSenhaNova."' WHERE `usuarios`.`id` = '".$id."'");
      }else{
        $sql = mysqli_query($conn, "UPDATE `usuarios` SET `senha` = '".$enryptSenhaNova."' WHERE `usuarios`.`id` = '".$id."'");
      }
      if ($sql){
        $msg = "<p id='mensagem' style='text-shadow: 0px 0px 5px #000; margin: 0;'>Informações atualizadas com sucesso.</p>";
      }else{
        $msg = "<p id='mensagem' style='text-shadow: 0px 0px 5px #f00; margin: 0;'>Erro ao tualizar! Favor entra em contato com o administrador.</p>";
      }
    }

    $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE `usuarios`.`id` = '".$id."'");
    $dados = mysqli_fetch_assoc($query);
    $row = mysqli_num_rows($query);

    if ($row > 0){
      $_SESSION['login'] = $dados['email'];
      $_SESSION['senha'] = $dados['senha'];
    }else{
      header('Location: /sair.php');
    }


  }else{
   $msg = "<p id='mensagem' style='text-shadow: 0px 0px 5px #f00; margin: 0;'>Senha atual não confere!3</p>";
 }

}



if (isset($_POST['btnAtualizarFoto'])) {

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
  <link href="style.css" rel="stylesheet">
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
          <li><a href='/sair.php'><i class='fa fa-sign-out' aria-hidden='true'></i> Sair</a></li>
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
      <div class="col-md-12">
        <div class="panel with-nav-tabs panel-default">
          <div class="panel-heading">
            <ul class="nav nav-tabs"> 
              <li class="active"><a href="#tab1default" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Meu Perfil</a></li>
              <li><a href="#tab2default" data-toggle="tab"><i class="fa fa-image" aria-hidden="true"></i> Minhas Fotos</a></li>
              <li><a href="#tab3default" data-toggle="tab"><i class="fa fa-share-square"></i> Enviar Fotos</a></li>
              <?php 
              if($permissao != 0 && $permissao != 1){
                echo "<li style='float: right;'><a href='#tab4default' data-toggle='tab'><i class='fa fa-cog'></i></a></li>";
              }?>
            </ul>
          </div>
          <div class="panel-body" style="color: #777;">
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab1default">
                <section class="block-content col-md-3 panel-margin">
                  <?php  echo "<img class='block-center img-responsive img-circle' src='".$path.$dados['foto']."'/>";  ?>
                  <section class="push-top-sm hr">
                    <?php  echo "<h4 class='text-center'>".$dados['nome']."</h4>";  ?>
                  </section>
                  <ul class="nav nav-tabs">
                    <li class="active" style="width: 100%;"><a href="#tab1default1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Informações do perfil</a></li>
                    <li style="width: 100%;"><a href="#tab1default2" data-toggle="tab"><i class="fa fa-edit" aria-hidden="true"></i> Editar perfil</a></li>
                    <li style="width: 100%;"><a href="#tab1default3" data-toggle="tab"><i class="fa fa-image" aria-hidden="true"></i> Imagem do perfil</a></li>
                  </ul>
                </section>

                <div class="tab-content">
                  <div id="tab1default1" class="tab-pane fade in active">
                    <section class="block-content panel-margin profile-classic">
                      <ul class="nav">
                        <?php  echo "<li><span><i class='fa fa-user' aria-hidden='true'></i> Usuário:</span> ".$dados['nome']."</li>";?>
                        <?php  echo "<li><span><i class='fa fa-envelope'></i> Email:</span><span><a href='mailto:".$dados['email']."'>".$dados['email']."</a></span></li>"; ?>
                        <li><span><i class="fa fa-circle" aria-hidden="true"></i> Estado:</span> Ativo</li>
                        <?php  echo "<li><span><i class='fa fa-calendar-o' aria-hidden='true'></i> Membro desde:</span> ".date("d/m/Y", strtotime($dados['data_cadastro']))."</li>"; ?>
                      </ul>
                    </section>
                  </div>

                  <div id="tab1default2" class="tab-pane fade">
                    <form id="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="atualizarCadastro">
                      <section class="block-content panel-margin profile-classic">
                        <span>Atualizar dados cadastrais</span>
                        <table class="width-100">
                          <tr>
                            <td colspan="3" style="width: 49%; height: 65px;">
                              <div class="input-group width-100">
                                <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                <input id="email" name="email" class="form-control" placeholder="E-mail" type="email" value="<?php echo $email ?>" required="">
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="3" style="width: 49%; height: 65px;">
                              <div class="input-group width-100" style="display: flex;">
                                <input id="passwordinput" name="passwordinput" type="password" placeholder="Informe sua nova senha" class="form-control input-md">
                                <button id="btnPasswordinput" class="input-group-addon fa fa-eye" type="button" style="width: 11%;"></button>
                              </div>
                            </td>

                            <td style="width: 2%;"/>

                            <td colspan="3" style="width: 49%;">
                              <div class="input-group width-100" style="display: flex;">
                                <input id="passwordinputConfirm" name="passwordinputConfirm" type="password" placeholder="Confirme sua senha" class="form-control input-md">
                                <button id="btnPasswordinputConfirm" class="input-group-addon fa fa-eye" type="button" style="width: 11%;"></button>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </section>

                      <section class="block-content panel-margin profile-classic">
                        <table class="width-100">
                          <tr>
                            <td colspan="3" style="width: 49%; height: 65px;">
                              <div class="input-group width-100">
                                <span class="input-group-addon" style="width: 12%;"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <input id="passwordAtual" name="passwordAtual" type="password" placeholder="Informe sua senha atual" class="form-control input-md" required="">
                              </div>      
                            </td>

                            <td style="width: 2%;"/>

                            <td colspan="3" style="width: 49%; vertical-align: bottom;">
                              <div class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                  <button id="btnAtualizar" name="btnAtualizar" type="submit" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Atualizar</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>

                        <?=$msg?>
                      </section>
                    </form>
                  </div>

                  <div id="tab1default3" class="tab-pane fade">
                    <section class="block-content panel-margin profile-classic">
                      <form id="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="atualizarFoto">
                        <table class="width-100">
                          <tr>
                            <td colspan="3" style="width: 49%; height: 65px;">
                              <?php  echo "<img class='block-center img-responsive img-circle imgCircle' src='".$path.$dados['foto']."'/>";  ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div colspan="3" style="margin-top: 10%;">
                                <input id="filebutton" name="file-input" onchange="readURL(this);" class="input-file width-100" type="file" accept="image/jpeg">
                                <span style="font-size: 12px;">*Foto do perfil (150 x 150)</span>
                              </div>
                            </td>
                            <td colspan="3" style="width: 49%; vertical-align: bottom;">
                              <div class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                  <button id="btnAtualizarFoto" name="btnAtualizarFoto" type="submit" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Atualizar</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </form>
                    </section>
                  </div>
                </div>


              </div>
              <div class="tab-pane fade" id="tab2default">Default 2</div>
              <div class="tab-pane fade" id="tab3default">Default 3</div>
              <div class="tab-pane fade" id="tab4default">Default 4</div>
            </div>
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
