var bandera=0;
function Buscador(){
        var xmlhttp=false;
        try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
                try {
                   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (E) {
                        xmlhttp = false;
                }
        }

        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}
function Div(div){
  	switch (div) {//VER EN QUE DIV SE VA MOSTRAR LOS DATOS
	   case 1:
	        c = document.getElementById('resultados');
			break
	   case 2:
	        c = document.getElementById('resultados2');
			break
	   case 3:
	        c = document.getElementById('resultados3');
			break
	   case 4:
	        c = document.getElementById('resultados4');
			break
	   case 5:
	        c = document.getElementById('resultados5');
			break
	   case 6:
	        c = document.getElementById('resultados6');
			break
	   case 7:
	        c = document.getElementById('resultados7');
			break
	   case 8:
	        c = document.getElementById('resultados8');
			break
	   case 9:
	        c = document.getElementById('resultados9');
			break
	   case 10:
	        c = document.getElementById('resultados10');
			break
	   case 11:
	        c = document.getElementById('resultados11');
			break
	   case 12:
	        c = document.getElementById('resultados12');
			break
	   case 13:
	        c = document.getElementById('resultados13');
			break
	}
	return c
}
function Operacion(q,opc,div){
    if(opc==12)
    {Location("operaciones.php?q="+q+"&opc="+opc);
    return;
    }
    c=Div(div)
    ajax=Buscador();
    var variables="";
    switch(opc){
       case 4:
	   case 8:
          variables="&d1="+TXT('d1')+"&d3="+TXT('d3')+"&d4="+TXT('d4')+"&d2="+Combo('d2');
          break;
    }
	if (bandera==1)
		return false;	
    ajax.open("GET", "operaciones.php?q="+q+"&opc="+opc+variables);	
    ajax.onreadystatechange=function() {
         if (ajax.readyState==4) {
                c.innerHTML = ajax.responseText
				window.scrollTo(0,c.offsetTop);
         }

   }
   ajax.send(null)	
}
function Confirmar(q,opc,div)
{
    if(confirm('\u00bfRealmente desea eliminar el registro?')) Operacion(q,opc,div);

}
function validacion(operacion){	
   switch(operacion){
	   case 1: //ES PARA VALIDAR CAMPOS DE TEXTO EN INICIO SESI�N
	      TXT('t1');TXT('t2');
   }
   if (bandera==1)
	   return false;
}
//***************************VALIDACI�N PARA CAMPOS DE TIPO TEXTO***********************
function TXT(dato){
	if (document.getElementById(dato).title!="")//SI TRAE NOMBRE; ES CAMPO OBLIGATORIO
	   if (Valida_txt(document.getElementById(dato))==false)//VER SI SE TECLE� INFORMACI�N
		  bandera=1;
	return document.getElementById(dato).value;//FALTA AGREGAR
}
function Valida_txt(texto){
    d=texto.value.replace(/(^\s+|\s+$)/g, '');
    if (d.length ==0) {
	   texto.style='background-color:#FF6600';
	   alert("TIENE QUE CAPTURAR DATO V\u00c1LIDO EN EL CAMPO "+texto.title)
	   return false;
    }else{
	   texto.style='background-color:#FFFFFF';
	   return true;
    }
}
//**************************************************************************************
//*********VALIDA DATO DE UNA LISTA*****************************************************
function Combo(dato){
	document.getElementById(dato).style='background-color:#FFFFFF';
	if (document.getElementById(dato).value==0){//SI NO SE HA SELECCIONADO EL COMBO
		document.getElementById(dato).style='background-color:#FFFF00';
		alert("NO HA SELECCIONADO REGISTRO EN LA LISTA "+document.getElementById(dato).name)
		ban=1;
	}
	return document.getElementById(dato).value;
}
function ValorOption(Opcion)
{
  var resultado="0";
  for(var i=0;i<Opcion.length;i++) 
  { 
     if(Opcion[i].checked) 
	    resultado=Opcion[i].value; 
  } 
  return resultado; 
}
function Valida_Fec(texto){
        var fecha = texto.value;
		if(validarFormatoFecha(fecha)){
			  if(existeFecha(fecha)==false){
					alert("La fecha introducida no existe.");
     			    texto.style='background-color:#FF6600';
			        return false;					
			  }
		}else{
			  alert("El formato de la fecha es incorrecto.");
     			    texto.style='background-color:#FF6600';
			        return false;			  
		}
	}
function Fec(dato){
    var fecha = document.getElementById(dato).value;
	document.getElementById(dato).style='background-color:#FFFFFF';
	if(validarFormatoFecha(fecha)){
		if(existeFecha(fecha)==false){
			alert("LA FECHA INTRODUCIDA EN EL CAMPO "+document.getElementById(dato).title+" NO EXISTE");
   			document.getElementById(dato).style='background-color:#FFFF00';
			bandera=1;
		    return false;					
		}
	}else{
		alert("EL FORMATO DE LA FECHA DEL CAMPO "+document.getElementById(dato).title+" ES INCORRECTO");
   		    document.getElementById(dato).style='background-color:#FFFF00';
			bandera=1;
		    return false;
	}
	return document.getElementById(dato).value;
}
function Numeros(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;    
    return /\d/.test(String.fromCharCode(keynum));
}
function Letras(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8||keynum==225||keynum==233||keynum==237||keynum==243||keynum==250||keynum==193||keynum==201||keynum==205||keynum==211||keynum==218)
        return true;
    if (keynum ==32)
        return true;		
	return /[A-Za-z]/.test(String.fromCharCode(keynum));	
}
function Letras_Punto(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8||keynum==225||keynum==233||keynum==237||keynum==243||keynum==250||keynum==193||keynum==201||keynum==205||keynum==211||keynum==218)
        return true;
    if (keynum ==32||keynum == 46)
        return true;		
	return /[A-Za-z]/.test(String.fromCharCode(keynum));	
}
function Letras_Numero(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8)
        return true;
	if (/\d/.test(String.fromCharCode(keynum)))
	    return true;
	if (/[A-Za-z]/.test(String.fromCharCode(keynum)))
	    return true;
	else
	    return false;
}
function Campo_Fecha(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8||keynum == 47)
        return true;
	return /\d/.test(String.fromCharCode(keynum));	
}
function Correo(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8||keynum == 95||keynum == 64||keynum == 46)
        return true;
	if (/\d/.test(String.fromCharCode(keynum)))
	    return true;
	if (/[A-Za-z]/.test(String.fromCharCode(keynum)))
	    return true;
	else
	    return false;
}
function Telefono(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8||keynum == 32||keynum == 40||keynum == 41||keynum == 95)
        return true;
	return /\d/.test(String.fromCharCode(keynum));	
}
function existeFecha(fecha){
      var fechaf = fecha.split("/");
      var day = fechaf[0];
      var month = fechaf[1];
      var year = fechaf[2];
      var date = new Date(year,month,'0');
      if((day-0)>(date.getDate()-0)){
            return false;
      }
      return true;
}
function validarFormatoFecha(campo) {
      var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
      if ((campo.match(RegExPattern)) && (campo!='')) {
            return true;
      } else {
            return false;
      }
}
function restaFechas(f1,f2){
    var aFecha1 = f1.split('/'); 
    var aFecha2 = f2.split('/'); 
    var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
    var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
    return dias;
 }