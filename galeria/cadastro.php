<?php
// Conexão com o banco de dados
require ("conexao.php");

$path = "img/profile/";

// Se o usuário clicou no botão cadastrar efetua as ações
if (isset($_POST['cadastrar'])) {

  // Recupera os dados dos campos
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $foto = $_FILES["foto"];
  
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

      // Insere os dados no banco
      $sql = mysqli_query($conn, "INSERT INTO usuarios VALUES ('', '".$nome."', '".$email."', '".$nome_imagem."')");

      // Se os dados forem inseridos com sucesso
      if ($sql){
        echo "Você foi cadastrado com sucesso.";
      }else{
        unlink($caminho_imagem);
        echo $caminho_imagem;
      }
    }

    // Se houver mensagens de erro, exibe-as
    if (count($error) != 0) {
      foreach ($error as $erro) {
        echo $erro . "<br />";
      }
    }
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
  <link rel="stylesheet" href="css/gridGallery.css" />

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
      <div id="load"></div>
    </div>

    <section id="galeria" class="nav-section">
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
              <li><a href="/">Home</a></li>
              <li><a href="/#jogos">Jogos</a></li>
              <li><a href="/#sobre">Sobre</a></li>
              <li><a href="/#contact">Contato</a></li>
              <li class="active"><a href="/galeria">Galeria</a></li>
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

</section>
<!-- Section: intro -->
<section class="logo galeria-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="boxed-grey">

          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >
            Nome:<br />
            <input type="text" name="nome" /><br /><br />
            Email:<br />
            <input type="text" name="email" /><br /><br />
            Senha:<br />
            <input type="password" name="senha" /><br /><br />
            Foto de exibição:<br />

            <input type="file" name="foto" accept="image/jpeg" /><br /><br />
            <input type="submit" name="cadastrar" value="Cadastrar" />
          </form>

        </div>
      </div>
    </div>
  </div>

</section>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="wow shake" data-wow-delay="0.4s">
          <div class="page-scroll marginbot-30">
            <a href="#galeria" id="totop" class="btn btn-circle">
             <i class="fa fa-angle-double-up animated"></i>
           </a>
         </div>
       </div>
       <p>&copy;SquadFREE. All rights reserved.</p>
       <div class="credits">
            <!--
              All the links in the footer should remain intact. 
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Squadfree
            -->
            <a href="https://bootstrapmade.com/bootstrap-one-page-templates/">Bootstrap One Page Templates</a> by BootstrapMade
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Core JavaScript Files -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/wow.min.js"></script>

  <!-- Custom Theme JavaScript -->
  <script src="../js/custom.js"></script>
  <script src="js/jquery-1.9.1.min.js"></script>

</body>

</html>
