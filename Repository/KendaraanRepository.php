<?php

namespace Repository;

use Config\Connection;
use PDO;

class KendaraanRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::start();
    }

    public function fetch(array $params = []): array
    {
        $sql = "SELECT * FROM kendaraan";
        $conditions = [];
        $values = [];

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $conditions[] = "$key = :$key";
                $values[$key] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($values);

        return $stmt->fetchAll();
    }

    public function getById(string|int $id)
    {
        $sql = "SELECT * FROM kendaraan WHERE kendaraan_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO kendaraan (jenis, merek, stok, harga_perhari, gambar) VALUES (:jenis, :merek, :stok, :harga_perhari, :gambar)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'jenis' => $data['jenis'],
            'merek' => $data['merek'],
            'stok' => $data['stok'],
            'harga_perhari' => $data['harga_perhari'],
            'gambar' => $data['gambar'],
        ]);

        return $this->connection->lastInsertId();
    }

    public function update(string|int $id, array $data)
    {
        $sql = "UPDATE kendaraan SET jenis = :jenis, merek = :merek, stok = :stok, harga_perhari = :harga_perhari, gambar = :gambar WHERE kendaraan_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'jenis' => $data['jenis'],
            'merek' => $data['merek'],
            'stok' => $data['stok'],
            'harga_perhari' => $data['harga_perhari'],
            'gambar' => $data['gambar'],
        ]);

        return $stmt->rowCount();
    }

    public function delete(string|int $id)
    {
        $sql = "DELETE FROM kendaraan WHERE kendaraan_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount();
    }
}
