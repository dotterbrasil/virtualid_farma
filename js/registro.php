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
$evento = $_POST["fevento"];
$distribuidor = $_POST["fdistribuidor"];
$zona = $_POST["fzona"];
$embarque = $_POST["fembarque"];$embarque = str_replace("/","",$embarque);
$contador = $registros*$campos;

for ($x=0; $x<$contador; $x++)
  {
	if (!($x<$campos-1))
		{
		$alfa = $x%$campos;
		if ($alfa==0)
			{
			$id = $dados[$x].$dados[$x+1];
			$conteudo2 = str_replace("id=".$auxiliar,"id=".$auxiliar.$id,$conteudo);

			$conteudo2 = str_replace("evento=".$auxiliar,"evento=".$auxiliar.$evento,$conteudo2);
			$conteudo2 = str_replace("distribuidor=".$auxiliar,"distribuidor=".$auxiliar.$distribuidor,$conteudo2);
			$conteudo2 = str_replace("zona=".$auxiliar,"zona=".$auxiliar.$zona,$conteudo2);
			$conteudo2 = str_replace("embarque=".$auxiliar,"embarque=".$auxiliar.$embarque,$conteudo2);

			$inicio = strpos($conteudo2,"id=")+4;
			$fim = strpos($conteudo2,"distribuidor")-$inicio-2;

			$endereco = substr($conteudo2,$inicio,$fim);
			$serial = substr($endereco,0,8);
			$lote = substr($serial,0,2);


			$FILE = "../vid/".$endereco.".php";echo "<script>alert('ok');</script>";
				if(file_exists($FILE)) {
					$fp = fopen($FILE, "r+");
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

echo "<html><script>document.location.href = 'http://v-id.net/demo/app_demo.htm';</script></html>";
?>
