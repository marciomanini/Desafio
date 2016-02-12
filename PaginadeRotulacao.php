<?php
include_once("util/conexao.php");

$idEsq = $_GET['idEsq'];
$resultadoEsq = mysql_query("SELECT * FROM carros WHERE id = ". $idEsq);
$linhasEsq = mysql_fetch_assoc($resultadoEsq);

$idDir = $_GET['idDir'];
$resultadoDir = mysql_query("SELECT * FROM carros WHERE id = ". $idDir);
$linhasDir = mysql_fetch_assoc($resultadoDir);

//Variável responsável por verificar se a saída será por tela ou por arquivo
$destino = $_GET['destino'];

/* Variáveis de Pontuação */
$pontEsq = 0;
$pontDir = 0;

/* Comparação do Preço */
$linhaPrecoEsq;
$linhaPrecoDir;
$corPrecoEsq;
$corPrecoDir;
switch($destino){
	case "tela":
		if($linhasEsq['preco'] < $linhasDir['preco']){
			$linhaPrecoEsq = "<td class='mais-atrativo'> R$ ". number_format($linhasEsq['preco'], 2, ",", "."). "</td>";
			$linhaPrecoDir = "<td class='menos-atrativo'> R$ ". number_format($linhasDir['preco'], 2, ",", "."). "</td>";
			$pontEsq++;
		}else{
			$linhaPrecoEsq = "<td class='menos-atrativo'> R$ ". number_format($linhasEsq['preco'], 2, ",", "."). "</td>";
			$linhaPrecoDir = "<td class='mais-atrativo'> R$ ". number_format($linhasDir['preco'], 2, ",", "."). "</td>";
			$pontDir++;
		}
	break;
	case "arquivo":
		if($linhasEsq['preco'] < $linhasDir['preco']){
			$corPrecoEsq = array('font' => array('color' => array('rgb' => '008000')));
			$corPrecoDir = array('font' => array('color' => array('rgb' => 'FF0000')));
			$pontEsq++;
		}else{
			$corPrecoEsq = array('font' => array('color' => array('rgb' => 'FF0000')));
			$corPrecoDir = array('font' => array('color' => array('rgb' => '008000')));
			$pontDir++;
		}
		$linhaPrecoEsq = "R$ ". number_format($linhasEsq['preco'], 2, ",", ".");
		$linhaPrecoDir = "R$ ". number_format($linhasDir['preco'], 2, ",", ".");
}


/* Comparação do HP */
$linhaHPEsq;
$linhaHPDir;
$corHPEsq;
$corHPDir;
switch($destino){
	case "tela":
		if($linhasEsq['hp'] > $linhasDir['hp']){
			$linhaHPEsq = "<td class='mais-atrativo'>". $linhasEsq['hp']. "</td>";
			$linhaHPDir = "<td class='menos-atrativo'>". $linhasDir['hp']. "</td>";
			$pontEsq++;
		}else{
			$linhaHPEsq = "<td class='menos-atrativo'>". $linhasEsq['hp']. "</td>";
			$linhaHPDir = "<td class='mais-atrativo'>". $linhasDir['hp']. "</td>";
			$pontDir++;
		}
	break;
	case "arquivo":
		if($linhasEsq['hp'] > $linhasDir['hp']){
			$corHPEsq = array('font' => array('color' => array('rgb' => '008000')));
			$corHPDir = array('font' => array('color' => array('rgb' => 'FF0000')));
			$pontEsq++;
		}else{
			$corHPEsq = array('font' => array('color' => array('rgb' => 'FF0000')));
			$corHPDir = array('font' => array('color' => array('rgb' => '008000')));
			$pontDir++;
		}
		$linhaHPEsq = $linhasEsq['hp'];
		$linhaHPDir = $linhasDir['hp'];
}

