<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; 
$password = "denpasar"; 
$dbname = "db_registrasi"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani data form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL untuk memasukkan data
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Tampilkan pesan sukses dengan background gambar
        echo '
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Pendaftaran Berhasil</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-image: url(\'perpustakaan.jpg\');
                    background-size: cover;
                    background-position: center;
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-family: Arial, sans-serif;
                }
                .message-box {
                    background-color: rgba(255, 255, 255, 0.85);
                    padding: 40px;
                    border-radius: 10px;
                    text-align: center;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                }
                h2 {
                    color: #28a745;
                    margin-bottom: 15px;
                }
                p {
                    color: #333;
                    font-size: 18px;
                    margin: 0;
                }
            </style>
        </head>
        <body>
            <div class="message-box">
                <h2>Pendaftaran Berhasil!</h2>
                <p>Selamat, akun Anda telah berhasil dibuat.</p>
            </div>
        </body>
        </html>
        ';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
