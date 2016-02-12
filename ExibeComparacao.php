<?php
include("PaginadeRotulacao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link rel="icon" href="imagens/eficiente.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
<div class="container theme-showcase">
	<div class="page-header">
		<h1>Comparação de modelos</h1>
	</div>
	  <table class="table table-bordered">
		<thead>
		<?php
		  echo "<tr>";
			echo "<th>Modelo</th>";
			echo "<th>". $linhasEsq['id_marca']. " ". $linhasEsq['modelo']. " ". number_format($linhasEsq['motor'], 1, ".", "."). " ". $linhasEsq['ano_fabricacao']. "</th>";
			echo "<th>". $linhasDir['id_marca']. " ". $linhasDir['modelo']. " ". number_format($linhasDir['motor'], 1, ".", "."). " ". $linhasDir['ano_fabricacao']. "</th>";
		  echo "</tr>";
		  ?>
		</thead>
		<tbody>
		<?php
		 echo "<tr>";
			echo "<td>Preço</td>";
			echo $linhaPrecoEsq;
			echo $linhaPrecoDir;
		 echo "</tr>";
		 echo "<tr>";
			echo "<td>Cavalos(HP)</td>";
			echo $linhaHPEsq;
			echo $linhaHPDir;
		 echo "</tr>";
		 echo "<tr>";
			echo "<td>Consumo Etanol (Km/L)</td>";
			echo $linhaConsEtanolEsq;
			echo $linhaConsEtanolDir;
		 echo "</tr>";
		 echo "<tr>";
			echo "<td>Consumo Gasolina (Km/L)</td>";
			echo $linhaConsGasolinaEsq;
			echo $linhaConsGasolinaDir;
		 echo "</tr>";
		 echo "<tr>";
			echo "<td>Valor médio revisões</td>";
			echo $linhaValorRevisoesEsq;
			echo $linhaValorRevisoesDir;
		 echo "</tr>";
		 echo "<tr>";
			echo "<td>Valor médio seguro</td>";
			echo $linhaValorSeguroEsq;
			echo $linhaValorSeguroDir;
		 echo "</tr>";
		?>
		</tbody>
		<tfoot class="resultado">
		  <tr>
			<td>PONTUAÇÃO FINAL</td>
			<td><?php echo $pontEsq; ?></td>
			<td><?php echo $pontDir; ?></td>
		  </tr>
		</tfoot>
	  </table>
</div>
</body>
</html>