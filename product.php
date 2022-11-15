<?php

session_start();
require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai Member atau Admin!');
          document.location.href = 'login.php';
      </script>";
}

$id = $_GET["id"];
$product = $db->query(
  "SELECT * FROM products
  WHERE id=$id"
);
$product = mysqli_fetch_array($product);

$login = $_SESSION["login"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/product.css?v=<?= time(); ?>">
  <link rel="shortcut icon" href="img/icons/logo.png" type="image/x-icon">

  <title> Products | Tarvita Cell </title>
</head>

<body>
  <div class="page-wrapper <?= $login; ?>">

    <?php include "header.php"; ?>

    <div class="main-content">

      <section class="wrapper">
        <div class="img" style="background-image: url('img/products/<?= $product["photo"]; ?>');"></div>
        <div class="desc">
          <table>

            <!-- nama -->
            <tr>
              <td colspan="3"><?= $product["name"]; ?></td>
            </tr>

            <!-- brand -->
            <tr>
              <td> Brand</td>
              <td><center>:</center></td>
              <td><?= ucfirst($product["brand"]); ?></td>
            </tr>

            <!-- harga -->
            <tr>
              <td>Price</td>
              <td><center>:</center></td>
              <td><?= $product["price"]; ?></td>
            </tr>
            
            <!-- color -->
            <tr>
              <td>Color</td>
              <td><center>:</center></td>
              <td><?= ucfirst($product["color"]); ?></td>
            </tr>

            <!-- memory -->
            <tr>
              <td>Memory</td>
              <td><center>:</center></td>
              <td><?= $product["internal"]."GB " . $product["ram"] . "GB RAM"; ?></td>
            </tr>

            <!-- battery -->
            <tr>
              <td>Battery</td>
              <td><center>:</center></td>
              <td><?= $product["battery"]." mAh"; ?></td>
            </tr>

            <!-- stock -->
            <tr>
              <td>Stock</td>
              <td><center>:</center></td>
              <td><?= $product["stock"]; ?></td>
            </tr>

            <!-- tanggal rilis -->
            <tr>
              <td>Date Released</td>
              <td><center>:</center></td>
              <td><?= date("d-m-Y", strtotime($product["date_released"])); ?></td>
            </tr>

            <?php if ($login == "member") { ?>
            <tr>
              <td><input type="number" name="jumlah" value="1" 
              min="1" max="<?= $product["stock"]; ?>" 
              class="form-input black <?= $login == "member" ? "white" : "black" ?>"
              style="width: 50px;"></td>
              <td><button type="submit" name="buy" class="btn <?= $login == "member" ? "black" : "white" ?>" onclick="comingSoon()">Buy Now</button></td>
              <td><button type="submit" name="cart" class="btn <?= $login == "member" ? "black" : "white" ?>" onclick="comingSoon()">Cart</button></td>
            </tr>
            <?php } ?>

          </table>
        </div>

      </section>



    </div>

    <?php include "footer.php"; ?>

    <script src="js/style.js"></script>

  </div>

</body>

</html>