<?php

session_start();
require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai Member atau Admin!');
          document.location.href = 'login.php';
      </script>";
}

if (delete_product()) {
  echo "<script>
         document.location.href = 'products.php?mode=edit';
        </script>";
}

?>