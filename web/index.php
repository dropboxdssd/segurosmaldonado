<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Agregar fotos a expediente (dropbox)</title>

<link href="estilo3.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="jquery-3.2.1.min.js"> </script>
<script src="https://unpkg.com/dropbox/dist/Dropbox-sdk.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#nuevoinput").click(function(){
		var total= document.getElementById("total").value;
		total=parseInt(total)+1;
		
		document.getElementById("total").value=total.toString();
		total=total.toString();
		var x = document.createElement("INPUT");
		var br = document.createElement("BR");
		x.setAttribute("type", "file");
		x.setAttribute("name", "archivo"+total);
		div=document.getElementById("fotos");
		div.appendChild(br);
		div.appendChild(x);
		

		
	})
	
	
	$("#subir").click(function(){
		var archivo=document.getElementById("archivo1").value;
		const ACCESS_TOKEN=document.getElementById("token").value;
		var Dropbox = require('dropbox');
		var dbx = new Dropbox({ accessToken: '6i1WBS8gA2AAAAAAAAAAF96rvA-JMlQtfl3nACVRw-r5vG9xdo-z_OGhOyK79asC' });
		dbx.filesListFolder({path: '/Aplicaciones/seguros2017'})
		.then(function(response) {
		console.log(response);
	})
		.catch(function(error) {
		console.log(error);
  });
		alert(dbx);

		
	})
	$("#subir2").click(function(){
	  
	  var ACCESS_TOKEN = document.getElementById('token').value;
      var dbx = new Dropbox({ accessToken: ACCESS_TOKEN });
      var fileInput = document.getElementById('archivo1');
      var file = fileInput.files[0];
      dbx.filesUpload({path: '/'+ file.name, contents: file})
        .then(function(response) {
          var results = document.getElementById('results');
          results.appendChild(document.createTextNode('Archivo cargado!'));
          console.log(response);
        })
        .catch(function(error) {
          console.error(error);
        });
      return false;
	})
	

})

</script>

</head>
<body>

<form action="subir.php" method="post" enctype="multipart/form-data">
	<label>Complete el numero de expediente</label>
	<input type="text" name="expediente"/>
	
	<label>Seleccione las fotos que se adjuntaran al expediente</label>
	<input type="hidden" id="total" name="total" value="1">
	<div id="fotos">
	<input type="file" name="archivo1" id="archivo"/>
	<input type="hidden"  id="token" value="6i1WBS8gA2AAAAAAAAAAF96rvA-JMlQtfl3nACVRw-r5vG9xdo-z_OGhOyK79asC"/>
	
	</div>
	<br><br>
	
	<input type="button" value="Agregar mas fotos" id="nuevoinput" />
	
	<button id="subir2" type="submit">Subir a Dropbox</button>


</form>
<h2 id="results" style="text-align:center;"> <?php session_start(); if(isset($_SESSION['mensaje'])){ echo $_SESSION['mensaje']; }?></h2>

</body>
</html>


