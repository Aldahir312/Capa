<?php
   include("procesar.php");
   $c=new Funciones;
   $c->Conectar();
   switch($_GET['opc']){
      case 1://LOGUEO
	      $c->Logueo();
		  break;
      case 2://VISUALIZA BOTENES PARA USUARIO
	      $c->Botones_usuario();
		  break;
      case 3://EJEMPLO 2
	      $c->NuevoUsuario();
		  break;
      case 4://INSERTA DATOS DEL USUARIO
	      $c->InsertaUsuario();
	      break;
      case 6://VER USUARIO
	      $c->VerUsuario();
	      break;
      case 5://EDITAR USUARIO
	      $c->EditarUsuario();
	      break;
      case 7://VISUALIZAR DATOS DEL USUARIO PARA EDITAR
	      $c->VistaUsuarioEditar();
	      break;
      case 8://MODIFICA USUARIO SELECCIONADO
	      $c->ModificarUsuario();
	      break;
       case 9:
           $c->vistaEliminarUsuario();
           break;
       case 10:
           $c->eliminarUsuario();
           break;
       case 11:
           $c->Iframe_Usuario();
           break;
       case 12:
           $c->exportarAexcel();
               break;

   }
?>