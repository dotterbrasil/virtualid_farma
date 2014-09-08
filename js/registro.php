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


for ($x=0; $x<$contador; $x++)
  {
	if (!($x<$campos-1))
		{
		$alfa = $x%$campos;
		if ($alfa==0)
			{
			$serial = $dados[$x];
			$conteudo2 =  date("h:i:sa")." - Natureza: ".$natureza." - NFe: ".$nfe." - Origem: ".$origem." - Destino: ".$destino." - Transportadora: ".$transportadora;

			$endereco = $anvisa."/".$lote."/".$serial;


			$FILE = "http://v-id.net/demo/farma/".$endereco.".vid";
				if(file_exists($FILE)) {
					$fp = fopen($FILE, "a+");
					if(!fwrite($fp, $conteudo2)) {
						$FILE2 = "../vid/log_de_erros.txt";
						$fp2 = fopen($FILE2, "r+");
						fwrite($fp2, $endereco);
						fclose($fp2);
						}
					fclose($fp);
					echo "<html><script>alert('Registrou arquivo: '".$id."'\n');</script></html>";
					}
					else {
						echo "<html><script>alert('Registro Inexistente!');</script></html>";
						}

			}
		}
  } 


?>
