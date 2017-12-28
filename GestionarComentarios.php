<?php

// RECIBIR PETICION ===============================================================
	$comentario = $_GET["comentario"] ? $_GET["comentario"] : false;
	$user = $_GET["user"] ? $_GET["user"] : false;

// BASE DE DATOS ==================================================================
	// Conectarse a la base de datos
		$servername = "localhost";
		$username = "root";
		$password = "27282789JackCres$";
		$dbname = "comentarios";

		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

	// Crear la tabla si no existe
		$sql = "SELECT ID FROM COMENTARIOS";
		$result = $conn->query($sql);

		if (!$result) {
			$sql = "CREATE TABLE COMENTARIOS (
						ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
						user VARCHAR(30) NOT NULL,
						coment VARCHAR(30) NOT NULL,
						reg_date TIMESTAMP
						)";

			if ($conn->query($sql) === TRUE) {
			    echo "Tabla COMENTARIOS creada";
			} else {
				echo "ERROR!";
			}
		}

	// Insertar datos si es necesario
		if ($comentario && $user) {
			$sql = "INSERT INTO COMENTARIOS (user, coment)
				VALUES ('" . $user . "', '" . $comentario . "')";

			$conn->query($sql);
		}

	// Leer la base de datos
		$sql = "SELECT * FROM COMENTARIOS";

		$result = $conn->query($sql);

		$rawdata = array();
		$i = 0;

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
        		$rawdata[$i] = $row;
        		$i++;
		    }
		}

		$data = json_encode($rawdata);

	$conn->close();		// Cerrar la base de datos

// RESPONDER PETICION =============================================================
	echo $data;

