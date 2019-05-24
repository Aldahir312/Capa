<?php include("vistas/header.html"); ?>
<section id="contenido">
<script src="script.js"></script>
<form action="operaciones.php?opc=1" method="post" onsubmit="return validacion(1)">
<table width="413" border="0" align="center">
  <tr>
    <td colspan="2"><div align="center"><p>LOGUEO DEL ADMINISTRADOR</p></div></td>
  </tr>
  <tr>
    <td width="114"><p>USUARIO</p></td>
    <td width="289"><label>
      <input name="t1" type="text" id="t1" size="20" maxlength="20" title="USUARIO"/>
    </label></td>
  </tr>
  <tr>
    <td><p>CONTRASE&Ntilde;A</p></td>
    <td><input name="t2" type="password" id="t2" size="20" maxlength="20" title="CONTRASE&Ntilde;A"/></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <label>
      <input type="submit" name="Submit" value="Enviar" />
      </label>
    </div></td>
  </tr>
  <?php
      session_start(); 
      if (isset($_SESSION['id'])){ ?>  
	  <tr>
		<td colspan="2"><div align="center">
		  <label>USUARIO O CONTRASE&Ntilde;A NO EXISTE</label>
		</div></td>
	  </tr>  
  <?php }?> 
</table>
</form>
</section>
<?php include("vistas/aside.html");
        include("vistas/footer.html");?>