<?php

require_once 'config.php';

// Set header untuk response JSON
    header('Content-Type: application/json');

// Fungsi untuk menampilkan semua nilai mahasiswa
function getAllNilaiMahasiswa() {
    global $conn;
    $sql = "SELECT m.*, mk.*, p.* FROM perkuliahan p JOIN mahasiswa m ON p.nim = m.nim JOIN matakuliah mk ON p.kode_mk = mk.kode_mk";
    $result = $conn->query($sql);
    $nilai_mahasiswa = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nilai_mahasiswa[] = $row;
        }
    }
    echo json_encode($nilai_mahasiswa);
}

// Fungsi untuk menampilkan nilai mahasiswa berdasarkan NIM
function getNilaiMahasiswaByNIM($nim) {
    global $conn;
    $sql = "SELECT  m.*, mk.*, p.* FROM perkuliahan p JOIN mahasiswa m ON p.nim = m.nim JOIN matakuliah mk ON p.kode_mk = mk.kode_mk WHERE m.nim = '$nim'";
    $result = $conn->query($sql);
    $nilai_mahasiswa = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nilai_mahasiswa[] = $row;
        }
    }
    echo json_encode($nilai_mahasiswa);
}

// Fungsi untuk memasukkan nilai baru untuk mahasiswa tertentu
function insertNilaiMahasiswa($nim, $kode_mk, $nilai) {
    global $conn;
    $sql = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', $nilai)";

    $inserted_data = array(
        "nim" => $nim,
        "kode_mk" => $kode_mk,
        "nilai" => $nilai
    );
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array(
            "message" => "Nilai berhasil dimasukkan",
            "data" => $inserted_data
        )
    );
    } else {
        echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

// Fungsi untuk mengupdate nilai berdasarkan NIM dan kode_mk
function updateNilaiMahasiswa($nim, $kode_mk, $nilai) {
    global $conn;
    $sql = "UPDATE perkuliahan SET nilai = $nilai WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
    $updated_data = array(
        "nim" => $nim,
        "kode_mk" => $kode_mk,
        "nilai" => $nilai
    );
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array(
            "message" => "Nilai berhasil di update",
            "data" => $updated_data
        )
    );
    } else {
        echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

// Fungsi untuk menghapus nilai berdasarkan NIM dan kode_mk
function deleteNilaiMahasiswa($nim, $kode_mk) {
    global $conn;
    $sql = "DELETE FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Nilai berhasil dihapus"));
    } else {
        echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

// Router untuk menentukan endpoint dan method HTTP
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['nim'])){
        getNilaiMahasiswaByNIM($_GET['nim']);
    }
    else{
        getAllNilaiMahasiswa();
    }
} 
// Endpoint untuk memasukkan nilai baru untuk mahasiswa tertentu
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if(isset($data['nim']) && isset($data['kode_mk']) && isset($data['nilai'])){
        $nim = $data['nim'];
        $kode_mk = $data['kode_mk'];
        $nilai = $data['nilai'];
        insertNilaiMahasiswa($nim, $kode_mk, $nilai);
    }
    else{
        http_response_code(400);
        echo json_encode(array("message" => "Membutuhkan input nim, kode_mk, dan nilai"));
    }
} 
// Endpoint untuk mengupdate nilai mahasiswa berdasarkan NIM dan kode_mk
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    if(isset($_GET['nim']) && isset($_GET['kode_mk'])){
        $nim = $_GET['nim'];
        $kode_mk = $_GET['kode_mk'];
        if(isset($data['nilai'])){
            $nilai = $data['nilai'];
            updateNilaiMahasiswa($nim, $kode_mk, $nilai);
        }
        else{
            http_response_code(400);
            echo json_encode(array("message" => "Membutuhkan input nilai"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message" => "Membutuhkan parameter nim dan kode_mk"));
    }
} 
// Endpoint untuk menghapus nilai berdasarkan NIM dan kode_mk
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if(isset($_GET['nim']) && isset($_GET['kode_mk'])){
        $nim = $_GET['nim'];
        $kode_mk = $_GET['kode_mk'];
        deleteNilaiMahasiswa($nim, $kode_mk);
    }
    else{
        http_response_code(400);
        echo json_encode(array("message" => "Membutuhkan parameter nim dan kode_mk"));
    }
}

// Tutup koneksi database
$conn->close();

?>
