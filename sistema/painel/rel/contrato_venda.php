<?php 
require_once("../../conexao.php");
$id = $_GET['id'];

$query = $pdo->query("SELECT * from vendas where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$valor = $res[0]['valor_total'];
		$vendedor = $res[0]['vendedor'];
		$comprador = $res[0]['comprador'];
		$comissao_corretor = $res[0]['comissao_corretor'];
		$comissao_imob = $res[0]['comissao_imob'];
		$corretor = $res[0]['corretor'];
		$data = $res[0]['data'];
		$data_pgto = $res[0]['data_pgto'];
		$obs = $res[0]['obs'];
		$pago = $res[0]['pago'];
		$usuario = $res[0]['usuario'];
		$imovel = $res[0]['imovel'];

	
	//retirar quebra de texto do obs		
		$dataF = implode('/', array_reverse(explode('-', $data)));
		$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));

		$valorF = number_format($valor, 2, ',', '.');
		$comissao_corretorF = number_format($comissao_corretor, 2, ',', '.');
		$comissao_imobF = number_format($comissao_imob, 2, ',', '.');

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_corretor = $res2[0]['nome'];
		}else{
			$nome_corretor = 'Sem Registro';
		}
		

		$query2 = $pdo->query("SELECT * FROM compradores where id = '$comprador'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_comprador = $res2[0]['nome'];
			$cpf_comprador = $res2[0]['doc'];
			$estado_civil_comprador = ', '.$res2[0]['estado_civil'];
			$nacionalidade_comprador = $res2[0]['nacionalidade'];
			$endereco_comprador = $res2[0]['endereco'];
			$tipo_pessoa_comprador = $res2[0]['pessoa'];
			if($tipo_pessoa_comprador != 'Física'){
				$estado_civil_comprador = '';
				$tipo_doc_comprador = 'CNPJ';
			}else{
				$tipo_doc_comprador = 'CPF';
			}
		}


		$query2 = $pdo->query("SELECT * FROM vendedores where id = '$vendedor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_vendedor = $res2[0]['nome'];
			$cpf_vendedor = $res2[0]['doc'];
			$estado_civil_vendedor = ', '.$res2[0]['estado_civil'];
			$nacionalidade_vendedor = $res2[0]['nacionalidade'];
			$endereco_vendedor = $res2[0]['endereco'];
			$tipo_pessoa_vendedor = $res2[0]['pessoa'];
			$banco_vendedor = $res2[0]['banco'];
			$tipo_conta_vendedor = $res2[0]['tipo'];
			$agencia_vendedor = $res2[0]['agencia'];
			$conta_vendedor = $res2[0]['conta'];
			//$pix_vendedor = $res2[0]['pix'];
			if($tipo_pessoa_vendedor != 'Física'){
				$estado_civil_vendedor = '';
				$tipo_doc_vendedor = 'CNPJ';
			}else{
				$tipo_doc_vendedor = 'CPF';
			}
		}


}


$query = $pdo->query("SELECT * from imoveis where id = '$imovel' ");
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



setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>




<!DOCTYPE html>
<html>
<head>
	<title>Contrato de Venda</title>

	<?php 
	if($relatorio_pdf != 'pdf'){
		?>
		<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="image/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 30px;

		}

		
.titulo{
	font-size:22px;
}

.texto-contrato{
	font-size:12px;
	text-align: center;
}

	</style>


</head>
<body>	


<p class="titulo">CONTRATO DE COMPRA E VENDA DE IMÓVEL</p>
<div style="border-bottom: solid 1px #0340a3"></div>
<br>
<p class="texto-contrato">


Que entre si fazem, de um lado, <b><?php echo mb_strtoupper($nome_vendedor) ?></b>, <?php echo $nacionalidade_vendedor ?> <?php echo $estado_civil_vendedor ?>, <?php echo $tipo_doc_vendedor ?> <b><?php echo $cpf_vendedor ?> </b>, residente no endereço <?php echo $endereco_vendedor ?>, doravante denominado simplesmente <b>VENDEDOR</b>, e de outro lado, <b><?php echo mb_strtoupper($nome_comprador) ?></b>, <?php echo $nacionalidade_comprador ?><?php echo $estado_civil_comprador ?>, <?php echo $tipo_doc_comprador ?> <b><?php echo $cpf_comprador ?></b>, residente no endereço <?php echo $endereco_comprador ?>, doravante denominado simplesmente <b>COMPRADOR</b>, têm entre si como justo e contratado o que segue, que se obrigam a cumprir por si, seus herdeiros e sucessores.
<br><br>





<b>1.  </b>             O VENDEDOR, na qualidade de legítimo proprietário de do imóvel localizado <?php echo $endereco ?> Bairro <?php echo $nome_bairro ?> Cidade <?php echo $nome_cidade ?>, resolve vendê-lo ao COMPRADOR, pelo valor de R$ <?php echo $valorF ?>, que deverá ser pago ao Vendedor através de transferência bancária nesta conta <?php echo $banco_vendedor ?>, Conta <?php echo $tipo_conta_vendedor ?>, Agência <?php echo $agencia_vendedor ?>, Conta <?php echo $conta_vendedor ?> nesta data <?php echo $data_pgtoF ?>, do qual o VENDEDOR dará plena quitação após a compensação ou cobrança respectiva.

