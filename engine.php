<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Engine.php');
include('classes/Template.php');

$jabatan = new Engine($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jabatan->open();
// cari jabatan
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $jabatan->searchEngine($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $jabatan->getEngine();
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        $result = $jabatan->addEngine($_POST);
        if ($result) {
            echo "<script>
                    alert('Data berhasil ditambah!');
                    document.location.href = 'engine.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal ditambah!');
                    document.location.href = 'engine.php';
                </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Engine';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Engine</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'jabatan';

while ($div = $jabatan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['engine_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="engine.php?id=' . $div['engine_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="engine.php?hapus=' . $div['engine_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($jabatan->updateEngine($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'engine.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'engine.php';
            </script>";
            }
        }

        // $jabatan->getJabatanById($id);
        // $row = $jabatan->getResult();

        // $dataUpdate = $row['jabatan_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        // $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($jabatan->deleteEngine($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'engine.php';
            </script>";
        } else {
            echo "<script>
                document.location.href = 'engine.php';
            </script>";
        }
    }
}
if (isset($_GET['id'])) {
    $jabatan->getEngineById($_GET['id']);
    $value = $jabatan->getResult();
    $data_form = '<form method="post" enctype="multipart/form-data">
<div class="mb-3 row">
    <label for="jabatan_nama class="col-sm-3 col-form-label">Engine</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="jabatan_nama" name="jabatan_nama" value="' . $value["engine_nama"] . '">
    </div>
</div>
<div class="card-footer text-end">
  <button type="submit" class="btn custom-btn text-white" name="submit">submit</button>
    <!-- <a href="#"><button type="button" class="btn btn-danger">Cancel</button></a> -->
</div>
</form>';
} else {

    $data_form = '<form method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
    <label for="jabatan_nama class="col-sm-3 col-form-label">Engine</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="jabatan_nama" name="jabatan_nama">
    </div>
    </div>
    <div class="card-footer text-end">
  <button type="submit" class="btn custom-btn text-white" name="submit">submit</button>
    <!-- <a href="#"><button type="button" class="btn btn-danger">Cancel</button></a> -->
    </div>
    </form>';
}


$jabatan->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('FORM', $data_form);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
