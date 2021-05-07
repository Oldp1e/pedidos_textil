<?php 

  INCLUDE '/pedidos_textil/pathing.php';
  INCLUDE $childDirectory.$dblogin;

  
  $username = $_POST['usuario'];
  $password = $_POST['senha'];

  $sql = "SELECT nivel_perm FROM usuarios WHERE (username='$username' OR email='$username') ";
  $result = OpenCon()->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $nivel = $row["nivel_perm"];
    }
  } else {
    echo "0 results";
  }

  $sql = "SELECT username, password, email FROM usuarios WHERE (username='$username' OR email='$username') AND password='$password'";
  $result = mysqli_query(OpenCon(), $sql);
  

  if ($row = mysqli_fetch_assoc($result)) {
    session_start();
    echo "You are logged in!";
      $_SESSION['user'] = $username;
    $_SESSION['online'] = 'true';
    switch($nivel){
      case "administrador":
        echo '<script> location.replace("/pedidos_textil/menu/index.php"); </script>';
        break;
      case "representante":
        echo '<script> location.replace("/pedidos_textil/menu_representantes/index.php"); </script>';
        break;
        case "coordernador":
          echo '<script> location.replace("/pedidos_textil/menu_coordenador/index.php"); </script>';
          break;
    }
      
  
    
    
    
    die();

  } else {
    echo "Senha ou usuario incorretos.";
  }
?>
	<!-- Fim