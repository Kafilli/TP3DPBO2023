<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Template.php');

$divisi = new Developer($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$divisi->open();
// cari divisi
$view = new Template('templates/skintabel.html');
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $divisi->searchDeveloper($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $divisi->getDeveloper();
}

if (!isset($_GET['edit'])) {
    if (isset($_POST['submit'])) {
        $result = $divisi->addDeveloper($_POST);
        if ($result) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'developer.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'developer.php';
            </script>";
        }
    }
}


$btn = 'Tambah';
$title = 'Tambah';



$mainTitle = 'Developer';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Developer</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'divisi';

while ($div = $divisi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['developer_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="developer.php?edit=' . $div['developer_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="developer.php?hapus=' . $div['developer_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($divisi->updateDeveloper($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'developer.php';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'developer.php';
            </script>";
            }
        }

        // $divisi->getDivisiById($id);
        // $row = $divisi->getResult();

        // $dataUpdate = $row['divisi_nama'];
        // $btn = 'Simpan';
        // $title = 'Ubah';


    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($divisi->deleteDeveloper($id) > 0) {
            echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'developer.php';
            </script>";
        } else {
            echo "<script>
            document.location.href = 'developer.php';
            </script>";
        }
    }
}
if (isset($_GET['edit'])) {
    $divisi->getDeveloperById($_GET['edit']);
    $value = $divisi->getResult();
    $data_form = '<form method="post" enctype="multipart/form-data">
<div class="mb-3 row">
    <label for="divisi_nama class="col-sm-3 col-form-label">Developer</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="divisi_nama" name="divisi_nama" value="' . $value["developer_nama"] . '">
    </div>
</div>
<div class="card-footer text-end">
    <button type="submit" class="btn custom-btn text-white" name="submit">submit</button>
    <!-- <a href="#"><button type="button" class="btn custom-btn">Cancel</button></a> -->
</div>
</form>';
} else {

    $data_form = '<form method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
    <label for="divisi_nama class="col-sm-3 col-form-label">Developer</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="divisi_nama" name="divisi_nama">
    </div>
    </div>
    <div class="card-footer text-end">
    <button type="submit" class="btn custom-btn text-white" name="submit">submit</button>
    <!-- <a href="#"><button type="button" class="btn custom-btn">Cancel</button></a> -->
    </div>
    </form>';
}



$divisi->close();
$view->replace('FORM', $data_form);

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
