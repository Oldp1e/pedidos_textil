<?php 	
    session_save_path("/pedidos_textil/tmp");
	session_start();
    if(is_null($_SESSION['online'])){
		// header('Location: '.'/representantes/login/index.php');
        echo '<script> location.replace("/representantes/login/index.php"); </script>';
	}		
?>
    
<?php 
    session_unset();
    session_destroy();
    echo '<script> location.replace("/representantes/login/index.php"); </script>';

?>