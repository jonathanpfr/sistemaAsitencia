// JavaScript Document

function tab(ev,obj) {
var keyCode = document.layers ? ev.which : document.all ? event.keyCode : document.getElementById ? ev.keyCode : 0;
if (keyCode !=13) return;
frm = obj.form;
for(i = 0; i < frm.elements.length; i++) 
if (frm.elements[i] == obj) { 
if (i == frm.elements.length-1) i =-1;
break 
}
frm.elements[i+1].focus();
return false;
}
function decimal(evt) {
var keyPressed = (evt.which) ? evt.which : event.keyCode
return !((keyPressed !=13) && (keyPressed != 46) && (keyPressed < 48 || keyPressed > 57));



}
function error(){
				alertify.error("Usuario no Autorizado!!!"); 
				return false; 
			}
			
			
			
			






function sacarDate(){
		ahora= new Date();//crea una fecha cogiendola del sistema
		hora = ahora.getHours(); //acumulando horas, minutos, segundos, dia, mes y año
		minuto = ahora.getMinutes(); 
		segundos = ahora.getSeconds();
		dia = ahora.getDate(); 
		año = ahora.getFullYear();

		var diad=new Array(7);
		diad[0]="Domingo";
		diad[1]="Lunes";
		diad[2]="Martes";
		diad[3]="Miercoles";
		diad[4]="Jueves";
		diad[5]="Viernes";
		diad[6]="Sabado";

		var mes=new Array(12);
		mes[0]="Enero";
		mes[1]="Febrero";
		mes[2]="Marzo";
		mes[3]="Abril";
		mes[4]="Mayo";
		mes[5]="Junio";
		mes[6]="Julio";
		mes[7]="Agosto";
		mes[8]="Septiembre";
		mes[9]="Octubre";
		mes[10]="Noviembre";
		mes[11]="Diciembre";
		

		var mostrarReloj=hora + "." + minuto+ "." + segundos; 
		var mostrarFecha= diad[ahora.getDay()] + "," + ' ' + dia + ' ' + "de" + ' ' + mes[ahora.getMonth()];
		var mostrarAño= año;

		document.tiempo.reloj.value=mostrarReloj;
		document.tiempo.fecha.value=mostrarFecha;
		document.tiempo.año.value=mostrarAño;

		setTimeout("sacarDate()",1000);


	}
	
$(document).ready(function () {
  
  //  $.post("clases/login/cargar_empresa.php", function (data) {
   // $("#empresa").html(data);
   // });
	
	  
	
});;	
	
				