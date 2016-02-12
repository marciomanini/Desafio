<?php
	include_once("util/conexao.php");
	include_once("menu.php");
	$resultado = mysql_query("SELECT id, id_marca, modelo, motor, ano_fabricacao FROM carros");
?>
<script>
	var radioEsq = "";
	var radioDir = "";
	
	function selecionaModelos(radioButton){
		
		if(radioButton.name == "esquerda"){
			radioEsq = radioButton.id;
			if (radioDir != ""){
				if(radioEsq != radioDir){
					btn_exportar.style.display = "";
				}else{
					btn_exportar.style.display = "none";
				}
			}
		}
		if(radioButton.name == "direita"){
			radioDir = radioButton.id;
			if (radioEsq != ""){
				if(radioEsq != radioDir){
					btn_exportar.style.display = "";
				}else{
					btn_exportar.style.display = "none";
				}
			}
		}
	}
	
	function exportarResultado(){
		PagExportacao.src = "MontaArquivo.php?idEsq=" + radioEsq + "&idDir=" + radioDir + "&destino=arquivo";
	} 
</script>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Página de Exportação">
	<meta name="author" content="Marcio Manini">
	
	<link rel="icon" href="imagens/eficiente.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
	
	<title>Página de Exportação</title>
</head>
<body>
<div class="container theme-showcase">
	<div class="cabecalho">
		<h1>Lista de modelos para comparação e exportação</h1>
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
        </div>
	</div>
	<p>
        <button id="btn_exportar" style="display:none" type="button" class="btn btn-lg botao-exp" onclick="javascipt:exportarResultado();">Exportar</button>
		<iframe id="PagExportacao" style="display:none" src="" frameborder="0"></iframe>
	</p>
</div>
</body>
</html>