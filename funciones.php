<?php
function versihay($sql){//FUNCIÓN PARA SABER SI HAY DATOS [REGRESA EL TOTAL DE REGISTROS ENCONTRADOS])
   @mysqli_query("SET NAMES 'utf8'"); 
   $query=mysqli_query($sql);
   return mysqli_num_rows($query);
}
function busca_un_dato($sql){
    $Dato="";
	@mysqli_query("SET NAMES 'utf8'");
	$query=mysqli_query($sql);
	if (mysqli_num_fields($query)>0){
	    $row=mysqli_fetch_assoc($query);
		$Dato=$row['Campo'];
	}
	return $Dato;
} 

?>