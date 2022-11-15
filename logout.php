<?php

session_start();
require "config.php";

if (!isset($_SESSION["login"])) {
   echo "<script>
          alert('Harap masuk sebagai Member atau Admin!');
          document.location.href = 'login.php';
          </script>";
        }
        
        session_unset();
        session_destroy();
        
echo "<script>
        alert('Sampai jumpa kembali!');
        document.location.href = 'index.php';
      </script>";