/* Comparação do Consumo Etanol */
$linhaConsEtanolEsq;
$linhaConsEtanolDir;
$corConsEtanolEsq;
$corConsEtanolDir;
switch($destino){
	case "tela":
		if($linhasEsq['cons_etanol'] > $linhasDir['cons_etanol']){
			$linhaConsEtanolEsq = "<td class='mais-atrativo'>". number_format($linhasEsq['cons_etanol'], 1, ",", "."). "</td>";
			$linhaConsEtanolDir = "<td class='menos-atrativo'>". number_format($linhasDir['cons_etanol'], 1, ",", "."). "</td>";
			$pontEsq++;
		}else{
			$linhaConsEtanolEsq = "<td class='menos-atrativo'>". number_format($linhasEsq['cons_etanol'], 1, ",", "."). "</td>";
			$linhaConsEtanolDir = "<td class='mais-atrativo'>". number_format($linhasDir['cons_etanol'], 1, ",", "."). "</td>";
			$pontDir++;
		}
		
		//Para o caso do carro ser apenas a gasolina, a pontuação continua por se tratar de uma vantagem em relação ao outro modelo
		if($linhasEsq['cons_etanol'] == 0 || $linhasDir['cons_etanol'] == 0){
			$linhaConsEtanolEsq = ($linhasEsq['cons_etanol'] == 0) ? "<td>-</td>" : "<td>". number_format($linhasEsq['cons_etanol'], 1, ",", "."). "</td>";
			$linhaConsEtanolDir = ($linhasDir['cons_etanol'] == 0) ? "<td>-</td>" : "<td>". number_format($linhasDir['cons_etanol'], 1, ",", "."). "</td>";
		}
		break;
	case "arquivo":
		if($linhasEsq['cons_etanol'] > $linhasDir['cons_etanol']){
			$corConsEtanolEsq = array('font' => array('color' => array('rgb' => '008000')));
			$corConsEtanolDir = array('font' => array('color' => array('rgb' => 'FF0000')));
			$pontEsq++;
		}else{
			$corConsEtanolEsq = array('font' => array('color' => array('rgb' => 'FF0000')));
			$corConsEtanolDir = array('font' => array('color' => array('rgb' => '008000')));
			$pontDir++;
		}
		$linhaConsEtanolEsq = $linhasEsq['cons_etanol'];
		$linhaConsEtanolDir = $linhasDir['cons_etanol'];
		
		//Para o caso do carro ser apenas a gasolina, a pontuação continua por se tratar de uma vantagem em relação ao outro modelo
		if($linhasEsq['cons_etanol'] == 0 || $linhasDir['cons_etanol'] == 0){
			$corConsEtanolEsq = array('font' => array('color' => array('rgb' => '000000')));
			$corConsEtanolDir = array('font' => array('color' => array('rgb' => '000000')));
			$linhaConsEtanolEsq = ($linhasEsq['cons_etanol'] == 0) ? "-" : $linhasEsq['cons_etanol'];
			$linhaConsEtanolDir = ($linhasDir['cons_etanol'] == 0) ? "-" : $linhasDir['cons_etanol'];
		}
}

