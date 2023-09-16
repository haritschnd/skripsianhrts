	<?php
	session_start();

	// Cek apakah pengguna belum login, jika belum, redirect ke halaman login
	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
		header("Location: login.php");
		exit;
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Aplikasi Data Mahasiswa - Halaman Mahasiswa</title>
	</head>
	<body>
		<div class="container">
			<center>
			<h1 class="mt-5">Selamat datang di halaman Mahasiswa</h1>
			<p>Ini adalah halaman yang hanya dapat diakses setelah login.</p>
			<a href="logout.php" class="btn btn-primary">Logout</a>
			</center>
		</div>
	</body>
	</html>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Aplikasi Data Mahasiswa</title>
	</head>
	<body>
		<h1>Aplikasi Data Mahasiswa</h1>

		<form action="" method="POST">
			<label>NIM:</label>
			<input type="text" name="nim" required><br>

			<label>Kode Program Studi:</label>
			<input type="text" name="kd_prodi" required><br>

			<label>Nama:</label>
			<input type="text" name="nama" required><br>

			<label>Tempat Lahir:</label>
			<input type="text" name="tempat_lahir" required><br>

			<label>Tanggal Lahir:</label>
			<input type="date" name="tanggal_lahir" required><br>

			<label>Jenis Kelamin:</label>
			<input type="text" name="jenis_kelamin" required><br>

			<label>Tanggal Masuk:</label>
			<input type="date" name="tgl_masuk" required><br>

			<label>Kode Status:</label>
			<input type="text" name="kd_status" required><br>

			<label>Agama:</label>
			<input type="text" name="agama" required><br>

			<label>Alamat:</label>
			<input type="text" name="alamat" required><br>

			<label>Telepon:</label>
			<input type="text" name="telepon" required><br>

			<!-- Tombol untuk menambah data -->
			<input type="submit" name="submit_tambah" value="Tambah">

			<!-- Tombol untuk mengedit data -->
			<input type="submit" name="submit_edit" value="Edit">

			<!-- Tombol untuk menghapus data -->
			<input type="submit" name="submit_hapus" value="Hapus">
		</form>

		<h2>Data Mahasiswa</h2>
		<?php
		// Buat koneksi ke database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pelatihan";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
			die("Koneksi gagal: " . mysqli_connect_error());
		}

		// Proses tambah data
		if (isset($_POST['submit_tambah'])) {
			$nim = $_POST['nim'];
			$kd_prodi = $_POST['kd_prodi'];
			$nama = $_POST['nama'];
			$tempat_lahir = $_POST['tempat_lahir'];
			$tanggal_lahir = $_POST['tanggal_lahir'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$tgl_masuk = $_POST['tgl_masuk'];
			$kd_status = $_POST['kd_status'];
			$agama = $_POST['agama']; // Retrieve the Agama field value
			$alamat = $_POST['alamat'];
			$telepon = $_POST['telepon'];

			// Perintah SQL untuk tambah data
			$sql = "INSERT INTO m_mahasiswa (nim_mhs, kd_prodi, nm_mhs, tempat_lhr_mhs, tgl_lhr_mhs, jenis_klmn_mhs, tgl_msk_mhs, kd_status_mhs, agama, alamat_mhs, tlp_mhs) VALUES ('$nim', '$kd_prodi', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$tgl_masuk', '$kd_status', '$agama', '$alamat', '$telepon')";

			if (mysqli_query($conn, $sql)) {
				echo "Data berhasil ditambahkan.";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		// Proses edit data
		if (isset($_POST['submit_edit'])) {
			$nim = $_POST['nim'];
			$kd_prodi = $_POST['kd_prodi'];
			$nama = $_POST['nama'];
			$tempat_lahir = $_POST['tempat_lahir'];
			$tanggal_lahir = $_POST['tanggal_lahir'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$tgl_masuk = $_POST['tgl_masuk'];
			$kd_status = $_POST['kd_status'];
			$agama = $_POST['agama']; // Retrieve the Agama field value
			$alamat = $_POST['alamat'];
			$telepon = $_POST['telepon'];

			// Perintah SQL untuk edit data
			$sql = "UPDATE m_mahasiswa SET kd_prodi='$kd_prodi', nm_mhs='$nama', tempat_lhr_mhs='$tempat_lahir', tgl_lhr_mhs='$tanggal_lahir', jenis_klmn_mhs='$jenis_kelamin', tgl_msk_mhs='$tgl_masuk', kd_status_mhs='$kd_status', agama='$agama', alamat_mhs='$alamat', tlp_mhs='$telepon' WHERE nim_mhs='$nim'";

			if (mysqli_query($conn, $sql)) {
				echo "Data berhasil diupdate.";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		// Proses hapus data
		if (isset($_POST['submit_hapus'])) {
			$nim = $_POST['nim'];

			// Perintah SQL untuk hapus data
			$sql = "DELETE FROM m_mahasiswa WHERE nim_mhs='$nim'";

			if (mysqli_query($conn, $sql)) {
				echo "Data berhasil dihapus.";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		// Perintah SQL untuk mengambil seluruh data mahasiswa
		$sql = "SELECT * FROM m_mahasiswa";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<table border='1'>";
			echo "<tr><th>NIM</th><th>Kode Program Studi</th><th>Nama</th><th>Tempat Lahir</th><th>Tanggal Lahir</th><th>Jenis Kelamin</th><th>Tanggal Masuk</th><th>Kode Status</th><th>Agama</th><th>Alamat</th><th>Telepon</th></tr>";

			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row['nim_mhs'] . "</td>";
				echo "<td>" . $row['kd_prodi'] . "</td>";
				echo "<td>" . $row['nm_mhs'] . "</td>";
				echo "<td>" . $row['tempat_lhr_mhs'] . "</td>";
				echo "<td>" . $row['tgl_lhr_mhs'] . "</td>";
				echo "<td>" . $row['jenis_klmn_mhs'] . "</td>";
				echo "<td>" . $row['tgl_msk_mhs'] . "</td>";
				echo "<td>" . $row['kd_status_mhs'] . "</td>";
				echo "<td>" . $row['agama'] . "</td>";
				echo "<td>" . $row['alamat_mhs'] . "</td>";
				echo "<td>" . $row['tlp_mhs'] . "</td>";
				echo "</tr>";
			}

			echo "</table>";
		} else {
			echo "Tidak ada data mahasiswa.";
		}

		mysqli_close($conn);
		?>
	</body>
	</html>
