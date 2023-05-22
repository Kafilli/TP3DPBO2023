<?php

class Engine extends DB
{
    function getEngine()
    {
        $query = "SELECT * FROM engine";
        return $this->execute($query);
    }

    function getEngineById($id)
    {
        $query = "SELECT * FROM engine WHERE engine_id=$id";
        return $this->execute($query);
    }

    function addEngine($data)
    {
        $nama = $data['jabatan_nama'];
        $query = "INSERT INTO engine VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateEngine($id, $data)
    {
        $nama = $data['jabatan_nama'];
        $query = "UPDATE engine SET engine_nama='$nama' WHERE engine_id=$id";
        return $this->executeAffected($query);
    }


    function deleteEngine($id)
    {
        $checkQuery = "SELECT COUNT(*) FROM game WHERE engine_id=$id";
        $count = $this->getResult2($checkQuery);
        if ($count > 0) {
            echo "<script>alert('Error: Data ini masih ada di dalam Game');</script>";
            return false;
        }
        $query = "DELETE FROM engine WHERE engine_id=$id";
        return $this->executeAffected($query);
    }
    function searchEngine($keyword)
    {
        $query = "SELECT * FROM engine WHERE engine_nama LIKE '%$keyword%' ORDER BY engine.engine_id";
        return $this->execute($query);
    }
}
