<?php

session_start();

$msg='';

if(isset($_SESSION['cmsg'])){
  $cmsg = $_SESSION['cmsg'];

  switch($cmsg){
    case 1:
    $msg = toast_message("toast-success", "Sua mensagem foi enviada. Obrigado!");
    unset($_SESSION['cmsg']);
    break;

    case 2:
    $msg = toast_message("toast-error", "Falha no envio da mensagem!");
    unset($_SESSION['cmsg']);
    break;
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
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <!-- Fonts -->

  <script src="https://use.fontawesome.com/0ca22a4c02.js"></script>
  <link href="css/animate.css" rel="stylesheet" />
  <!-- Squad theme CSS -->
  <link href="../toastr/toastr.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="color/default.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="../toastr/toastr.js"></script>
  <script type="text/javascript" src="../toastr/toastr.min.js"></script>
  <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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
            <?php 
            if(isset($_SESSION["login"]) || isset($_SESSION["senha"])){
              echo "<li><a href='/painel'>Painel</a></li>";
              echo "<li><a href='/sair.php'><i class='fa fa-sign-out' aria-hidden='true'></i> Sair</a></li>";
            }else{
              echo "<li><a href='/login'><i class='fa fa-sign-in' aria-hidden='true'></i> Entrar</a></li>";
            }?>
          </ul>
        </div>

        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#intro">Home</a></li>
            <li><a href="#jogos">Jogos</a></li>
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="#contact">Contato</a></li>
            <li><a href="/galeria">Galeria</a></li>
            <li><a class="ifancybox" href="https://docs.google.com/forms/d/e/1FAIpQLSfKUjGVnpolEFRAuxI2Ati2C28M1Doij9uQtZPqpjyZr0J6ww/viewform">Aliste-se Já</a></li>
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
    <div class="pattern"></div>

    <div class="slogan">
      <h2>BEM-VINDOS</h2>
      <h4>OPERATION TACTICS SNOW BLACK</h4>
    </div>
    <div class="page-scroll">
      <a href="#jogos" class="btn btn-circle">
        <i class="fa fa-angle-double-down animated"></i>
      </a>
    </div>
  </section>
  <!-- /Section: intro -->

  <!-- Section: jogos -->
  <section id="jogos" class="home-section">
    <div class="text-center">
      <div class="heading-about">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="wow bounceInDown" data-wow-delay="0.4s">
                <div class="section-heading">
                  <h2>PRINCIPAIS JOGOS</h2>
                  <i class="fa fa-2x fa-angle-down"></i>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-lg-offset-5">
            <hr class="marginbot-50">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.2s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/titanfall2_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>TITANFALL 2</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.2s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/battlefield_1_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>BATTLEFIELD 1</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.2s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/battlefield_4_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>BATTLEFIELD 4</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.2s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/gtav_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>GRAND THEFT AUTO V</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.3s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/warframe_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>WARFRAME</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.3s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/ark_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>ARK Survival Evolved</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.3s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/rust_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>Rust</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.3s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/dayz_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>Dayz</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.4s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/bp_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>Playerunknown's Battlegrounds</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.4s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/rainbow_six_siege_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>Tom Clancy's Rainbow Six Siege</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.4s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/cs-go-logo-.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>COUNTER STRIKE GLOBAL OFFENSIVE</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="wow fadeInDown" data-wow-delay="0.4s">
              <div class="service-box">
                <div class="service-icon">
                  <img src="img/icons/creativerse_logo.png" alt="" />
                </div>
                <div class="service-desc">
                  <h5>CREATIVERSE</h5>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="moreGames" class="text-center wow fadeInDown" data-wow-delay="0.4s">
      <button id="btnMoreGames" class="btn btn-default">Mostrar Mais</button>
    </div>

    <div id="moreGames" class="text-center">
      <div id="divMoreGames" class="container" style="display: none;">
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/league_of_legends_logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>LEAGUE OF LEGENDS</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/rocket_league.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>ROCKET LEAGUE</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/dota2_logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>DOTA 2</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/fortnite_logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>FORTNITE</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/hearthstone_logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>HEARTHSTONE</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/overwatch-logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>OVERWATCH</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/paladins-logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>PALADINS</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/smite-logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>SMITE</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow fadeInDown" data-wow-delay="0.1s">
            <div class="service-box">
              <div class="service-icon">
                <img src="img/icons/warface-logo.png" alt="" />
              </div>
              <div class="service-desc">
                <h5>WARFACE</h5>
                <p></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- /Section: jogos -->

<!-- Section: sobre -->
<section id="sobre" class="home-section text-center bg-gray">
  <div class="heading-about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow bounceInDown" data-wow-delay="0.4s">
            <div class="section-heading">
              <h2>Fundadores</h2>
              <i class="fa fa-2x fa-angle-down"></i>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">

    <div class="row">
      <div class="col-lg-2 col-lg-offset-5">
        <hr class="marginbot-50">
      </div>
    </div>
    <div class="row centralizar-divs">
      <div class="col-md-3">
        <div class="wow bounceInUp" data-wow-delay="0.5s">
          <div class="team boxed-grey">
            <div class="inner">
              <h5>KLRaimondi</h5>
              <p class="subtitle">Kevin Raimondi</p>
              <div class="avatar"><img src="img/team/2.jpg" alt="" class="img-responsive img-circle" /></div>

              <ul class="company-social text-align-center">
                <li class="social-facebook"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li class="social-twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li class="social-youtube"><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li class="social-steam"><a href="http://steamcommunity.com/profiles/76561198122201759" target="_blank"><i class="fa fa-steam"></i></a></li>
              </ul>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="wow bounceInUp" data-wow-delay="0.6s">
          <div class="team boxed-grey">
            <div class="inner">
              <h5>MegaKingBR</h5>
              <p class="subtitle">Fábio Lucena Ribas</p>
              <div class="avatar"><img src="img/team/3.jpg" alt="" class="img-responsive img-circle" /></div>

              <ul class="company-social text-align-center">
                <li class="social-facebook"><a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li class="social-twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li class="social-youtube"><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li class="social-steam"><a href="http://steamcommunity.com/id/MegaKingBR" target="_blank"><i class="fa fa-steam" aria-hidden="true"></i></a></li>
              </ul>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Section: sobre -->

<!-- Section: contact -->
<section id="contact" class="home-section text-center">
  <div class="heading-contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow bounceInDown" data-wow-delay="0.4s">
            <div class="section-heading">
              <h2>Contato</h2>
              <i class="fa fa-2x fa-angle-down"></i>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
<?=$msg?>
    <div class="row">
      <div class="col-lg-2 col-lg-offset-5">
        <hr class="marginbot-50">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="boxed-grey">
          <form id="contact-form" action="enviar.php" method="post" >
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">
                  *Nome</label>
                  <input type="text" name="nome" class="form-control" id="nome" placeholder="Seu Nome" data-rule="minlen:4" data-msg="Digite pelo menos 4 caracteres" required="" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <label for="email">
                  *E-mail</label>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Seu E-mail" data-rule="email" data-msg="Por favor digite um email válido" required=""/>
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="subject">
                  *Assunto</label>
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" data-rule="minlen:4" data-msg="Digite pelo menos 8 caracteres de assunto" required=""/>
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">
                  *Mensagem</label>
                  <textarea class="form-control" name="mensagem" rows="5" data-rule="required" data-msg="Escreva algo para nós" placeholder="Mensagem" required=""></textarea>
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-12">
               <button type="submit" name="enviar" class="btn btn-default pull-right" id="btnContactUs">
               Enviar</button>
             </div>
           </div>
         </form> 
       </div>
     </div>

     <div class="col-lg-4">
      <div class="widget-contact">

        <address>
          <strong>Servidor TS3</strong><br>
          <a href="ts3server://177.93.106.87?port=3016">177.93.106.87:3016</a><i class="fa fa-external-link" aria-hidden="true" style="margin-left: 5px"></i>

        </address>

        <address>
          <strong>Email</strong><br>
          <i class="fa fa-envelope" aria-hidden="true" style="margin-right: 5px"></i><a href="mailto:#">contato@kraimondi.tech</a>
        </address>
        <address>
          <strong>Estamos nas redes sociais</strong><br>
          <ul class="company-social">
            <li class="social-facebook"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li class="social-twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li class="social-youtube"><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
            <li class="social-steam"><a href="http://steamcommunity.com/groups/OTSB_Oficial" target="_blank"><i class="fa fa-steam"></i></a></li>
          </ul>
        </address>
      </div>
    </div>
  </div>

</div>
</section>
<!-- /Section: contact -->

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="wow shake" data-wow-delay="0.4s">
          <div class="page-scroll marginbot-30">
            <a href="#intro" id="totop" class="btn btn-circle">
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
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/jquery.scrollTo.js"></script>
  <script src="js/wow.min.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>

</html>
