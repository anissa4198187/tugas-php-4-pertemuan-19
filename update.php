<?php
include "./koneksidb.php";

if(isset($_POST['submit'])) {
  // Ambil data dari form
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $password = $_POST['password'];

  // Upload file avatar
  $avatar = $_FILES['avatar']['name'];
  if($avatar != "") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($avatar);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Periksa apakah file gambar adalah gambar asli atau gambar palsu
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["avatar"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $uploadOk = 0;
      }
    }

    // Periksa apakah avatar tersebut sudah ada / sama
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Periksa ukuran avatar
    if ($_FILES["avatar"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Membatasi extensi file yang bisa di upload
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Memeriksa jika $uploadOk diatur menjadi 0 karna eror atau bukan
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // jika kondisi sudah terpenuhi lalu mengunggah file gambar
    } else {
      if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
        // Update data ke dalam tabel users
        $sql = "UPDATE users SET name='$name', email='$email', role='$role', phone='$phone', address='$address', password='$password', avatar='$avatar' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
          echo "Data berhasil diupdate.";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  } else {
    // Update data ke dalam tabel users tanpa mengubah avatar
    $sql = "UPDATE users SET name='$name', email='$email', role='$role', phone='$phone', address='$address', password='$password' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
      echo "Data berhasil diupdate.";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    } else {
      echo "Data tidak ditemukan";
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>edit data user</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h1>edit data user</h1>
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
      <div class="form-group">
        <label for="name">name:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" required>
      </div>
      <div class="form-group">
        <label for="email">email:</label>
        <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" required>
      </div>
      <div class="form-group">
        <label for="role">role:</label>
        <select class="form-control" name="role">
          <option value="admin" <?php if($row['role'] == 'admin') echo 'selected' ?>>Admin</option>
          <option value="user" <?php if($row['role'] == 'user') echo 'selected' ?>>User</option>
        </select>
      </div>
      <div class="form-group">
        <label for="phone">phone number:</label>
        <input type="tel" class="form-control" name="phone" value="<?php echo $row['phone'] ?>" required>
      </div>
      <div class="form-group">
        <label for="address">address:</label>
        <textarea class="form-control" name="address" required><?php echo $row['address'] ?></textarea>
      </div>
      <div class="form-group">
        <label for="password">password:</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <div class="form-group">
        <label for="avatar">avatar:</label>
        <input type="file" class="form-control-file" name="avatar">
      </div>
      <div class="form-group">
        <img src="uploads/<?php echo $row['avatar'] ?>" class="img-thumbnail" width="150px">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">update</button>
      <br><br>
    </form>
  </div>
</body>
</html>


