<?php 
require_once("../../conexao.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$total_comissao_venda = $comissao_venda_imob + $comissao_venda_corretor;
$total_comissao_aluguel = $comissao_aluguel_imob * 1;
?>




<!DOCTYPE html>
<html>
<head>
	<title>Proposta de Aluguél</title>

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

	

	<img src="<?php echo $url_sistema ?>/sistema/painel/images/fichas/proposta-locacao.jpg" width="100%">

	<div align="center">
	<br>
	<small><small><small>
Autorizo a <?php echo $nome_sistema ?>, doravante denominada simplesmente "Imobiliária", a apresentar a proposta acima ao(s) vendedor(es), observado o
seguinte:<br><br>

1. Esta Proposta submete-se ao disposto nos Art. 722 a 729 da Lei nº 10.406/02 (Código Civil – Capítulo do Contrato de Corretagem), destacando-se a obrigação da
Imobiliária de executar a mediação com a diligência e a prudência que o negócio requer, prestando, espontaneamente, todas as informações sobre o andamento de
negociações, especialmente acerca da segurança ou riscos envolvidos, das alterações de valores e do mais que possa influir nos resultados desta incumbência (Art.
723);<br><br>

2. Aceita a proposta, autorizo a Imobiliária a providenciar o contrato de locação, para assinatura das partes, comprometendo-me a apresentar e/ou pagar as despesas
para preparação da documentação necessária à efetivação da transação;<br><br>

3. Declaro estar ciente de que, nos termos do Código Civil, deverei remunerar a Imobiliária pelo equivalente a ______(____________) do valor total desta proposta,
caso: a) desista de efetivar a transação proposta, sem que haja motivação jurídica aceitável para a desistência;b) a proposta seja recusada pelos proprietários e
posteriormente inicie ou efetive negociação do imóvel sem a participação da Imobiliária, inclusive por meio de familiares ou representantes, em valores e condições
iguais ou diferentes das ora propostas.
</small></small></small>

<br><br><br>

<img src="<?php echo $url_sistema ?>/sistema/painel/images/fichas/assinatura-proposta-aluguel.jpg" width="100%">


	</div>	




				

				





</body>
</html>