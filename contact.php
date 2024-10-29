<?php
	require 'utils/utils.php';

	if($_SERVER["REQUEST_METHOD"] == 'POST'){
		$primerNombre = trim($_POST["PrimerNombre"]);
		$apellidos = trim($_POST["Apellidos"]);	
		$email = trim($_POST["Email"]);
		$sujeto = trim($_POST["Subjet"]);
		$mensaje = trim($_POST["Texto"]);

		$camposObligatorios = ["First Name" => $primerNombre,"Email" => $email,"Subject" => $sujeto];
        $errores;

		foreach ($camposObligatorios as $key => $campo) {
            if(empty($campo)){
                $errores[] = "El campo \"" . $key . "\" es obligatorio";
			}
		}
        
        if( empty(!$email) && filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            $errores[] = "El eMail introducido no es válido";
        }
	}

    require 'views/contact.view.php';
?>