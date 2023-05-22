<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Engine.php');
include('classes/Developer.php');
include('classes/Template.php');
include('classes/Game.php');

$view = new Template('templates/skintambah.html');
$pengurus = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pengurus->open();

$id_edit = $_GET['id_edit'];

if (isset($_POST['submit'])) {

    $result = $pengurus->updateData($id_edit, $_POST, $_FILES);

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

$pengurus->getGameById($id_edit);

$editData = $pengurus->getResult();


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
    <label for="file" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
        <input class="form-control" type="file" id="formFile" name="pengurus_foto" required>
    </div>
</div>

<div class="mb-3 row">
    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nim", name="pengurus_nim"  value="' . $editData['game_genre'] . '">
    </div>
</div>

<div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nama" name="pengurus_nama" value="' . $editData['game_nama'] . '">
    </div>
</div>

<div class="mb-3 row">
    <label for="semester" class="col-sm-2 col-form-label">Semester</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="semester" name="pengurus_semester"  value="' . $editData['game_release'] . '">
    </div>
</div>

<div class="mb-3 row">
    <label for="divisi" class="col-sm-2 col-form-label">Developer</label>
    <div class="col-sm-10">
        <select class="form-select" name="divisi_id" id="divisi_id" required>
            <option selected>' . $editData['developer_id'] . ">" . $editData["developer_nama"] . '</option>' .
    $listdivisi . '
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
    <div class="col-sm-10">
        <select class="form-select" name="jabatan_id" id="jabatan_id" required>
            <option selected>' . $editData['engine_id'] . ">" . $editData["engine_nama"] . '</option>' .
    $listjabatan . '
        </select>
    </div>
</div>
<div class="card-footer text-end">
    <button type="submit" class="btn btn-primary" name="submit">Ubah Data</button>
    <!-- <a href="#"><button type="button" class="btn btn-danger">Cancel</button></a> -->
</div>
</form>';

$view = new Template('templates/skintambah.html');

$view->replace('FORM_GAME', $data);


$view->write();
