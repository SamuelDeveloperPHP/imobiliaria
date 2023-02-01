<?php 

include_once("sistema/conexao.php");
include_once("cabecalho.php");

 ?>


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section spad set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h4><?php echo $nome_sistema ?></h4>
                        <div class="bt-option">
                            <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                            <span>Sobre</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="at-title">
                            <h3><small><b>Bem vindo a <?php echo $nome_sistema ?></b></small></h3>
                            <p>Lorem Ipsum has been the industry?s standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type.</p>
                        </div>
                        <div class="at-feature">
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="img/chooseus/chooseus-icon-1.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>Os melhores imóveis</h6>
                                    <p>We help you find a new home by offering a smart real estate.</p>
                                </div>
                            </div>
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="img/chooseus/chooseus-icon-2.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>Sus compra facilita</h6>
                                    <p>Find an agent who knows your market best</p>
                                </div>
                            </div>
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="img/chooseus/chooseus-icon-3.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>Corretores Especilizados</h6>
                                    <p>Millions of houses and apartments in your favourite cities</p>
                                </div>
                            </div>
                            <div class="af-item">
                                <div class="af-icon">
                                    <img src="img/chooseus/chooseus-icon-4.png" alt="">
                                </div>
                                <div class="af-text">
                                    <h6>Melhores Localizações</h6>
                                    <p>Sign up now and sell or rent your own properties</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic set-bg" data-setbg="img/about-us.jpg">
                        <a href="https://www.youtube.com/watch?v=8EJ3zbKTWQ8" class="play-btn video-popup">
                            <i class="fa fa-play-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

 
   <!-- Team Section Begin -->
<section class="team-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="section-title">
                    <h4>Corretores Destaques</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="team-btn">
                    <a href="corretores.php"><i class="fa fa-user"></i> Ver Todos</a>
                </div>
            </div>
        </div>
        <div class="row">

             <?php 
          $res = $pdo->query("SELECT * FROM usuarios where (nivel = 'Corretor' or nivel = 'Administrador') and ativo = 'Sim' order by id desc limit 3");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $id = $dados[$i]['id_func'];

             $res_2 = $pdo->query("SELECT * FROM funcionarios where id = '$id'");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
            if(@count($dados_2)> 0) {

                        $nome = $dados_2[0]['nome'];                       
                        $telefone = $dados_2[0]['telefone'];
                        $email = $dados_2[0]['email'];                        
                        $imagem = $dados_2[0]['foto'];
               
           }else{
            $nome = $dados[$i]['nome'];                     
            $telefone = $tel_sistema;
            $email = $dados[$i]['email'];                      
            $imagem = $dados[$i]['foto'];
           }        

            
                        

            ?>

           
            <div class="col-md-4">
                <div class="ts-item">
                    <div class="ts-text">
                        <img src="sistema/painel/images/perfil/<?php echo $imagem ?>" alt="">
                        <h5><?php echo $nome ?></h5>
                        <span><i class="fa fa-whatsapp mr-1"></i><?php echo $telefone ?></span>                        
                        <div class="ts-social">                           
                            <a target="_blank" title="<?php echo $email ?>" href="<?php echo $email ?>"><i class="fa fa-envelope-o"></i></a>
                            <a target="_blank" title="<?php echo $telefone ?>" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefone ?>"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <?php  }
               ?>


        </div>
    </div>
</section>
<!-- Team Section End -->



   
    <!-- Testimonial Section Begin -->
<section class="testimonial-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>Alguns de nossos Clientes</h4>
                </div>
            </div>
        </div>
        <div class="row testimonial-slider owl-carousel">
            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>Lorem ipsum dolor amet, consectetur adipiscing elit, seiusmod tempor incididunt ut labore
                            magna aliqua. Quis ipsum suspendisse ultrices gravida accumsan lacus vel facilisis.</p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="img/testimonial-author/ta-1.jpg" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Arise Naieh</h5>
                            <span>Designer</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>Lorem ipsum dolor amet, consectetur adipiscing elit, seiusmod tempor incididunt ut labore
                            magna aliqua. Quis ipsum suspendisse ultrices gravida accumsan lacus vel facilisis.</p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="img/testimonial-author/ta-2.jpg" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Arise Naieh</h5>
                            <span>Designer</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>Lorem ipsum dolor amet, consectetur adipiscing elit, seiusmod tempor incididunt ut labore
                            magna aliqua. Quis ipsum suspendisse ultrices gravida accumsan lacus vel facilisis.</p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="img/testimonial-author/ta-1.jpg" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Arise Naieh</h5>
                            <span>Designer</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->

 <?php 
include_once("rodape.php");
 ?> 

