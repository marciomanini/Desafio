<?php
session_start();
include_once("util/conexao.php");
include("PaginadeRotulacao.php");

//Fun��o para formatar valor para uma casa depois do ponto
function formatarValor($valor){
	return number_format(floatval($valor), 1, ".", ".");
}

//Incluindo a classe PHPExcel
include 'phpexcel/Classes/PHPExcel.php';

//Instanciando a classe PHPExcel
$objPHPExcel = new PHPExcel();

//Definindo as propriedades do documento
$objPHPExcel->getProperties()->setCreator("Marcio Manini")
			->setDescription(utf8_encode("Arquivo contendo a exporta��o dos modelos de carros e suas compara��es"));

//Definindo o t�tulo da planilha 
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Listagem de Modelos');

// Alterando o tamanho da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(25);
$objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getFont()->setSize(20);

//Inserindo cabe�alho nas c�lulas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A1", "Listagem de Modelos")
            ->setCellValue("A2", "Marca")
            ->setCellValue("B2", "Modelo")
            ->setCellValue("C2", "Motor")
            ->setCellValue("D2", "Ano");

//Centralizando o texto entre as colunas A a D
$objPHPExcel->getActiveSheet()->getStyle('A:D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//Definindo o estilo da fonte para o t�tulo em A1
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

//Fazendo Merge das 4 primeiras c�lulas para o t�tulo
$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');

$resultado = mysql_query("SELECT id_marca, modelo, motor, ano_fabricacao FROM carros");

$coluna = 0;
$linha = 3;
while($linhas = mysql_fetch_assoc($resultado)){
	$coluna = 0;
	foreach($linhas as $key => $valor){
		if($key == "motor")
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, number_format(floatval($valor), 1, ".", "."));
			//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, formatarValor($valor));
		else
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, utf8_encode($valor));
		
		$coluna++;
	}
	$linha++;
}

//Deixando as colunas com a largura auto-ajustada
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

/* ****************************************************** NOVA PLANILHA ****************************************************** */

//Criando uma nova planilha dentro do arquivo
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);

//Definindo o t�tulo da planilha
$objPHPExcel->getActiveSheet()->setTitle(utf8_encode('Compara��o de Modelos'));

// Alterando o tamanho da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(25);
$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setSize(15);

//Inserindo cabe�alho nas c�lulas da segunda planilha
$objPHPExcel->setActiveSheetIndex(1)
			->setCellValue("A1", utf8_encode("Compara��o de Modelos"))
			->setCellValue("A2", "Modelo")
			->setCellValue("A3", utf8_encode("Pre�o"))
			->setCellValue("A4", "Cavalos (HP)")
			->setCellValue("A5", "Consumo Etanol (Km/L)")
			->setCellValue("A6", "Consumo Gasolina (Km/L)")
			->setCellValue("A7", utf8_encode("Valor m�dio revis�es"))
			->setCellValue("A8", utf8_encode("Valor m�dio seguro"))
			->setCellValue("A9", utf8_encode("PONTUA��O FINAL"));

//Centralizando o texto entre as colunas A a C
$objPHPExcel->getActiveSheet()->getStyle('A:C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//Definindo o estilo da fonte para o t�tulo em A1 e A9 a C9
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A9:C9')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);

//Fazendo Merge das 4 primeiras c�lulas para o t�tulo
$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');

/* Cabe�alho */
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 2,  utf8_encode($linhasEsq['id_marca']. " ". $linhasEsq['modelo']. " ". number_format($linhasEsq['motor'], 1, ".", "."). " ". $linhasEsq['ano_fabricacao']));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 2,  utf8_encode($linhasDir['id_marca']. " ". $linhasDir['modelo']. " ". number_format($linhasDir['motor'], 1, ".", "."). " ". $linhasDir['ano_fabricacao']));

/* ******************************************************************************************
Para todos os par�metros de compara��o
Ser� alterada a cor do texto nas c�lulas que v�o receber o resultado
E inseridas as informa��es contidas no documento PaginadeRotulacao.php (coluna, linha, valor)
****************************************************************************************** */
/* Pre�o */
$objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($corPrecoEsq);
$objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($corPrecoDir);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, $linhaPrecoEsq);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 3, $linhaPrecoDir);

/* HP */
$objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($corHPEsq);
$objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($corHPDir);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 4, $linhaHPEsq);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 4, $linhaHPDir);

/* Consumo de Etanol */
$objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($corConsEtanolEsq);
$objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($corConsEtanolDir);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, $linhaConsEtanolEsq);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 5, $linhaConsEtanolDir);

/* Consumo de Gasolina */
$objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($corConsGasolinaEsq);
$objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($corConsGasolinaDir);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, $linhaConsGasolinaEsq);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 6, $linhaConsGasolinaDir);

/* Valor das Revis�es */
$objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($corValorRevisoesEsq);
$objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($corValorRevisoesDir);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 7, $linhaValorRevisoesEsq);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 7, $linhaValorRevisoesDir);

/* Valor do Seguro */
$objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($corValorSeguroEsq);
$objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($corValorSeguroDir);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 8, $linhaValorSeguroEsq);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 8, $linhaValorSeguroDir);

/* Pontua��o Final */
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 9, $pontEsq);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 9, $pontDir);

//Deixando as colunas com a largura auto-ajustada
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

//Volta para a primeira planilha para apresenta��o
$objPHPExcel->setActiveSheetIndex(0);

//Cabe�alho do arquivo
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header('Content-Disposition: attachment;filename="Exporta��o.xls"');
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//Caso seja IE9
header('Cache-Control: max-age=1');

//Caso exista, descarta o conte�do do buffer de sa�da
ob_clean();

//Salva  o arquivo 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//Salva diretamente no output
$objWriter->save('php://output');

exit;
?>