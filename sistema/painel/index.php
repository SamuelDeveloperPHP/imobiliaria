<?php 
require_once("verificar.php");
require_once("../conexao.php");

$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";

$id_usuario = @$_SESSION['id_usuario'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome_user = $res[0]['nome'];
	$foto_usu = $res[0]['foto'];
	$nivel_usu = $res[0]['nivel'];
	$cpf_usu = $res[0]['cpf'];
	$cpf_user = $res[0]['cpf'];
	$senha_usu = $res[0]['senha'];
	$email_usu = $res[0]['email'];
	$id_usu = $res[0]['id'];
}

if( @$_GET['pagina'] == ""){
	$pagina = 'home';
}else{
	$pagina = @$_GET['pagina'];	
}




$esc_tes = '';
$esc_cor = '';
$esc_recep = '';

$classe_widget = '';
//PERMISSÕES DOS USUÁRIOS
if($nivel_usu == "Corretor"){
	$esc_cor = 'ocultar';
}else if($nivel_usu == "Tesoureiro"){
	$esc_tes = 'ocultar';
}else if($nivel_usu == "Recepcionista"){
	$esc_recep = 'ocultar';
}else if($nivel_usu == "Administrador"){
	$esc_admin = 'ocultar';
}

if($nivel_usu != "Administrador"){
	$esc_todos = 'ocultar';
}


