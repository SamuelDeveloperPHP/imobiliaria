<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];

echo <<<HTML
<small>
HTML;


$query = $pdo->query("SELECT * FROM vistorias ORDER BY id desc");

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th class="esconder">id</td>
	<th>Imóvel</th>
	<th class="esc">Gerado Por</th> 
	<th class="esc">Corretor</th>
	<th class="esc">Data</th> 	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$imovel = $res[$i]['imovel'];
		$texto = $res[$i]['texto'];
		$usuario = $res[$i]['usuario'];
		$data = $res[$i]['data'];	

		
//retirar aspas do texto do obs
		
		$dataF = implode('/', array_reverse(explode('-', $data)));
		

		$query2 = $pdo->query("SELECT * FROM imoveis where id = '$imovel'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$titulo = $res2[0]['titulo'];
			$img_principal = $res2[0]['img_principal'];	
			$corretor = $res2[0]['corretor'];			
		}

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_usuario = $res2[0]['nome'];			
		}

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_corretor = $res2[0]['nome'];			
		}

		$tituloF = mb_strimwidth($titulo, 0, 40, "...");

		//retirar aspas do texto do obs
		$texto_vistoria = str_replace('"', "**", $texto);

		echo <<<HTML
		<tr> 
		<td class="esconder">{$imovel}</td>
		<td>
		<img src="images/imoveis/{$img_principal}" width="27px" class="mr-2">
		{$tituloF}
		</td> 
		<td class="esc">{$nome_usuario}</td>
		<td class="esc">{$nome_corretor}</td>
		<td class="esc">{$dataF}</td>
		
		
		<td>
		
		<a href="#" onclick="arquivo('{$id}', '{$titulo}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a>		

		<a href="#" onclick="vistoria('{$imovel}', '{$titulo}', '{$texto_vistoria}')" title="Laudo de Vistoria"><i class="fa fa-file-pdf-o " style="color:red; margin-left:3px"></i></a>


		</td>  
		</tr> 
		HTML;
	}
	echo <<<HTML
	</tbody> 
	<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	</small>
	HTML;
}else{
	echo 'Não possui nenhum imóvel para Locação!';
}

?>




<script type="text/javascript">


	$(document).ready( function () {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true,
		});
		$('#tabela_filter label input').focus();
	} );



	
function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


function vistoria(id, nome, texto){

	for (let letra of texto){  				
			if (letra === '*'){
				texto = texto.replace('**', '"');
			}			
		}
		
    $('#id-vistoria').val(id);        
    $('#nome-vistoria').text(nome);
    nicEditors.findEditor("area").setContent(texto);	
    $('#modalVistoria').modal('show');
    $('#mensagem-vistoria').text(''); 
    
}

</script>



