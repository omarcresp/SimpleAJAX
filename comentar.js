function enviarComentario() {
	if ($("#comentario")[0].value) {
		RealizarPeticion($("#comentario")[0].value);
		$("#comentario")[0].value = "";
	} else {
		alert("Escriba un comentario");
	}
}

function RealizarPeticion(comentario="") {
	$.getJSON("GestionarComentarios.php", {"user" : "Omar", "comentario" : comentario })
	.done( function (data) {
		let output = "";

		for (var i = 0; i < data.length; i++) {
			let head = data[i];

			output += "<p>";

			output += `${head["user"]}: ${head["coment"]}`;

			output += "</p>";
		}

		$("#contenedor").html(output);
	} )
}