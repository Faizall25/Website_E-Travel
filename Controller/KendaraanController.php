<?php

namespace Controller;

use Repository\KendaraanRepository;

class KendaraanController
{
    private $repo;

    public function __construct()
    {
        $this->repo = new KendaraanRepository();
    }

    public function index($params = null)
    {
        $kendaraan = $this->repo->fetch($params ?? []);
        return $kendaraan;
    }

    public function show($id)
    {
        $kendaraan = $this->repo->getById($id);
        return $kendaraan;
    }

    public function create($data)
    {
        $newKendaraanId = $this->repo->create($data);
        return $newKendaraanId;
    }

    public function update($id, $data)
    {
        $updatedRows = $this->repo->update($id, $data);
        return $updatedRows;
    }

    public function delete($id)
    {
        $deletedRows = $this->repo->delete($id);
        return $deletedRows;
    }
}
