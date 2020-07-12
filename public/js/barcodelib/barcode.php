<?php  
	require_once('php-barcode-generator/generate-verified-files.php');

	if(isset($_POST['barcode'])&&empty($_POST['name'])&&empty($_POST['sellPrice']))
	{
		//$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
		//$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
		//$generatorJPG = new Picqer\Barcode\BarcodeGeneratorJPG();
		//$generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
		$converter= new Picqer\Barcode\BarcodeGeneratorSVG();
		echo "<span>";
			echo "<div align='center' style='text-align:center;'>".
					$converter->getBarcode($_POST['barcode'],$converter::TYPE_CODE_128)."<br>"
					.$_POST['barcode'].
					"</div>";
		echo "</span>";
		
	}
	else
	{
		//$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
		//$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
		//$generatorJPG = new Picqer\Barcode\BarcodeGeneratorJPG();
		//$generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
		$converter= new Picqer\Barcode\BarcodeGeneratorSVG();
		echo "<span>";
			echo "<div style='text-align:center;'>".
					$converter->getBarcode($_POST['Barcode'],$converter::TYPE_CODE_128)."<br>".
					$_POST['Barcode']."<br>".
					$_POST['name']."<br>".
					"ج.م".$_POST['sellPrice'].
					"</div>";
		echo "</span>";
		
	}
?>