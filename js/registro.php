<?php
$conteudo = "";
$registro = "";
$distribuidor = "";
$zona = "";
$embarque = "";
$auxiliar = chr(39);
$id = "1";

$conteudo = stripslashes($_POST["conteudo"]);
$campos = $_POST["campos"];
$dados = explode(";",$_POST["dados"]);
$registros = $_POST["registros"];
$contador = $registros*$campos;

$anvisa = $_POST["fanvisa"];
$serial = $_POST["fserial"];
$lote = $_POST["flote"];
$validade = $_POST["fvalidade"];$validade = str_replace("/","",$validade);
$destino = $_POST["fdestino"];
$transportadora = $_POST["ftransportadora"];
$nfe = $_POST["fnfe"];
$natureza = $_POST["fnatureza"];
$id = $_POST["fid"];

date_default_timezone_set("America/Sao_Paulo");


for ($x=0; $x<$contador; $x++)
  {

	if (!($x<$campos-1))
		{

		$alfa = $x%$campos;

		if ($alfa==0)
			{

			$serial = $dados[$x];

			$conteudo2 =  date("d/m/Y - h:i:sa")." - Natureza: ".$natureza." - NFe: ".$nfe." - Origem: ".$origem." - Destino: ".$destino." - Transportadora: ".$transportadora.chr(10).chr(13);

			$endereco = $anvisa."/".$lote."/".$serial;

			$FILE = "../".$endereco.".vid";

				if(file_exists($FILE)) {
					$fp = fopen($FILE, "a+");
					if(!fwrite($fp, $conteudo2)) {
						$FILE2 = "../vid/log_de_erros.txt";
						$fp2 = fopen($FILE2, "r+");
						fwrite($fp2, $endereco);
						fclose($fp2);
						}
					fclose($fp);
					echo "<html><script>texto_alerta = 'registrou arquivo'; alert(texto_alerta);</script></html>";
					}
					else {
						echo "<html><script>texto_alerta = 'registro inexistente! ';alert(texto_alerta);</script></html>";
						}

			}
		}
  } 

exit("Operacao Efetuada!");

?>
