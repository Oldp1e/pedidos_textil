<?php 	
	session_start();
    if(is_null($_SESSION['online'])){
        echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';
	}		
?>
    
<?php 
    session_unset();
    session_destroy();
    echo '<script> location.replace("/pedidos_textil/login/index.php"); </script>';

?>