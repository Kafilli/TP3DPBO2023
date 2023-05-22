<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Engine.php');
include('classes/Game.php');
include('classes/Template.php');

// buat instance pengurus
$listPengurus = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listPengurus->open();
// tampilkan data pengurus
$listPengurus->getGameJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listPengurus->searchGame($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $listPengurus->getGameJoin();
}
if (isset($_POST['sort_by'])) {
    $sort_by = $_POST['sort_by'];
    $listPengurus->sorting($sort_by);

    // execute the query and display the results
}

$data = null;

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listPengurus->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail bg-red">
        <a href="detail.php?id=' . $row['game_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['game_foto'] . '" class="card-img-top" alt="' . $row['game_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['game_nama'] . '</p>
                <p class="card-text divisi-nama">' . $row['developer_nama'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['engine_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listPengurus->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PENGURUS', $data);
$home->write();

// CREATE TABLE IF NOT EXISTS jabatan (
//     jabatan_id INT(11) PRIMARY KEY AUTO_INCREMENT,
//     jabatan_nama VARCHAR(50)
//   );
  
//   CREATE TABLE IF NOT EXISTS divisi (
//     divisi_id INT(11) PRIMARY KEY AUTO_INCREMENT,
//     divisi_nama VARCHAR(100)
//   );
  
//   CREATE TABLE IF NOT EXISTS pengurus (
//     pengurus_id INT(11) PRIMARY KEY AUTO_INCREMENT,
//     pengurus_foto VARCHAR(255),
//     pengurus_nim VARCHAR(10),
//     pengurus_nama VARCHAR(100),
//     pengurus_semester INT(2),
//     divisi_id INT(11),
//     jabatan_id INT(11),
//     FOREIGN KEY (divisi_id) REFERENCES divisi(divisi_id),
//     FOREIGN KEY (jabatan_id) REFERENCES jabatan(jabatan_id)
//   );
