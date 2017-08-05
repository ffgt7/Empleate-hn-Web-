<?php
    include("../lib/conexion.php");
    
    $userName= $_POST['userName'];
    $nameCurso=$_POST['nameCurso'];  
    
    $query = "select cod_empleo from curri_cursos join usuarios_empleo on fk_userCursos = cod_empleo 
                where nomb_curso = ? AND nomb_user = ?";
    $results = $conexion->prepare($query);
	$results->execute(array($nameCurso,$userName));
	$num=$results->rowCount();
	
	echo "$num";
