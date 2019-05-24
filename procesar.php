<?php
include 'funciones.php';
class Funciones {//Inicio de la clase
  function Conectar(){//Realizamos la conexion
      include 'conexion.php';
   }
   function Logueo(){
      
       session_start();
       $id=busca_un_dato("SELECT id_us AS Campo FROM usuarios where usuario='".$_POST['t1']."' and psw='".$_POST['t2']."'");
	   if ($id=1){
           $_SESSION['id'] = $id;
		   header("location:principal.php"); 
	   }
	   else{
	       $_SESSION['id'] = 0;
	       header("location:index.php"); 
	   }
   }
   function Botones_usuario(){
      print '<a href="javascript:Operacion(4,3,2)">NUEVO</a><BR>
         <a href="javascript:Operacion(4,5,2)">MODIFICAR</a><BR>
         <a href="javascript:Operacion(4,9,2)">ELIMINAR</a><BR>
         <a href="javascript:Operacion(4,6,2)">EXAMINAR</a><BR>';
   }
   function NuevoUsuario(){
	   
      print '<table width="359" border="0">
		  <tr>
			<td colspan="2"><div align="center">NUEVO USUARIO </div></td>
		  </tr>
		  <tr>
			<td width="88">Nombre</td>
			<td width="261"><label>
			  <input name="d1" type="text" id="d1" size="40" maxlength="70" title="NOMBRE DEL USUARIO">
			</label></td>
		  </tr>
		  <tr>
			<td>Genero</td>
			<td><label>
			  <select name="d2" id="d2">
				<option value="0">---Seleccione g&eacute;nero del usuario</option>
				<option value="1">HOMBRE</option>
				<option value="2">MUJER</option>
			  </select>
			</label></td>
		  </tr>
		  <tr>
			<td>Usuario</td>
			<td><input name="d3" type="text" id="d3" size="40" maxlength="70" title="CUENTA DEL USUARIO"></td>
		  </tr>
		  <tr>
			<td>Contrase&ntilde;a</td>
			<td><input name="d4" type="password" id="d4" size="20" maxlength="80" tite="CONTRASE�A DEL USUARIO"></td>
		  </tr>
		  <tr>
			<td colspan="2"><div align="center"><a href="javascript:Operacion(4,4,2)">GUARDAR INFORMACI&Oacute;N</a> </div></td>
		  </tr>
		</table>';
    //  print '<br> <a href="javascript:Operacion(4,11,2)">Importar desde archivo</a>';
         print '<br> Importar desde archivo Excel</a>';
       print '<form action="inserta_usuarios.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<p>
<label>
<br>Seleccione un archivo<br>
<input name="archivo" type="file" id="archivo"></label>
</p>
<p>
<label> <input type="submit" name="Submit" value="Enviar">
</label>
</form>
</p>
<p><br></p>';
   }
   function InsertaUsuario(){
	  include 'conexion.php';
	   $sql="INSERT INTO usuarios(id_us,nombre_us,genero,usuario,psw) VALUES(NULL,'".$_GET['d1']."',".$_GET['d2'].",'".$_GET['d3']."',
	   '".$_GET['d4']."')";
	   if ($sql=mysqli_query($login,$sql)){
			//header("Location:Procesar_ps.php?q=1&opc=2"); 
			print 'LA INFORMACI�N SE INSERT� CORRECTAMENTE';
	   }
	   else
		   print "NO SE PUDO INSERTAR POR ".mysqli_error().$sql.'<p></p>';   
   }
   function VerUsuario(){
	  include 'conexion.php';
	   $sql= "SELECT id_us,nombre_us,CASE genero WHEN 1 THEN 'HOMBRE' WHEN 2 THEN 'MUJER' END AS gn,usuario FROM usuarios";
	   @mysqli_query("SET NAMES 'utf8'");
	   $Resultado=mysqli_query($login,$sql); 
	   if(mysqli_num_rows($Resultado) > 0){
		  print '<table border="1">
		    <tr>
				 <td>ID</td>
				 <td>NOMBRE</td>
				 <td>GENERO</td>
				 <td>USUARIO</td>
			</tr>';
		  while($Datos=mysqli_fetch_array($Resultado)){
			print '<tr>
				 <td>'.$Datos['id_us'].'</td>
				 <td>'.$Datos['nombre_us'].'</td>
				 <td>'.$Datos['gn'].'</td>
				 <td>'.$Datos['usuario'].'</td>';
		  }
	//	  print '</table> <br><a href="javascript:Operacion(0,12,2)">Exportar</a>';
           print '</table> <br><a href="PhpExcel/exportar_usuarios.php">Exportar</a>';
	   }else
	       print 'NO HAY REGISTROS';
   }
   function exportarAexcel()
   {
       //http://localhost/Web2/pg2_u1/ejemplo/PhpExcel/exportar_usuarios.php
       header("location:PhpExcel/exportar_usuarios.php");
   }
   function EditarUsuario(){
	   include 'conexion.php';
	   $sql= "SELECT id_us,nombre_us,CASE genero WHEN 1 THEN 'HOMBRE' WHEN 2 THEN 'MUJER' END AS gn,usuario FROM usuarios";
	   @mysqli_query("SET NAMES 'utf8'");
	   $Resultado=mysqli_query($login,$sql); 
	   if(mysqli_num_rows($Resultado) > 0){
		  print '<table border="1">
		    <tr>
				 <td>ID</td>
				 <td>NOMBRE</td>
				 <td>GENERO</td>
				 <td>USUARIO</td>
			</tr>';
		  while($Datos=mysqli_fetch_array($Resultado)){
		    $link='<acronym title="IR PARA EDITAR REGISTRO"><a href="javascript:Operacion('.$Datos['id_us'].',7,3)">';
			print '<tr>
				 <td>'.$link.$Datos['id_us'].'</a></acronym></td>
				 <td>'.$link.$Datos['nombre_us'].'</td>
				 <td>'.$link.$Datos['gn'].'</td>
				 <td>'.$link.$Datos['usuario'].'</td>';
		  }
		  print '</table><div id="resultados3">';
	   }else
	       print 'NO HAY REGISTROS';
   }
   function VistaUsuarioEditar(){
	   include 'conexion.php';
	  $Resultado= mysqli_query($login,"SELECT id_us,nombre_us,genero,usuario,psw FROM usuarios where id_us=".$_GET['q']);
	  @mysqli_query("SET NAMES 'utf8'");
	  $Datos=mysqli_fetch_array($Resultado);
	  $Gen=array('','','');
	  $Gen[$Datos['genero']]="selected";
      print '<table width="359" border="0">
		  <tr>
			<td colspan="2"><div align="center">EDITAR DATOS DEL USUARIO SELECCIONADO</div></td>
		  </tr>
		  <tr>
			<td width="88">Nombre</td>
			<td width="261"><label>
			  <input name="d1" type="text" id="d1" size="40" maxlength="70" title="NOMBRE DEL USUARIO" value="'.$Datos['nombre_us'].'">
			</label></td>
		  </tr>
		  <tr>
			<td>Genero</td>
			<td><label>
			  <select name="d2" id="d2">
				<option value="0">---Seleccione g&eacute;nero del usuario</option>
				<option value="1" '.$Gen[1].'>HOMBRE</option>
				<option value="2" '.$Gen[2].'>MUJER</option>
			  </select>
			</label></td>
		  </tr>
		  <tr>
			<td>Usuario</td>
			<td><input name="d3" type="text" id="d3" size="40" maxlength="70" title="CUENTA DEL USUARIO" value="'.$Datos['usuario'].'"></td>
		  </tr>
		  <tr>
			<td>Contrase&ntilde;a</td>
			<td><input name="d4" type="password" id="d4" size="20" maxlength="80" tite="CONTRASE�A DEL USUARIO" value="'.$Datos['psw'].'"></td>
		  </tr>
		  <tr>
			<td colspan="2"><div align="center"><a href="javascript:Operacion('.$_GET['q'].',8,2)">GUARDAR INFORMACI&Oacute;N</a> </div></td>
		  </tr>
		</table>';
   }
   function ModificarUsuario(){
	   include 'conexion.php';
	   $sql="UPDATE usuarios SET nombre_us='".$_GET['d1']."',genero=".$_GET['d2'].",usuario='".$_GET['d3']."',psw='".$_GET['d4']."' 
	   WHERE id_us=".$_GET['q'];
	   if ($sql=mysqli_query($login,$sql)){
			header("Location:operaciones.php?q=1&opc=5"); 
	   }
	   else
		   print "NO SE PUDO MODIFICAR POR ".mysqli_error().$sql.'<p></p>';   
   }
    function vistaEliminarUsuario(){
        include 'conexion.php';
        $sql= "SELECT id_us,nombre_us,CASE genero WHEN 1 THEN 'HOMBRE' WHEN 2 THEN 'MUJER' END AS gn,usuario FROM usuarios";
        @mysqli_query("SET NAMES 'utf8'");
        $Resultado=mysqli_query($login,$sql);
        if(mysqli_num_rows($Resultado) > 0){
            print '<table border="1">
		    <tr>
				 <td>ID</td>
				 <td>NOMBRE</td>
				 <td>GENERO</td>
				 <td>USUARIO</td>
			</tr>';
            while($Datos=mysqli_fetch_array($Resultado)){
                $link='<acronym title="Eliminar registro"><a href="javascript:Confirmar('.$Datos['id_us'].',10,2)">';
                print '<tr>
				 <td>'.$link.$Datos['id_us'].'</a></acronym></td>
				 <td>'.$link.$Datos['nombre_us'].'</td>
				 <td>'.$link.$Datos['gn'].'</td>
				 <td>'.$link.$Datos['usuario'].'</td>';
            }
        }else
            print 'NO HAY REGISTROS';
    }
    function eliminarUsuario()
    {
        include 'conexion.php';
        $sql="Delete from usuarios WHERE id_us=".$_GET['q'];
        $sql=mysqli_query($login,$sql);
        if ($sql){
            header("Location:operaciones.php?q=4&opc=9");
        }
        else
            print "Imposible eliminar".mysqli_error().$sql.'<p></p>';

    }
    function Iframe_Usuario()
    {
        print '<iframe id="importar" width="300"   height="300" src="Seleccionar_archivo.php"> ';
    }

}//Fin de la Clase
?>