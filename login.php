<?php

include "./koneksidb.php";

session_start();
if(isset($_SESSION["email"])) {
  header("Location: readuser.php");
  exit();
}

if(isset($_POST["login"])) {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION["email"] = $row["email"];
    header("Location: readuser.php");
    exit();
  } else {
    $errorMsg = "wrong email or password! please try again.";
    echo $conn->error; // menampilkan error message dari koneksi database jika ada
  }
  
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-6">
          <?php if(isset($errorMsg)) { ?>
            <div class="alert alert-danger"><?php echo $errorMsg ?></div>
          <?php } ?>
          <div class="card">
            <div class="card-header">
              FORM LOGIN
            </div>
            <div class="card-body">
              <form method="post" action="">
                <div class="form-group">
                  <label for="email">EMAIL</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="password">PASSWORD</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="login">LOGIN</button>
                <button type="submit" class="btn btn-primary" name="login">LOG OUT</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>