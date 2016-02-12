<?php
	include_once("util/conexao.php");
	include_once("menu.php");
	$resultado = mysql_query("SELECT id_marca, modelo, motor, ano_fabricacao FROM carros order by id_marca, modelo");
	$linhas = mysql_num_rows($resultado);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Página de Apresentação">
	<meta name="author" content="Marcio Manini">
	
	<link rel="icon" href="imagens/eficiente.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/estilo.css" rel="stylesheet">
	
	<title>Página de Apresentação</title>
</head>
<body>
<div class="container theme-showcase">
	<div class="cabecalho">
		<h1>Lista de modelos</h1>
	</div>
	<div class="row">
        <div class="tabela">
			<table class="table">
				<thead>
					<tr>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Motor</th>
						<th>Ano</th>
					</tr>
				</thead>
				<tbody class="sem-atracao">
					<?php 
						while($linhas = mysql_fetch_array($resultado)){
							echo "<tr>";
								echo "<td>".$linhas['id_marca']."</td>";
								echo "<td>".$linhas['modelo']."</td>";
								echo "<td>".number_format($linhas['motor'], 1, ".", ".")."</td>";
								echo "<td>".$linhas['ano_fabricacao']."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
        </div>
	</div>
</div> <!-- /container -->
</body>
</html>