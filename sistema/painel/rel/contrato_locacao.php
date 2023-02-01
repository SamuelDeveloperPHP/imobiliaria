<?php 
require_once("../../conexao.php");
$id = $_GET['id'];

$query = $pdo->query("SELECT * from alugueis where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$valor = $res[0]['valor_total'];
	$vendedor = $res[0]['proprietario'];
	$comprador = $res[0]['inquilino'];
	$comissao_corretor = $res[0]['comissao_corretor'];
	$comissao_imob = $res[0]['comissao_imob'];
	$corretor = $res[0]['corretor'];
	$data = $res[0]['data'];
	$data_pgto = $res[0]['data_pgto'];
	$obs = $res[0]['obs'];
	$data_inicio = $res[0]['data_inicio'];
	$data_final = $res[0]['data_final'];
	$usuario = $res[0]['usuario'];
	$imovel = $res[0]['imovel'];


	//GERAR AS CONTA A RECEBER DE CADA MÊS DE ALUGUÉL
$data_ini  = $data_inicio;
$data_end  = $data_final; 
$dif = strtotime($data_end) - strtotime($data_ini); 
$qtd_parcelas = floor($dif / (60 * 60 * 24 * 30));

$data_pgto_separada = explode("-", $data_pgto);
$dia_pgto = $data_pgto_separada[2];


	//retirar quebra de texto do obs		
		$dataF = implode('/', array_reverse(explode('-', $data)));
		$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
		$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
		$data_finalF = implode('/', array_reverse(explode('-', $data_final)));

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
		

		$query2 = $pdo->query("SELECT * FROM locatarios where id = '$comprador'");
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
	<title>Contrato de Locação</title>

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


<p class="titulo">CONTRATO DE LOCAÇÃO</p>
<div style="border-bottom: solid 1px #0340a3"></div>
<br>
<p class="texto-contrato">


Que entre si fazem, de um lado, <b><?php echo mb_strtoupper($nome_comprador) ?></b>, <?php echo $nacionalidade_comprador ?> <?php echo $estado_civil_comprador ?>, <?php echo $tipo_doc_comprador ?> <b><?php echo $cpf_comprador ?></b>, doravante denominado simplesmente <b>LOCATÁRIO</b>, nesta capital, residente a <?php echo $endereco_comprador ?> e de outro lado, <b><?php echo mb_strtoupper($nome_vendedor) ?></b>, <?php echo $nacionalidade_vendedor ?><?php echo $estado_civil_vendedor ?>, <?php echo $tipo_doc_vendedor ?> <b><?php echo $cpf_vendedor ?></b>, doravante denominado simplesmente <b>LOCADOR</b>, mediante as cláusulas e condições reciprocamente estipuladas e aceitas, a seguir:
<br><br>

<b>CLÁUSULA PRIMEIRA-</b> O objeto deste contrato é a locação do imóvel de propriedade do locador, constituído pelo apartamento <?php echo $endereco ?> Bairro <?php echo $nome_bairro ?> <?php echo $nome_cidade ?> MG.
<br><br>

<b>CLÁUSULA SEGUNDA-</b> A presente locação é contratada pelo prazo de <?php echo $qtd_parcelas ?> meses, com início em <?php echo $data_inicioF ?> e término em <?php echo $data_finalF ?>. podendo ser renovado se assim acordado entre ambas as partes; caso haja quebra de contrato por alguma das partes será aplicada uma multa no valor de 15% encima de cada parcela restante.
<br><br>

<b>CLÁUSULA TERCEIRA-</b> O Aluguel mensal é de <b>R$ <?php echo $valorF ?></b>, vencível todo dia <?php echo $dia_pgto ?> de cada mês.
<br><br>

<b><i>Parágrafo Primeiro-</i></b> Após o vencimento do aluguel mensal, o locatário terá um prazo máximo de 02 (dois) dias para efetuar o pagamento sem multas, após estes dois dias será cobrado multa de 10% sobre o valor do aluguel + juros de 1% por dia de atraso.                                                
<br><br>

<b><i>Parágrafo Segundo-</i></b> O aluguel sofrerá reajuste do IGPM , conforme índice nacional, sendo possível a negociação entre as partes. 
 <br><br>                                      
<b><i>Parágrafo Terceiro-</i></b> Não será exigido aluguéis adiantados, o locatário irá efetuar o pagamento do primeiro aluguel no dia em que receber as chaves.                <br><br>                                                                                                      
<b><i>Parágrafo Quarto-</i></b>  O Locatário e o Locador, deverão avisar previamente sobre a rescisão do contrato em conformidade com a lei vigente do inquilinato, e,  caso haja a rescisão antes do prazo acordado neste instrumento por uma das partes, a parte que rescindir pagará multa conforme definido neste presente instrumento. 
<br><br>   

<b><i>Parágrafo Quinto-</i></b> O não pagamento das obrigações contratuais no vencimento acarretará o pagamento de multa de 15% das obrigações em atraso, além de juros de mora em 1% ao mês quando o atraso for superior a vinte e nove dias e correção monetária.

<br><br>   
<b><i>Parágrafo Sexto-</i></b> O pagamento referente ao condomínio mensal é de total responsabilidade do Locatário, assim como o pagamento de despesas com água e luz, ficando isento apenas do IPTU e as despesas extraordinárias inerentes do condomínio.

<br><br>   
                                                                                         
<b>CLÁUSULA QUARTA- </b>O locatário, salvo as obras que importem na segurança do imóvel; obriga-se, a devolver o imóvel locado em perfeitas condições, seus pertences, higiene e limpeza.

<br><br>   

<b>CLÁUSULA QUINTA -</b> Não é permitido os locatários introduzir benfeitorias no imóvel, sem prévia e expresso consentimento do locador. A transgressão acarretara a rescisão de pleno direito do presente contrato cumulativamente com as sanções ajustadas, além da demolição da obra as exclusivas do locatário. 
<br><br>   

 <b>CLÁUSULA  SEXTA - </b>Obriga-se o Locatário a satisfazer todas as exigências dos poderes públicos a que der causa e a não fazer modificações ou transformações no imóvel sem autorização por escrita do Locador. 

<br><br>   

 <b>CLÁUSULA SÉTIMA -</b> E ressalvo ao locatário exigir, a qualquer tempo, diferenças oriundas de reajustes do aluguel que, por qualquer motivo, não tenham sido exigidas oportunamente, sendo esta faculdade extensiva aos tributos, taxas, tarifas, e demais encargos locatícios.                                           
 <br><br>   

<b>CLÁUSULA OITAVA -</b> O Locatário desde já, faculta ao Locador examinar ou vistoriar o imóvel locado, quando este desejar, mediante combinação prévia de dia e hora.

<br><br>   
<b>CLÁUSULA NONA -</b> Compete ao locatário tomar todas as providências e pagamentos junto a COPASA e a CEMIG, no que concernem as ligações de água e energia elétrica, respectivas contas mensais bem como providenciar leitura e consumo final por ocasião de entregas das chaves e devolução do imóvel. 

<br><br>   
<b>CLÁUSULA DÉCIMA -</b> No caso de desapropriação de imóvel locado ficará o locador desobrigado por todas as cláusulas do presente pacto, ressalvo ao locatário tão somente a faculdade de haver, do poder desapropriante, a indenização a que porventura tiver direito.   

<br><br>                                                                             
<b>CLÁUSULA DÉCIMA PRIMEIRA-</b>  Intimação do serviço público, ou Judiciário, poderá ser  motivo, mediante analise do fato pelas partes, para o Locatário do imóvel,  pedir rescisão contratual, sem que haja quaisquer sanções de rescisão contratual.

<br><br>   

<b>CLÁUSULA DÉCIMA SEGUNDA-</b> Para todas as questões resultantes deste contrato, fica eleito o foro da comarca de Belo Horizonte - MG, renunciando as partes a qualquer outro, por mais privilegiado que seja. 

<br><br>   
<b>CLÁUSULA DÉCIMA TERCEIRA-</b> Tudo quanto for devido em razão do presente contrato e que não comporte o processo executivo será cobrado em ação competente, ficando a cargo do devedor, em qualquer caso, os honorários do advogado que o credor constituir para ressalva dos seus direitos. 

<br><br>                            
<b>CLÁUSULA DÉCIMA QUARTA-</b> Para o caso de inobservância ou infração de qualquer das cláusulas do presente contrato, fica estipulado multa de dois aluguéis, correspondentes aos aluguéis para a parte infratora  da época em que se der a infração.  

<br><br>   
<b>CLÁUSULA DÉCIMA QUINTA-</b> O locatário recebe o imóvel em perfeito estado de conservação, obrigando-se pela sua perfeita manutenção, trazendo-o sempre em bom estado de higiene e limpeza, responsabilizando  pela reparação de qualquer dano ou estrago causado por  culpa ou dolo,   de si mesmo, de seus dependentes, visitantes e empregados. 

<br><br>   
<b><i>Parágrafo Único-</i></b> Ao locatário, fica obrigado restituir o objeto deste presente contrato, nas mesmas condições que lhe fora entregue, conforme anexo de vistoria assinado e anexado junto a este presente instrumento, quando finda ou rescinda a presente locação por vontade ou culpa do locatário.                                                                                                    <br><br>                                               
<b>CLÁUSULA DÉCIMA SEXTA- </b>As chaves do imóvel serão entregues ao Locatário somente após a devida formalização do presente contrato locatício e do relatório de vistoria, compreendendo nisto as assinaturas das partes.                                                                                                           <br><br>                                
<b>CLÁUSULA DÉCIMA SÉTIMA- </b>Fica pactuado que qualquer citação, intimação ou notificação em virtude das relações ajustadas neste contrato, far-se à mediante correspondência com aviso de recebimento, consoante o dispositivo pela lei 8245, art.58,inciso IV.

<br><br>   
<b>CLÁUSULA DÉCIMA OITAVA-</b> Finda rescindida a presente locação, a entrega do imóvel farse-á mediante comunicação ao locador, que procederá a vistoria a fim de verificar se o mesmo se encontra nas condições prevista nas cláusulas deste contrato de locação; se necessário realizar obras para reparos de danos, a locação só será encerrada após a constatação por nova vistoria por parte do locador.  

<br><br>   
                         <b><i>Parágrafo Primeiro-</i></b> Da devolução, os locatários deverão notificar ao locador sua intenção com antecedência, mínima de trinta dias; deverá entregar quitação de todos os débitos existentes no imóvel locado.                                                           <br><br>                                                                                                        <b><i>Parágrafo Segundo-</i></b> Os locatários ficam impedido de sub-locar o imóvel para quem quer que seja, independente de grau parentesco.   

                         <br><br>   
   <b>CLÁUSULA DÉCIMA NONA-</b> O pagamento dos aluguéis deverão ser efetuados diretamente na conta do locador ou entregue em espécie perante recibo do pagamento.     

   <br><br>                                                                                                                        
<b>VIGÉSIMA-</b> E por estarem justos e contratados, assinam em duas vias, de igual teor e forma, na presença das testemunhas e a seguir dão cumprimento ás exigências e formalidades legais.

<br><br><br>   

Belo Horizonte <?php echo $data_hoje ?>.
<br><br><br> 

Locador: _______________________________________________.<br>   
<b>NOME DO PROPRIETÁRIO</b>
<br> <br> 
    
Locatário  ______________________________________________.  <br>   
<b>NOME DO INQUILINO</b>
<br> <br> 

Testemunhas:______________________________________________.<br> 
<br> <br> 

Testemunhas:______________________________________________.<br> 
<br> <br> 

       

 </p>
       



</body>
</html>