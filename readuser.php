<!DOCTYPE html>
<?php
//koneksi ke database
include "./koneksidb.php";

//query untuk menampilkan data dari tabel users
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

//menampilkan data ke dalam tabel
if(mysqli_num_rows($result) > 0){
  $rows = array();
  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
} else {
  $rows = null;
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>ANISSA'S ASSIGNMENT 5</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"></head>
<body>
<div class="container">
	<h1 class="text-center my-5">DATA USERS</h1>

	<?php if($rows): ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>ACTION</th>
					<th>AVATAR</th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>PHONE</th>
					<th>ROLE</th>
				</tr>
			</thead>
			<tbody>
			<a href="./create.php" class="btn btn-primary">INPUT USERr</a>
				<?php $no = 1; foreach($rows as $row): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="./detail.php" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fas fa-eye" ></i></a>
							<a href="./update.php" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
							<a href="./delete.php" class="btn btn-danger btn-sm delete-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
						</td>
						<td><img src= "./0d9c9626bf4e24612c90465fbaa243a0.jpg" width='50'></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phone']; ?></td>
						<td><?php echo $row['role']; ?></td>
					</tr>
                    <?php $no++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p class = "text-center;">Kosong</p>
	<?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>

<script>
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>

</html>