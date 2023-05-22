<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Engine.php');
include('classes/Game.php');
include('classes/Template.php');

$pengurus = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pengurus->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $pengurus->getGameById($id);
        $row = $pengurus->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['game_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['game_foto'] . '" class="img-thumbnail" alt="' . $row['game_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['game_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Genre</td>
                                    <td>:</td>
                                    <td>' . $row['game_genre'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tahun Release</td>
                                    <td>:</td>
                                    <td>' . $row['game_release'] . '</td>
                                </tr>
                                <tr>
                                    <td>Developer</td>
                                    <td>:</td>
                                    <td>' . $row['developer_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Engine</td>
                                    <td>:</td>
                                    <td>' . $row['engine_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="edit.php?id_edit=' . $row['game_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['game_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($pengurus->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$pengurus->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENGURUS', $data);
$detail->write();
