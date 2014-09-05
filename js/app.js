var resultDiv;


function separa(n) {

separador = String.fromCharCode(29);
tamanho = n.length;
GTIN = "";
reg_anvisa = "";
serial = "";
validade = "";
lote = "";

for (i=0;i<4;i++) {
	if (n.substring(0,1)==separador) {n = n.substring(1,n.length);}
	if (i==0) {
		campo = n.substring(0,3);
		}
		else
		{
		campo = n.substring(0,2);
		}
	fim_de_campo = n.indexOf(separador);
	if(fim_de_campo<0){fim_de_campo = n.length;}
	switch(campo)
		{
		case "01":
		GTIN = n.substring(2,16);
		n = n.substring(16,n.length);
		break;
	case "21":
		serial = n.substring(2,fim_de_campo);
		document.formulario.fserial.value = serial;
		n = n.substring(fim_de_campo,n.length);
		break;
	case "17":
		validade = n.substring(2,8);
		validade = n.substring(6,8)+"/"+n.substring(4,6)+"/"+n.substring(2,4);
		document.formulario.fvalidade.value = n.substring(4,6)+"/"+n.substring(2,4);
		n = n.substring(8,n.length);
		break;
	case "10":
		lote = n.substring(2,fim_de_campo);
		document.formulario.flote.value = lote;
		n = n.substring(fim_de_campo,n.length);
		break;
	case "713":
		reg_anvisa = n.substring(3,fim_de_campo);
		n = n.substring(fim_de_campo,n.length);
		document.formulario.fanvisa.value = reg_anvisa;
		break;


	default:
		alert("Este não é um código válido!");i=10;
		break;
		}
}
alert("GTIN: "+GTIN+"\n"+"Reg. ANVISA: "+reg_anvisa+"\n"+"Serial: "+serial+"\n"+"Lote: "+lote+"\n"+"Validade: "+validade);


}



function init() {
	document.addEventListener("deviceready", init, false);
	resultDiv = document.getElementByid('results');
}

function startScan() {

	var scanner = cordova.require("cordova/plugin/BarcodeScanner");
	var aux = "";

	scanner.scan(
		function (result) {
			/*var s = "Result: " + result.text + "\n" + "Format: " + result.format + "\n" +"Cancelled: " + result.cancelled;
			alert("hey: "+s);
			alert("separando...");*/
			
			aux = result.text;
			separa(aux);
		}, 
		function (error) {
			alert("Scanning failed: " + error);
		}
	);

}

function identifica() {


alert('Dispositivo: '  + device.name + '<br />' + 'Versão Phonegap: ' + device.cordova + '<br />' + 'Plataforma: '+ device.platform + '<br />' + 'UUID: '+ device.uuid+ '<br />' +'Versão: ' + device.version  + '<br />');

    }