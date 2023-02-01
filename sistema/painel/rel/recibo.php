<?php 
require_once("../../conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Recibo de Pagamento</title>

	<?php 
	if($relatorio_pdf != 'pdf'){
		?>
		<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="image/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

@page {
			margin: 5px;

		}

		body {
  padding: 10px;
}

* {
  box-sizing: border-box;
}

.receipt-main {  
  width: 100%;
  padding: 15px;
  font-size: 12px;
  border: 1px solid #000;
}

.receipt-title {
  text-align: center;
  text-transform: uppercase;
  font-size: 20px;
  font-weight: 600;
  margin: 0;
}
  
.receipt-label {
  font-weight: 600;
}

.text-large {
  font-size: 16px;
}

.receipt-section {
  margin-top: 10px;
}

.receipt-footer {
  text-align: center;
  background: #ff0000;
}

.receipt-signature {
  height: 80px;
  margin: 50px 0;
  padding: 0 50px;
  background: #fff;
  
  .receipt-line {
    margin-bottom: 10px;
    border-bottom: 1px solid #000;
  }
  
  p {
    text-align: center;
    margin: 0;
  }

  .direita{
  	position:absolute;
  	right:30px;
  }

  
}
					

	</style>


</head>
<body>	



<div class="receipt-main">
  
  <p class="receipt-title">Recibo de Pagamento</p>
  
  <div class="receipt-section pull-left">
    <span class="receipt-label text-large">Número:</span>
    <span class="text-large"><?php echo date('Y/m') ?></span>

    <span class="text-large receipt-label direita">VALOR R$ _________</span>
    
  </div>
  

  
  <div class="clearfix"></div>
  <br>
  
  <div class="receipt-section">
    <span><big>
      Recebemos de:   ___________________________________________________________________________________ <br><br>
     a quantia de:   ________________________________________________________________ na data ___/___/_______ <br><br>
    correspondente a   _________________________________________________________________________________. 
    
  </big></span>
        
  </div>
  
  <br><br>

  <div align="center">
    ______________________________________________________________________<br>
    (<b>ASSINATURA DO RESPONSÁVEL</b>)

  </div>
  <br>

   <div align="center">
    <?php echo mb_strtoupper($nome_sistema) ?> CNPJ <?php echo $cnpj_imob ?>

  </div>

</div>







<div class="receipt-main">
  
  <p class="receipt-title">Recibo de Pagamento</p>
  
  <div class="receipt-section pull-left">
    <span class="receipt-label text-large">Número:</span>
    <span class="text-large"><?php echo date('Y/m') ?></span>

    <span class="text-large receipt-label direita">VALOR R$ _________</span>
    
  </div>
  

  
  <div class="clearfix"></div>
  <br>
  
  <div class="receipt-section">
    <span><big>
      Recebemos de:   ___________________________________________________________________________________ <br><br>
     a quantia de:   ________________________________________________________________ na data ___/___/_______ <br><br>
    correspondente a   _________________________________________________________________________________.
    
  </big></span>
        
  </div>
  
  <br><br>

  <div align="center">
    ______________________________________________________________________<br>
    (<b>ASSINATURA DO RESPONSÁVEL</b>)

  </div>
  <br>

   <div align="center">
    <?php echo mb_strtoupper($nome_sistema) ?> CNPJ <?php echo $cnpj_imob ?>

  </div>

</div>





<div class="receipt-main">
  
  <p class="receipt-title">Recibo de Pagamento</p>
  
  <div class="receipt-section pull-left">
    <span class="receipt-label text-large">Número:</span>
    <span class="text-large"><?php echo date('Y/m') ?></span>

    <span class="text-large receipt-label direita">VALOR R$ _________</span>
    
  </div>
  

  
  <div class="clearfix"></div>
  <br>
  
  <div class="receipt-section">
    <span><big>
      Recebemos de:   ___________________________________________________________________________________ <br><br>
     a quantia de:   ________________________________________________________________ na data ___/___/_______ <br><br>
    correspondente a   _________________________________________________________________________________. 
    
  </big></span>
        
  </div>
  
  <br><br>

  <div align="center">
    ______________________________________________________________________<br>
    (<b>ASSINATURA DO RESPONSÁVEL</b>)

  </div>
  <br>

   <div align="center">
    <?php echo mb_strtoupper($nome_sistema) ?> CNPJ <?php echo $cnpj_imob ?>

  </div>

</div>



</body>
</html>