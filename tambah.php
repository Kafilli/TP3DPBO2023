<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Engine.php');
include('classes/Developer.php');
include('classes/Template.php');
include('classes/Game.php');



$listPengurus = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$view = new Template('templates/skintambah.html');

$pengurus = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pengurus->open();
if (isset($_POST['submit'])) {
    $result = $pengurus->addData($_POST, $_FILES);

    if ($result) {
        echo "<script>
         alert('Data Added Succesfully');
         document.location.href = 'index.php';
         </script>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // handle result
}
$pengurus->close();

$divisi = new Developer($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$divisi->open();
$divisi->getDeveloper();
$listdivisi = null;

while ($row = $divisi->getResult()) {
    $listdivisi .= "<option value=" . $row['developer_id'] . ">" . $row["developer_nama"] . "</option>";
}
$divisi->close();


$jabatan = new Engine($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jabatan->open();
$jabatan->getEngine();
$listjabatan = null;

while ($row = $jabatan->getResult()) {
    $listjabatan .= "<option value=" . $row['engine_id'] . ">" . $row["engine_nama"] . "</option>";
}
$jabatan->close();

$data = '<form method="post" enctype="multipart/form-data">

<div class="mb-3 row">
    <label for="file" class="col-sm-2 col-form-label">Poster</label>
    <div class="col-sm-10">
        <input class="form-control" type="file" id="formFile" name="pengurus_foto">
    </div>
</div>

<div class="mb-3 row">
    <label for="nim" class="col-sm-2 col-form-label">Genre</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nim", name="pengurus_nim">
    </div>
</div>

<div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nama" name="pengurus_nama">
    </div>
</div>

<div class="mb-3 row">
    <label for="semester" class="col-sm-2 col-form-label">Tahun Release</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="semester" name="pengurus_semester">
    </div>
</div>

<div class="mb-3 row">
    <label for="divisi" class="col-sm-2 col-form-label">Developer</label>
    <div class="col-sm-10">
        <select class="form-select" name="divisi_id" id="divisi" required>
            <option selected>-- Pilih Developer --</option>' .
    $listdivisi . '
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label for="jabatan" class="col-sm-2 col-form-label">Engine</label>
    <div class="col-sm-10">
        <select class="form-select" name="jabatan_id" id="jabatan" required>
            <option selected>-- Pilih Engine --</option>' .
    $listjabatan . '
        </select>
    </div>
</div>
<div class="card-footer text-end">
    <button type="submit" class="btn btn-primary" name="submit">Tambah Data</button>
    <!-- <a href="#"><button type="button" class="btn btn-danger">Cancel</button></a> -->
</div>
</form>';

// $view->replace('DROPDOWN1', $listdivisi);
// $view->replace('DROPDOWN2', $listjabatan);
$view->replace('FORM_GAME', $data);


$view->write();
