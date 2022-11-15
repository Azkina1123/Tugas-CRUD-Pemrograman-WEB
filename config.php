<?php

$db = new mysqli("localhost", "root", "", "tarvita_cell");

if (!$db) {
  die("Gagal terhubung! " . $db->connect_error);
}

date_default_timezone_set("Asia/Singapore");


function signing_up() {
  global $db;

  $username = $_POST["username"];
  $password = $_POST["password"];
  $konfirmasi = $_POST["konfirmasi"];
  $address = $_POST["address"];

  // cek apakah username sudah digunakan
  $result = $db->query(
    "SELECT username FROM users
     WHERE username='$username'"
  );

  // jika username sudah ada
  if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('Username telah digunakan!');
          </script>";
    return false;
  }

  // jika password != konfirmasi
  if ($password != $konfirmasi) {
    echo "<script>
            alert('Konfirmasi password salah!');
          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan akun baru ke database
  $result = $db->query(
    "INSERT INTO users
     VALUES ('$username', '$password', '$address')"
  );

  // jika gagal masuk ke database
  if (!$result) {
    echo "<script>
      alert('Proses registrasi gagal!');
    </script>";
    return false;
  }

  // jika berhasil masuk ke database
  echo "<script>
          alert('Proses registrasi berhasil!');
        </script>";
  return true;
}

function logging_in() {
  global $db;

  $username = $_POST["username"];
  $password = $_POST["password"];

  // cari akun di database
  $result = $db->query(
    "SELECT * FROM users
     WHERE username='$username'"
  );

  // jika akun tidak ditemukan
  if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Username tidak terdaftar!');
          </script>";
    return false;
  }

  $akun = mysqli_fetch_array($result);

  // jika password salah
  if (!password_verify($password, $akun["pw"])) {
    echo "<script>
            alert('Password yang Anda masukkan salah!');
          </script>";
    return false;
  }

  echo "<script>
          alert('Proses masuk berhasil!');
        </script>";
  return true;

}

function add_product() {
  global $db;

  $date = $_POST["date"];
  $name = $_POST["name"];
  $price = $_POST["price"];
  $brand = $_POST["brand"];
  $stock = $_POST["stock"];
  $color = $_POST["color"];
  $internal = $_POST["internal"];
  $ram = $_POST["ram"];
  $battery = $_POST["battery"];

  $id_baru = get_new_id();
  $image = $id_baru.".png";


  // tidak upload gambar
  if ($_FILES["image"]["error"] === 4) {
    copy("img/icons/product.png", "img/products/$image");

  // upload gambar
  } else {
    if ($_FILES["image"]["size"] > 200000) {
      echo "<script>
              alert('Ukuran gambar maksimal 200 KB!');
          </script>";
      return false;
    }

    // ambil ekstensi
    $img_name = $_FILES['image']['name'];
    $pisah_titik = explode('.', $img_name);
    $ekstensi = strtolower(end($pisah_titik));

    // buat nama file
    $image = "$id_baru.$ekstensi"; // agar tidak ada nama file yang sama

    // pindahkan ke direktori img/products
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "img/products/" . $image);

  }

  // simpan ke db
  $result = $db->query(
    "INSERT INTO products
    VALUES (
      $id_baru,
      '$date',
      '$name',
      $price,
      '$brand',
      $stock,
      '$color',
      $internal,
      $ram,
      $battery,
      '$image'
    )"
  );

  // jika gagal disimpan ke db
  if (!$result) {
    echo "<script>
           alert('Produk gagal ditambahkan');
          </script>";
    return false;
  }
  
  // jika berhasil simpan ke db
  echo "<script>
          alert('Produk berhasil ditambahkan');
          
        </script>";

  return true;
  
}

function edit_product() {
  global $db;

  $id = $_POST["id"];
  $date = $_POST["date"];
  $name = $_POST["name"];
  $price = $_POST["price"];
  $brand = $_POST["brand"];
  $stock = $_POST["stock"];
  $color = $_POST["color"];
  $internal = $_POST["internal"];
  $ram = $_POST["ram"];
  $battery = $_POST["battery"];

  $image = $_POST["old_image"];


  // upload gambar
  if ($_FILES["image"]["error"] !== 4) {

    if ($_FILES["image"]["size"] > 200000) {
      echo "<script>
              alert('Ukuran gambar maksimal 200 KB!');
          </script>";
      return false;
    }

    // hapus gambar lama
    unlink("img/products/$image");

    // ambil ekstensi
    $img_name = $_FILES['image']['name'];
    $pisah_titik = explode('.', $img_name);
    $ekstensi = strtolower(end($pisah_titik));

    // buat nama file
    $image = "$id.$ekstensi"; // agar tidak ada nama file yang sama

    // pindahkan ke direktori img/products
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "img/products/" . $image);
  }

  // simpan ke db
  $result = $db->query(
    "UPDATE products
    SET name = '$name',
        price = $price,
        brand = '$brand',
        stock = $stock,
        color = '$color', 
        internal = $internal,
        ram = $ram,
        battery = $battery,
        photo = '$image'
    WHERE id=$id"
  );

  // jika gagal disimpan ke db
  if (!$result) {
    echo "
    <script>
      alert('Produk gagal diubah');
    </script>";
  }

  // jika berhasil simpan ke db
  echo "
      <script>
          alert('Produk berhasil diubah');
      </script>";


  return true;

}

function delete_product() {
  global $db;
  $id = $_GET["id"];

  $old_img = $db->query(
    "SELECT photo FROM products
    WHERE id=$id"
  );

  // hapus gambar lama
  $old_img = mysqli_fetch_array($old_img)[0];
  unlink("img/products/$old_img");

  $result = $db->query(
    "DELETE FROM products
    WHERE id=$id"
  );

  if (!$result) {
    echo "<script>
           alert('Produk gagal dihapus!');
          </script>";
    return false;
  }

  echo "<script>
         alert('Produk berhasil dihapus!');
        </script>";
  return true;
}


/* ===================== TAMBAHAN =====================*/

function get_new_id() {
  global $db;
  $ids = $db->query("SELECT id FROM products");
  $index = mysqli_num_rows($ids) - 1;
  $id_arr = [];

  while ($id = mysqli_fetch_array($ids)) {
    $id_arr[] = $id;
  }

  $id_terakhir = $id_arr[$index]["id"];
  $id_baru = (int)$id_terakhir + 1;

  return $id_baru;
}

?>