/* Comparação do Consumo Gasolina */
$linhaConsGasolinaEsq;
$linhaConsGasolinaDir;
$corConsGasolinaEsq;
$corConsGasolinaDir;
switch($destino){
	case "tela":
		if($linhasEsq['cons_gasolina'] > $linhasDir['cons_gasolina']){
			$linhaConsGasolinaEsq = "<td class='mais-atrativo'>". number_format($linhasEsq['cons_gasolina'], 1, ",", "."). "</td>";
			$linhaConsGasolinaDir = "<td class='menos-atrativo'>". number_format($linhasDir['cons_gasolina'], 1, ",", "."). "</td>";
			$pontEsq++;
		}else{
			$linhaConsGasolinaEsq = "<td class='menos-atrativo'>". number_format($linhasEsq['cons_gasolina'], 1, ",", "."). "</td>";
			$linhaConsGasolinaDir = "<td class='mais-atrativo'>". number_format($linhasDir['cons_gasolina'], 1, ",", "."). "</td>";
			$pontDir++;
		}
		
		//Para o caso do carro ser apenas a etanol, a pontuação continua por se tratar de uma vantagem em relação ao outro modelo
		if($linhasEsq['cons_gasolina'] == 0 || $linhasDir['cons_gasolina'] == 0){
			$linhaConsGasolinaEsq = ($linhasEsq['cons_gasolina'] == 0) ? "<td>-</td>" : "<td>". number_format($linhasEsq['cons_gasolina'], 1, ",", "."). "</td>";
			$linhaConsGasolinaDir = ($linhasDir['cons_gasolina'] == 0) ? "<td>-</td>" : "<td>". number_format($linhasDir['cons_gasolina'], 1, ",", "."). "</td>";
		}
	break;
	case "arquivo":
		if($linhasEsq['cons_gasolina'] > $linhasDir['cons_gasolina']){
			$corConsGasolinaEsq = array('font' => array('color' => array('rgb' => '008000')));
			$corConsGasolinaDir = array('font' => array('color' => array('rgb' => 'FF0000')));
			$pontEsq++;
		}else{
			$corConsGasolinaEsq = array('font' => array('color' => array('rgb' => 'FF0000')));
			$corConsGasolinaDir = array('font' => array('color' => array('rgb' => '008000')));
			$pontDir++;
		}
		$linhaConsGasolinaEsq = $linhasEsq['cons_gasolina'];
		$linhaConsGasolinaDir = $linhasDir['cons_gasolina'];
		
		//Para o caso do carro ser apenas a etanol, a pontuação continua por se tratar de uma vantagem em relação ao outro modelo
		if($linhasEsq['cons_gasolina'] == 0 || $linhasDir['cons_gasolina'] == 0){
			$corConsGasolinaEsq = array('font' => array('color' => array('rgb' => '000000')));
			$corConsGasolinaDir = array('font' => array('color' => array('rgb' => '000000')));
			$linhaConsGasolinaEsq = ($linhasEsq['cons_gasolina'] == 0) ? "-" : $linhasEsq['cons_gasolina'];
			$linhaConsGasolinaDir = ($linhasDir['cons_gasolina'] == 0) ? "-" : $linhasDir['cons_gasolina'];
		}
}
/* Comparação do Valor Revisões */
$linhaValorRevisoesEsq;
$linhaValorRevisoesDir;
$corValorRevisoesEsq;
$corValorRevisoesDir;
switch($destino){
	case "tela":
		if($linhasEsq['valor_revisoes'] < $linhasDir['valor_revisoes']){
			$linhaValorRevisoesEsq = "<td class='mais-atrativo'> R$ ". number_format($linhasEsq['valor_revisoes'], 2, ",", "."). "</td>";
			$linhaValorRevisoesDir = "<td class='menos-atrativo'> R$ ". number_format($linhasDir['valor_revisoes'], 2, ",", "."). "</td>";
			$pontEsq++;
		}else{
			$linhaValorRevisoesEsq = "<td class='menos-atrativo'> R$ ". number_format($linhasEsq['valor_revisoes'], 2, ",", "."). "</td>";
			$linhaValorRevisoesDir = "<td class='mais-atrativo'> R$ ". number_format($linhasDir['valor_revisoes'], 2, ",", "."). "</td>";
			$pontDir++;
		}
	break;
	case "arquivo":
		if($linhasEsq['valor_revisoes'] < $linhasDir['valor_revisoes']){
			$corValorRevisoesEsq = array('font' => array('color' => array('rgb' => '008000')));
			$corValorRevisoesDir = array('font' => array('color' => array('rgb' => 'FF0000')));
			$pontEsq++;
		}else{
			$corValorRevisoesEsq = array('font' => array('color' => array('rgb' => 'FF0000')));
			$corValorRevisoesDir = array('font' => array('color' => array('rgb' => '008000')));
			$pontDir++;
		}
		$linhaValorRevisoesEsq = "R$ ". number_format($linhasEsq['valor_revisoes'], 2, ",", ".");
		$linhaValorRevisoesDir = "R$ ". number_format($linhasDir['valor_revisoes'], 2, ",", ".");
}

/* Comparação do Valor Seguro */
$linhaValorSeguroEsq;
$linhaValorSeguroDir;
$corValorSeguroEsq;
$corValorSeguroDir;
switch($destino){
	case "tela":
		if($linhasEsq['valor_seguro'] < $linhasDir['valor_seguro']){
			$linhaValorSeguroEsq = "<td class='mais-atrativo'> R$ ". number_format($linhasEsq['valor_seguro'], 2, ",", "."). "</td>";
			$linhaValorSeguroDir = "<td class='menos-atrativo'> R$ ". number_format($linhasDir['valor_seguro'], 2, ",", "."). "</td>";
			$pontEsq++;
		}else{
			$linhaValorSeguroEsq = "<td class='menos-atrativo'> R$ ". number_format($linhasEsq['valor_seguro'], 2, ",", "."). "</td>";
			$linhaValorSeguroDir = "<td class='mais-atrativo'> R$ ". number_format($linhasDir['valor_seguro'], 2, ",", "."). "</td>";
			$pontDir++;
		}
	break;
	case "arquivo":
		if($linhasEsq['valor_seguro'] < $linhasDir['valor_seguro']){
			$corValorSeguroEsq = array('font' => array('color' => array('rgb' => '008000')));
			$corValorSeguroDir = array('font' => array('color' => array('rgb' => 'FF0000')));
			$pontEsq++;
		}else{
			$corValorSeguroEsq = array('font' => array('color' => array('rgb' => 'FF0000')));
			$corValorSeguroDir = array('font' => array('color' => array('rgb' => '008000')));
			$pontDir++;
		}
		$linhaValorSeguroEsq = "R$ ". number_format($linhasEsq['valor_seguro'], 2, ",", ".");
		$linhaValorSeguroDir = "R$ ". number_format($linhasDir['valor_seguro'], 2, ",", ".");
}
?>