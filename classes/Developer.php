<?php

class Developer extends DB
{
    function getDeveloper()
    {
        $query = "SELECT * FROM developer";
        return $this->execute($query);
    }

    function getDeveloperById($id)
    {
        $query = "SELECT * FROM developer WHERE developer_id=$id";
        return $this->execute($query);
    }

    function addDeveloper($data)
    {
        $nama = $data['divisi_nama'];
        $query = "INSERT INTO developer VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateDeveloper($id, $data)
    {
        $nama = $data['divisi_nama'];
        $query = "UPDATE developer SET developer_nama = '$nama' where developer_id = $id ";
        return $this->executeAffected($query);
    }

    function deleteDeveloper($id)
    {
        $checkQuery = "SELECT COUNT(*) FROM game WHERE developer_id=$id";
        $count = $this->getResult2($checkQuery);
        if ($count > 0) {
            echo "<script>alert('Error: Data ini masih ada di dalam Game');</script>";
            return false;
        }
        $query = "DELETE FROM developer WHERE developer_id=$id";
        return $this->executeAffected($query);
    }
    function searchDeveloper($keyword)
    {
        $query = "SELECT * FROM developer WHERE developer_nama LIKE '%$keyword%' ORDER BY developer.developer_id";
        return $this->execute($query);
    }
}