<br><br>

<b>1.1</b>     -    O presente contrato obriga também os sucessores das partes.

<br><br>

<b>2.</b>                   A posse do(s) imóvel (is) será transferida ao COMPRADOR após a desocupação do (s) imóvel (is) e entrega definitiva das chaves, mas a transferência definitiva somente ocorrerá mediante o recebimento do valor total estipulado na cláusula anterior.

<br><br>

<b>2.1</b>     - Na hipótese de pagamento em cheques, a quitação das parcelas e do negócio estará condicionada a compensação ou cobrança bancária correspondente.

<br><br>

<b>3.</b>                   Em consequência ao acima pactuado, se o COMPRADOR não efetuar o pagamento das parcelas devidas, ou se os cheques não forem liquidados ou pagos, o presente instrumento considerar-se-á rescindido de pleno direito, ficando o COMPRADOR constituído em mora e obrigado a restituir imediatamente o(s) imóvel (is) adquiridos.

<br><br>

<b>3.1 </b>      - Na hipótese de ocorrência de mora, o VENDEDOR restituirá ao COMPRADOR a importância equivalente a 50% (cinquenta por cento) do sinal e das parcelas efetivamente pagas, corrigidos pelo IGP-M da FGV a partir do mês subsequente a cada pagamento e até o mês anterior ao de devolução, no prazo de 30 (trinta) dias após a restituição do (s) imóvel (is).
<br><br>

 
<b>4.</b>                   O VENDEDOR desocupará o (s) imóvel (is) na data máximo de ...../..../..... . Caso não o fizer, ficará sujeito a um aluguel diário de R$ ......., até a desocupação e entrega definitiva das chaves.

<br><br>

<b>4.1</b>     - Ao VENDEDOR caberá zelar pela conservação do (s) imóvel (is) até a data da desocupação e entrega definitiva das chaves, inclusive arcando com as despesas que para isso forem necessárias, defendendo-o da turbação ou esbulho de terceiros.
<br><br>

<b>4.2</b>     - Na hipótese de devolução do (s) imóvel (is) por ocorrência de mora, o VENDEDOR executará a vistoria do (s) bem (ns) devolvido (s), no ato do recebimento. Caso o(s) mesmo(s) não esteja(m) em perfeitas condições de uso e conservação, os reparos serão orçados no prazo de 5 (cinco) dias da data do recebimento, e deduzidos do reembolso estipulado na cláusula 3.1.
<br><br>

<b>4.3</b>     - As despesas com taxas, impostos e demais encargos sobre o (s) bem (ns) objeto da presente contratação são assumidos, a partir desta data, pelo COMPRADOR, exceto em relação ao período entre a data deste contrato e a desocupação do (s) imóvel (is) e entrega definitiva das chaves.
<br><br>

<b>4.4 </b>    - Caso o VENDEDOR venha a desocupar o (s) imóvel (is) antes do prazo máximo fixado, ao COMPRADOR será facultado receber ou não as chaves. Caso o faça, as parcelas faltantes para completar o preço total serão devidas no próprio ato, conforme pactuado na cláusula 1.
<br><br>

<b>5.</b>                   Ao COMPRADOR será facultado inspecionar periodicamente o (s) imóvel (is), em dias e horários previamente acordados, até a entrega definitiva das chaves.
<br><br>

<b>5.1</b>     - Obriga-se o VENDEDOR a contratar um seguro total sobre o (s) imóvel (is) vendido (s), com apólice a favor do COMPRADOR, na seguradora de sua preferência, mantendo-o segurado até a data da entrega final das chaves, sob pena de, não o fazendo, responder por todos os danos ocorridos a (os) bem (ns), ainda que oriundos de caso fortuito ou força maior.
<br><br>

<b>6. </b>            Em caso de mudança de endereço, o COMPRADOR deverá comunicar imediatamente tal fato ao VENDEDOR, por escrito.
<br><br>

<b>7.</b>     Integralizado o valor total do preço, e não havendo qualquer violação contratual, o COMPRADOR passará a ter a posse e a propriedade plenas do referido objeto, sem maior formalidade.
<br><br>

<b>7.1</b>     - O COMPRADOR efetivará o(s) registro (s) da(s) transferência (s) do (s) bem (ns) no (s) órgão (ãos) competentes no prazo máximo de 30 (trinta) dias após a quitação integral do preço, isentando o VENDEDOR de qualquer responsabilidade sobre eventuais consequências de sua omissão.
<br><br>

<b>8. </b>            As partes elegem o foro da Comarca desta cidade, para dirimir qualquer controvérsia decorrente deste contrato.

E por estarem assim justas e contratadas, assinam o presente em 2 (duas) vias de igual teor, juntamente com as testemunhas abaixo.
<br><br>


Belo Horizonte <?php echo $data_hoje ?>.
<br><br><br> 

Vendedor: _______________________________________________.<br>   
<b>NOME DO PROPRIETÁRIO</b>
<br> <br> 
    
Comprador  ______________________________________________.  <br>   
<b>NOME DO COMPRADOR</b>
<br> <br> 

Testemunhas:______________________________________________.<br> 
<br> <br> 

Testemunhas:______________________________________________.<br> 
<br> <br> 

       

 </p>
       



</body>
</html>