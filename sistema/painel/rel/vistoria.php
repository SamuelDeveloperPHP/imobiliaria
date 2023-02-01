<?php 
require_once("../../conexao.php");
$id = $_GET['id'];
$texto = $_GET['area'];



$query = $pdo->query("SELECT * from imoveis where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$endereco = $res[0]['endereco'];
	$cidade = $res[0]['cidade'];
	$bairro = $res[0]['bairro'];

	$query = $pdo->query("SELECT * from cidades where id = '$cidade' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_cidade = $res[0]['nome'];

	$query = $pdo->query("SELECT * from bairros where id = '$bairro' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_bairro = $res[0]['nome'];

}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Laudo de Vistoria</title>

	<?php 
	if($relatorio_pdf != 'pdf'){
		?>
		<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="image/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 0px;

		}

		body{
			margin-top:0px;
			font-family:Times, "Times New Roman", Georgia, serif;
		}


		<?php if($relatorio_pdf == 'pdf'){ ?>

			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;
				position:absolute;
				bottom:0;
			}

		<?php }else{ ?>
			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;

			}

		<?php } ?>

		.cabecalho {    
			padding:10px;
			margin-bottom:30px;
			width:100%;
			font-family:Times, "Times New Roman", Georgia, serif;
		}


		hr{
			margin:8px;
			padding:0px;
		}


		
		
		.imagem {
			width: 200px;
			position:absolute;
			left:5px;
			top:10px;
			height:60px;
		}

		.linha {			
			position:absolute;
			left:210px;
			top:0px;
			height:95px;
		}

		.texto-cab {			
			position:absolute;
			left:220px;
			top:10px;
		}

		.container-texto{
			margin:20px;
		}

					

	</style>


</head>
<body>	


	<div class="row">
		<div class="col-md-4">
			<?php 
			if($logo_rel != ''){
				?>
				<img class="imagem" src="<?php echo $url_sistema ?>/sistema/imagens/<?php echo $logo_rel ?>" width="200px" height="60px">

				<img class="linha" src="<?php echo $url_sistema ?>/sistema/imagens/linha-cabecalho.jpg" height="60px">

			<?php } ?>


		</div>

		<div class="texto-cab">
			<span><small><?php echo mb_strtoupper($nome_sistema) ?></small></span><br>
			<span><small><small><small><?php echo $end_sistema ?></small></small></small></span> <br>
			<span><small><small><small>TEL: <?php echo $tel_sistema ?></small></small></small></span>
			<span style="margin-left:20px"><small><small><small>CRECI: <?php echo $creci_imob ?></small></small></small></span>

			<span style="margin-left:20px"><small><small><small>CNPJ: <?php echo $cnpj_imob ?></small></small></small></span>

		</div>
	</div>			
	
	

	<br><br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>

	<div class="mx-2" style="padding-top:10px ">

	<br>
	<div align="center">
	<b>LAUDO DE VISTORIA</b>
	</div>
	<br>

<div class="container-texto">
<small><small>
	O presente laudo é o resultado da <b>vistoria realizada em</b> ___/___/______, no imóvel localizado no seguinte endereço <?php echo $endereco ?>, Bairro <?php echo $nome_bairro ?>, Cidade <?php echo $nome_cidade ?>, cujas condições atuais encontram-se detalhadamentes descritas a seguir. <br>

	Este instrumento é parte integrante do <b>contrato de locação</b> firmado entre as partes e deve ser o mesmo anexado.
</small></small>
<br><br>
<small><small><b>DAS CONDIÇÕES DO IMÓVEL</b></small></small>
<hr>

<small><small>
<?php echo $texto ?>
</small></small>

<br><br>
<small><small><b>DA APROVAÇÃO DAS PARTES</b></small></small>
<br>

<small><small>
Ao assinarem este termo, as partes concordam integralmente com o que é nele relatado.<br>
Após entrega das chaves, caso seja verificada qualquer irregularidade que não esteja devidamente explícita neste laudo, o <b>LOCADOR</b> deve ser imediatamente comunicado.<br>
Doravante, o <b>LOCATÁRIO</b> se responsabiliza pela conservação integral do imóvel.<br>
Findo o contrato de locação, o <b>LOCATÁRIO</b> se compromente a restituir o imóvel a seu proprietário nas mesmas condições aqui descritas.
</small></small>

<br><br><br>
<div align="center">
______________________________________,____/____/________ <br>
<small><small>(Local e Data de assinatura)</small></small>
<br><br><br>

_______________________________________ <br>
<small><small><b>LOCADOR</b></small></small>
<br><br><br>

_______________________________________ <br>
<small><small><b>LOCATÁRIO</b></small></small>
<br><br><br>

</div>



</div>




</body>
</html>