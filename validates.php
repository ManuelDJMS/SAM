<?php
  if(!isset($_SESSION['iduser'])){
    $redirecciona = <<<_END
    <script>
      window.location.replace("login.php");
    </script>
    _END;
    
    die($redirecciona);
  }
?>
