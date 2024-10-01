<?php

namespace Repository;

use Config\Connection;

class PemesananRepository
{
    public function __construct()
    {
        Connection::start();
    }
    public function fetch(array $params): array
    {
        // manggil database
        return [];
    }

    public function getById(string|int $id)
    {
        return [];
    }

    public function create(array $data)
    {
        return [];
    }

    public function update(string|int $id, array $data)
    {
        return [];
    }

    public function delete(string|int $id)
    {
        return [];
    }
}
