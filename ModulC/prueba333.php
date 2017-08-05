<html>
<head>
    <?php require_once('../js/funciones_ajax.js');?>
    <script>
    $(document).ready(function(){
    	$("#boton01").click(function(){
    		$("#rrr").text("hola");
    	});
    });
    </script>
</head>
<body>
    <form id="formulario_search" name="formulario_search">
    
    <input id="texto" type="text" size="30" id="formulario_search_cas" name="formulario_search_cas" onkeyup="mostrarResultados(this.value)" />
    <div id="buscador_dinamico"></div>
    </form>
    <p id="rrr"></p>
</body>
</html>