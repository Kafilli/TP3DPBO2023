<?php

class Game extends DB
{
    function getGameJoin()
    {
        $query = "SELECT * FROM game JOIN developer ON game.developer_id=developer.developer_id JOIN engine ON game.engine_id=engine.engine_id ORDER BY game.game_id";

        return $this->execute($query);
    }

    function getGame()
    {
        $query = "SELECT * FROM game";
        return $this->execute($query);
    }

    function getGameById($id)
    {
        $query = "SELECT * FROM game JOIN developer ON game.developer_id=developer.developer_id JOIN engine ON game.engine_id=engine.engine_id WHERE game_id=$id";
        return $this->execute($query);
    }

    function searchGame($keyword)
    {
        $query = "SELECT * FROM game JOIN developer ON game.developer_id=developer.developer_id JOIN engine ON game.engine_id=engine.engine_id WHERE game_nama LIKE '%$keyword%' OR engine_nama LIKE '%$keyword%' OR developer_nama LIKE '%$keyword%' ORDER BY game.game_id";
        return $this->execute($query);
    }


    function addData($data, $file)
    {
        $pengurus_foto = $file['pengurus_foto']['name'];
        $pengurus_nim = $data['pengurus_nim'];
        $pengurus_nama = $data['pengurus_nama'];
        $pengurus_semester = $data['pengurus_semester'];
        $divisi_id = $data['divisi_id'];
        $jabatan_id = $data['jabatan_id'];

        $fotoupload = $file['pengurus_foto']['tmp_name'];

        // move_uploaded_file($file['pengurus_foto']['name'], 'assets\images' . $file['pengurus_foto']['name']);
        $uploadDirectory = "assets/images/$pengurus_foto";
        // $uploadFilePath = $uploadDirectory;
        move_uploaded_file($fotoupload, $uploadDirectory);

        // $query = "INSERT INTO pengurus ('', pengurus_id, pengurus_foto, pengurus_nim, pengurus_nama, pengurus_semester, divisi_id, jabatan_id) VALUES ('', '$pengurus_foto', '$pengurus_nim', '$pengurus_nama', '$pengurus_semester', '$divisi_id', '$jabatan_id')";
        $query = "INSERT INTO game VALUES ('', '$pengurus_foto', '$pengurus_nim', '$pengurus_nama', '$pengurus_semester', '$divisi_id', '$jabatan_id')";

        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $pengurus_foto = $file['pengurus_foto']['name'];
        $pengurus_nim = $data['pengurus_nim'];
        $pengurus_nama = $data['pengurus_nama'];
        $pengurus_semester = $data['pengurus_semester'];
        $divisi_id = $data['divisi_id'];
        $jabatan_id = $data['jabatan_id'];

        $fotoupload = $file['pengurus_foto']['tmp_name'];
        $uploadDirectory = "assets/images/$pengurus_foto";
        move_uploaded_file($fotoupload, $uploadDirectory);

        $query = "UPDATE game SET game_foto = '$pengurus_foto', game_genre = '$pengurus_nim', game_nama = '$pengurus_nama', game_release = '$pengurus_semester', developer_id = '$divisi_id', engine_id = '$jabatan_id' WHERE game_id = $id";
        // $query = "INSERT INTO pengurus VALUES ('', '$pengurus_foto', '$pengurus_nim', '$pengurus_nama', '$pengurus_semester', '$divisi_id', '$jabatan_id')";

        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM game WHERE game_id=$id";
        return $this->executeAffected($query);
    }

    function sorting($sort)
    {
        $query = "SELECT * FROM game
              JOIN developer ON game.developer_id=developer.developer_id
              JOIN engine ON game.engine_id=engine.engine_id
              ORDER BY $sort";
        return $this->execute($query);
    }
}
