<?php 
require_once("../../conexao.php");

$id = $_POST['id-vistoria'];
$area = urlencode($_POST['area']);
$texto = $_POST['area'];

@session_start();
$id_usuario = @$_SESSION['id_usuario'];

//SALVAR NA TABELA DE VISTORIA A ATUALIZAÇÃO DESTA VISTORIA
$query = $pdo->query("SELECT * from vistorias where imovel = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$query = $pdo->prepare("UPDATE vistorias SET texto = :texto, usuario = '$id_usuario', data = curDate() WHERE imovel = '$id'");
}else{
	$query = $pdo->prepare("INSERT INTO vistorias SET texto = :texto, imovel = '$id', usuario = '$id_usuario', data = curDate() ");	
}

$query->bindValue(":texto", "$texto");
$query->execute();

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."sistema/painel/rel/vistoria.php?id=$id&area=$area");

if($relatorio_pdf != 'pdf'){
	echo $html;
	exit();
}


//CARREGAR DOMPDF
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$pdf = new DOMPDF($options);



//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'vistoria.pdf',
array("Attachment" => false)
);

?>