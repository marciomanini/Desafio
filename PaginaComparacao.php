<?php
	include_once("util/conexao.php");
	include_once("menu.php");
	$resultado = mysql_query("SELECT id, id_marca, modelo, motor, ano_fabricacao FROM carros order by id_marca, modelo");
?>
<script>
	var radioEsq = "";
	var radioDir = "";
	
	function selecionaModelos(radioButton){
		
		if(radioButton.name == "esquerda"){
			radioEsq = radioButton.id;
			if (radioDir != ""){
				if(radioEsq != radioDir){
					PagComparacao.src = "ExibeComparacao.php?idEsq=" + radioEsq + "&idDir=" + radioDir + "&destino=tela";
				}else{
					PagComparacao.src = "";
				}
			}
		}
		if(radioButton.name == "direita"){
			radioDir = radioButton.id;
			if (radioEsq != ""){
				if(radioEsq != radioDir){
					PagComparacao.src = "ExibeComparacao.php?idEsq=" + radioEsq + "&idDir=" + radioDir + "&destino=tela";
				}else{
					PagComparacao.src = "";
				}
			}
		}
	}
</script>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Página de Comparação">
	<meta name="author" content="Marcio Manini">
	
	<link rel="icon" href="imagens/eficiente.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
	
	<title>Página de Comparação</title>
</head>
<body>
<div class="container theme-showcase">
	<div class="cabecalho">
		<h1>Lista de modelos para comparação</h1>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Motor</th>
				<th>Ano</th>
				<th class="comparar" title="Comparar com outro modelo utilizando a posição da esquerda">COMPARAR</th>
				<th class="comparar" title="Comparar com outro modelo utilizando a posição da direita">COMPARAR</th>
			</tr>
		</thead>
		<tbody class="sem-atracao">
			<?php
				$linhas = mysql_num_rows($resultado);
				while($linhas = mysql_fetch_array($resultado)){
					echo "<tr>";
						echo "<td>".$linhas['id_marca']."</td>";
						echo "<td>".$linhas['modelo']."</td>";
						echo "<td>".number_format($linhas['motor'], 1, ".", ".")."</td>";
						echo "<td>".$linhas['ano_fabricacao']."</td>";
						echo "<td align='center'><input type='radio' name='esquerda' id='$linhas[id]' onclick='javascript:selecionaModelos(this);'></td>";
						echo "<td align='center'><input type='radio' name='direita' id='$linhas[id]' onclick='javascript:selecionaModelos(this);'></td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<iframe id="PagComparacao" src="" frameborder="0" width="100%" height="100%"></iframe>
</div>
</body>
</html>