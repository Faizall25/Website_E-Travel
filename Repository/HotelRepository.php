<?php

namespace Repository;

use Config\Connection;
use PDO;

class HotelRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::start();
    }

    public function fetch(array $params = []): array
    {
        $sql = "SELECT * FROM hotel";
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
        $sql = "SELECT * FROM hotel WHERE hotel_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO hotel (nama, rate, harga_permalam, deskripsi, gambar) VALUES (:nama, :rate, :harga_permalam, :deskripsi, :gambar)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'nama' => $data['nama'],
            'rate' => $data['rate'],
            'harga_permalam' => $data['harga_permalam'],
            'deskripsi' => $data['deskripsi'],
            'gambar' => $data['gambar'],
        ]);

        return $this->connection->lastInsertId();
    }

    public function update(string|int $id, array $data)
    {
        $sql = "UPDATE hotel SET nama = :nama, rate = :rate, harga_permalam = :harga_permalam, deskripsi = :deskripsi, gambar = :gambar WHERE hotel_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'nama' => $data['nama'],
            'rate' => $data['rate'],
            'harga_permalam' => $data['harga_permalam'],
            'deskripsi' => $data['deskripsi'],
            'gambar' => $data['gambar'],
        ]);

        return $stmt->rowCount();
    }

    public function delete(string|int $id)
    {
        $sql = "DELETE FROM hotel WHERE hotel_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount();
    }
}
