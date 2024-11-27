<?php
	require 'utils/utils.php';
	require_once 'entity/File.class.php';
	require_once 'entity/Mensaje.class.php';
	require_once 'entity/connection.class.php';
	require 'core/app.class.php';
	require_once 'repository/MensajeRepository.class.php';

	try{
		$config = require_once 'app/config.php'; //Almacenamos los parámetros de configuración en $config
		App::bind('config',$config); //Introducimos en nuestro almacén de recursos de APP señálizándolo con la clave "Config"
	
		$mensajeRepository = new MensajeRepository();//Crea objeto de tipo PartnerRepository con sus atributos instanciados gracias al cosntructor
	
		if($_SERVER["REQUEST_METHOD"] == 'POST'){
			$primerNombre = trim($_POST["PrimerNombre"]);
			$apellidos = trim($_POST["Apellidos"]);	
			$email = trim($_POST["Email"]);
			$asunto = trim($_POST["Subjet"]);
			$texto = trim($_POST["Texto"]);

			//fecha
			$fechaActual = new DateTime();
			$fecha = $fechaActual->format('Y-m-d H:i:s');


			$camposObligatorios = ["First Name" => $primerNombre,"Email" => $email,"Subject" => $asunto];
			$errores;

			foreach ($camposObligatorios as $key => $campo) {
				if(empty($campo)){
					$errores[] = "El campo \"" . $key . "\" es obligatorio";
				}
			}
			
			if( empty(!$email) && filter_var($email,FILTER_VALIDATE_EMAIL) === false){
				$errores[] = "El eMail introducido no es válido";
			}

			//subir a la BBDD
			$mensaje = new Mensaje($primerNombre,$apellidos,$asunto,$email,$texto,$fecha);//Creamos el objeto de la Imagen a subirse a la BBDD, con sus parámetros
			$mensajeRepository->save($mensaje); //aplicamos la sentencia SQL de Insert en el servidor
			$descripcion='';
			$mensaje = "Contacto guardado";
		}
	}catch(FileException $exception){
		$errores[]=$exception->getMessage();
	}catch(QueryException $exception){
		$errores[]=$exception->getMessage();
	}catch (AppException $exception){
		$errores[] = $exception->getMessage();
	}
	
    require 'views/contact.view.php';
?>