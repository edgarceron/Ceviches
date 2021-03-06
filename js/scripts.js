// Empty JS for your own code to be here
var formatNumber = {
 separador: ',', // separador para los miles
 sepDecimal: '.', // separador para los decimales
 formatear:function (num){
  num +='';
  var splitStr = num.split('.');
  var splitLeft = splitStr[0];
  var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
  var regx = /(\d+)(\d{3})/;
  while (regx.test(splitLeft)) {
  splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
  }
  return this.simbol + splitLeft  +splitRight;
 },
 new:function(num, simbol){
  this.simbol = simbol ||'';
  return this.formatear(num);
 }
}
////////////////////////////////////////

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
	$('.tbres').doubleScroll({onlyIfScroll: false, resetOnWindowResize: true});
});

function seleccionar(tipo){
	if(tipo == "Efectivo"){
		$("input[name='medio_pago'][value='1']").prop('checked', true);
	}
	else if(tipo == "PayU"){
		$("input[name='medio_pago'][value='2']").prop('checked', true);
	}
}