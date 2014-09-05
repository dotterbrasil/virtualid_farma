var valida = false;

function validachave() {

cnpj = document.formulario.origem.value;
chave = document.formulario.chave.value;

tamanho = chave.length;

cnpj_chave = chave.substr(6,14);
compara = cnpj.localeCompare(cnpj_chave);

if (tamanho==44) {
	if (compara==0) 
		{valida = 1;}
		else {valida = false;alert("Emissor NFe diferente do Fabricante");}
	}
	else {valida = false;alert("Chave de Acesso Inv�lida");}
}

function validacnpj(str) {
cnpj = str;
    var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
    digitos_iguais = 1;
    if (cnpj.length < 14 && cnpj.length < 15)
        return false;
    for (i = 0; i < cnpj.length - 1; i++)
        if (cnpj.charAt(i) != cnpj.charAt(i + 1))
    {
        digitos_iguais = 0;
        break;
    }
    if (!digitos_iguais)
    {
        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0,tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--)
        {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
		{
		navigator.notification.alert('CNPJ invalido');
	        return false;
		}
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0,tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--)
        {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
		{
		navigator.notification.alert('CNPJ invalido');
            	return false;
		}
        return true;
    }
    else
	{
	navigator.notification.alert('CNPJ invalido');
        return false;
	}
}

function validatransportadora(){
entrada = document.formulario.ftransportadora.value;
valida = validacnpj(entrada);
}

function validadestino(){
entrada = document.formulario.fdestino.value;
valida = validacnpj(entrada);
}

function envio(){
if (valida) {document.formulario.submit();} else {alert("Dados Inv�lidos !");}
}