?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $nome_sistema; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Sistema para Escritórios desenvolvido no curso do Hugo Vasconcelos do Portal Hugo Cursos" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons CSS-->

	<!-- side nav css file -->
	<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
	<!-- //side nav css file -->

	<link rel="stylesheet" href="css/monthly.css">

	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>

	<!--webfonts-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<!--//webfonts--> 

	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->

	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->

	<link rel="icon" href="../imagens/favicon.ico" type="image/x-icon">
	<style>
		#chartdiv {
			width: 100%;
			height: 295px;
		}
	</style>
	<!--pie-chart --><!-- index page sales reviews visitors pie chart -->
	<script src="js/pie-chart.js" type="text/javascript"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			$('#demo-pie-1').pieChart({
				barColor: '#ffc168',
				trackColor: '#eee',
				lineCap: 'round',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-2').pieChart({
				barColor: '#09872d',
				trackColor: '#eee',
				lineCap: 'butt',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-3').pieChart({
				barColor: '#de1024',
				trackColor: '#eee',
				lineCap: 'square',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});


		});

	</script>
	<!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

	<!-- requried-jsfiles-for owl -->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel({
				items : 3,
				lazyLoad : true,
				autoPlay : true,
				pagination : true,
				nav:true,
			});
		});
	</script>
	<!-- //requried-jsfiles-for owl -->

	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left">
				<nav class="navbar navbar-inverse" style="overflow: scroll; height:100%; scrollbar-width: thin;">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="./"><span class="fa fa-area-chart"></span> Imobiliária<span class="dashboard_text">Sistema Gestão</span></a></h1>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header">MENU DE NAVEGAÇÃO</li>
							<li class="treeview">
								<a href="./">
									<i class="fa fa-dashboard"></i> <span>Home</span>
								</a>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-plus"></i>
									<span>Cadastros</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=cargos"><i class="fa fa-angle-right"></i> Cargos</a></li>
									<li><a href="index.php?pagina=tipos"><i class="fa fa-angle-right"></i> Tipos Imóveis</a></li>

									<li><a href="index.php?pagina=cidades"><i class="fa fa-angle-right"></i> Cidades</a></li>
									<li><a href="index.php?pagina=bairros"><i class="fa fa-angle-right"></i> Bairros</a></li>
									<li><a href="index.php?pagina=contas_banco"><i class="fa fa-angle-right"></i> Contas Bancárias</a></li>

									<li><a href="index.php?pagina=frequencias"><i class="fa fa-angle-right"></i> Frequências</a></li>
								</ul>
							</li>


							<li class="treeview">
								<a href="#">
									<i class="fa fa-home"></i>
									<span>Imóveis</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=imoveis"><i class="fa fa-angle-right"></i> Imóveis Cadastrados</a></li>
									<li><a href="index.php?pagina=imoveis-venda"><i class="fa fa-angle-right"></i> Imóveis Venda</a></li>

									<li><a href="index.php?pagina=imoveis-locacao"><i class="fa fa-angle-right"></i> Imóveis Locação</a></li>

									<li><a href="index.php?pagina=imoveis-vendidos"><i class="fa fa-angle-right"></i> Imóveis Vendidos</a></li>

									<li><a href="index.php?pagina=imoveis-alugados"><i class="fa fa-angle-right"></i> Imóveis Alugados</a></li>

									<li><a href="index.php?pagina=imoveis-inativos"><i class="fa fa-angle-right"></i> Imóveis Inativos</a></li>


								</ul>
							</li>
							
							<li class="treeview">
								<a href="#">
									<i class="fa fa-user"></i>
									<span>Pessoas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">								
									<li class="<?php echo $esc_tes ?> <?php echo $esc_cor ?>"><a href="index.php?pagina=funcionarios"><i class="fa fa-angle-right"></i> Funcionários</a></li>

									<li class=""><a href="index.php?pagina=vendedores"><i class="fa fa-angle-right"></i> Vendedores / Locadores</a></li>

									<li class=""><a href="index.php?pagina=compradores"><i class="fa fa-angle-right"></i> Compradores</a></li>


									<li class=""><a href="index.php?pagina=locatarios"><i class="fa fa-angle-right"></i> Locatários</a></li>

									
									<li class="<?php echo $esc_todos ?>"><a href="index.php?pagina=usuarios"><i class="fa fa-angle-right"></i> Usuários</a></li>

								</ul>
							</li>

							<li class="treeview">
								<a href="index.php?pagina=agenda">
									<i class="fa fa-calendar-o"></i> <span>Agenda</span>
								</a>
							</li>


							<li class="treeview <?php echo $esc_todos ?>">
								<a href="index.php?pagina=tarefas">
									<i class="fa fa-clock-o"></i> <span>Tarefas Usuários</span>
								</a>
							</li>



							<li class="treeview">
								<a href="#">
									<i class="fa fa-dollar"></i>
									<span>Financeiro</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">								
									<li class="<?php echo $esc_recep ?>"><a href="index.php?pagina=pagar"><i class="fa fa-angle-right"></i> Contas à Pagar</a></li>

									<li class="<?php echo $esc_recep ?>"><a href="index.php?pagina=receber"><i class="fa fa-angle-right"></i> Contas à Receber</a></li>

									<li class="<?php echo $esc_recep ?> <?php echo $esc_cor ?>"><a href="index.php?pagina=movimentacoes"><i class="fa fa-angle-right"></i> Extrato Caixa</a></li>


									<li class="<?php echo $esc_recep ?>"><a href="index.php?pagina=comissoes"><i class="fa fa-angle-right"></i> Comissões</a></li>


									<li class="<?php echo $esc_recep ?> <?php echo $esc_cor ?>"><a href="index.php?pagina=vendas"><i class="fa fa-angle-right"></i> Vendas</a></li>

									<li class="<?php echo $esc_recep ?> <?php echo $esc_cor ?>"><a href="index.php?pagina=alugueis"><i class="fa fa-angle-right"></i> Aluguéis</a></li>


									
								</ul>
							</li>		




							<li class="treeview <?php echo $esc_recep ?>">
								<a href="#">
									<i class="fa fa-file-o"></i>
									<span>Relatórios Financeiros</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">						


									<li class="<?php echo $esc_cor ?>"><a href="#" data-toggle="modal" data-target="#RelFin"><i class="fa fa-angle-right"></i> Relatório Movimentações</a></li>

									<li class=""><a href="#" data-toggle="modal" data-target="#RelCom"><i class="fa fa-angle-right"></i> Relatório Comissões</a></li>

									<li class=""><a href="#" data-toggle="modal" data-target="#RelVen"><i class="fa fa-angle-right"></i> Relatório Vendas</a></li>

									<li class=""><a href="#" data-toggle="modal" data-target="#RelAlu"><i class="fa fa-angle-right"></i> Relatório Aluguéis</a></li>


									<li class=""><a href="#" data-toggle="modal" data-target="#RelPagar"><i class="fa fa-angle-right"></i> Relatório Contas Pagar</a></li>


									<li class=""><a href="#" data-toggle="modal" data-target="#RelReceb"><i class="fa fa-angle-right"></i> Relatório Contas Receber</a></li>


									<li class=""><a href="rel/recibo_class.php" target="_blank" ><i class="fa fa-angle-right"></i> Recibo de Pagamento</a></li>
										
									

								</ul>
							</li>	




								<li class="treeview <?php echo $esc_recep ?>">
								<a href="#">
									<i class="fa fa-file-o"></i>
									<span>Contratos e PDFs</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">						


									<li><a href="rel/proposta_compra_class.php" target="_blank"><i class="fa fa-angle-right"></i> Proposta Compra</a></li>

									<li><a href="rel/proposta_aluguel_class.php" target="_blank"><i class="fa fa-angle-right"></i> Proposta Locação</a></li>

									<li ><a href="index.php?pagina=laudos"><i class="fa fa-angle-right"></i> Laudo Vistorias</a></li>


									<li class=""><a href="index.php?pagina=vendas_juridico"><i class="fa fa-angle-right"></i> Vendas</a></li>

									<li class=""><a href="index.php?pagina=alugueis_juridico"><i class="fa fa-angle-right"></i> Aluguéis</a></li>

									

								
								</ul>
							</li>	


							


						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</aside>
		</div>
		<!--left-fixed -navigation-->

		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left"><!--notifications of menu start -->
					<ul class="nofitications-dropdown">


						<?php 
						$query2 = $pdo->query("SELECT * FROM tarefas where status = 'Agendada' and usuario = '$id_usuario' order by data asc, hora asc ");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						$tarefasPendentes_taref = @count($res2);

						$query = $pdo->query("SELECT * FROM tarefas where status = 'Agendada' and usuario = '$id_usuario' order by data asc, hora asc limit 6 ");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$tarefasPendentes_taref_limit = @count($res);
						?>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue1"><?php echo $tarefasPendentes_taref ?></span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>Você possui <?php echo $tarefasPendentes_taref ?> Tarefas Pendentes!</h3>
									</div>
								</li>

								<?php 
								if($tarefasPendentes_taref_limit > 0){
									for($i=0; $i < $tarefasPendentes_taref_limit; $i++){
										foreach ($res[$i] as $key => $value){}
											$id_taref = $res[$i]['id'];
										$titulo_taref = $res[$i]['titulo'];	
										$hora_taref = $res[$i]['hora'];
										$data_taref = $res[$i]['data'];

										$dataF_taref = implode('/', array_reverse(explode('-', $data_taref)));
										$horaF_taref = date("H:i", strtotime($hora_taref));
										?>
										<li>
											<a href="#">
												<div class="notification_desc">
													<p><i class="fa fa-calendar-o text-danger" style="margin-right: 3px"></i><?php echo $titulo_taref ?></p>
													<p><span><?php echo $dataF_taref ?> às <?php echo $horaF_taref ?></span></p>
												</div>
												<div class="clearfix"></div>	
											</a>
											<hr style="margin:2px">
										</li>
									<?php }} ?>								
									

									<li>
										<div class="notification_bottom">
											<a href="index.php?pagina=agenda">Ver toda Agenda</a>
										</div> 
									</li>
								</ul>
							</li>	

						</ul>


						<div class="clearfix"> </div>
					</div>
					<!--notification menu end -->
					<div class="clearfix"> </div>
				</div>
				<div class="header-right">




					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span class="prfil-img"><img src="images/perfil/<?php echo $foto_usu ?>" alt="" width="50px" height="50px"> </span> 
										<div class="user-name">
											<p><?php echo $nome_user ?></p>
											<span><?php echo $nivel_usu ?></span>
										</div>
										<i class="fa fa-angle-down lnr"></i>
										<i class="fa fa-angle-up lnr"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">

									<li> <a href="#" data-toggle="modal" data-target="#modalPerfil"><i class="fa fa-user"></i> Perfil</a> </li> 

									<li class="<?php echo $esc_todos ?>"> <a href="#" data-toggle="modal" data-target="#modalConfig"><i class="fa fa-cog"></i> Configurações</a> </li> 

									<li> <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>				
				</div>
				<div class="clearfix"> </div>	
			</div>
			<!-- //header-ends -->




			<!-- main content start-->
			<div id="page-wrapper">
				<?php 					
				require_once($pagina.'.php');	
				?>
			</div>






		</div>

		<!-- new added graphs chart js-->

		<script src="js/Chart.bundle.js"></script>
		<script src="js/utils.js"></script>

		

		<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
			showLeftPush = document.getElementById( 'showLeftPush' ),
			body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};


			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
		<!-- //Classie --><!-- //for toggle left push menu script -->

		<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->

		<!-- side nav js -->
		<script src='js/SidebarNav.min.js' type='text/javascript'></script>
		<script>
			$('.sidebar-menu').SidebarNav()
		</script>
		<!-- //side nav js -->

		<!-- for index page weekly sales java script -->
		<script src="js/SimpleChart.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.js"> </script>
		<!-- //Bootstrap Core JavaScript -->

		<!-- Mascaras JS -->
		<script type="text/javascript" src="js/mascaras.js"></script>
		<!-- Ajax para funcionar Mascaras JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

	</body>
	</html>

	<script type="text/javascript">
		$("#form-config").submit(function () {

			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "editar-config.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {
					$('#msg-config').text('');
					$('#msg-config').removeClass()
					if (mensagem.trim() == "Salvo com Sucesso") {					
						location.reload();
					} else {

						$('#msg-config').addClass('text-danger')
						$('#msg-config').text(mensagem)
					}


				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>





