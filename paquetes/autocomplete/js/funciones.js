$().ready(function() {
	$("#buscar").autocomplete("../modelo/autocompletar_cliente.php", {
		width: 660,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$("#buscar").result(function(event, data, formatted) {

		$("#codigo").val(data[1]);
		$("#buscar").val(data[2]);
			
	
	});

});


