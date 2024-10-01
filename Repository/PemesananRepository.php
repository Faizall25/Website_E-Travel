<?php

namespace Repository;

use Config\Connection;
use PDO;
use PDOException;

class PemesananRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::start();
    }

    public function fetch(array $params): array
    {
        try {
            $sql = "SELECT * FROM pemesanan";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function getById(string|int $id): array
    {
        try {
            $sql = "SELECT * FROM pemesanan WHERE pemesanan_id = :pemesanan_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pemesanan_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function create(array $data)
    {
        try {
            $sql = "INSERT INTO pemesanan (pengguna_id, paket_id, kendaraan_id, hotel_id, tgl_pemesanan, status) VALUES (:pengguna_id, :paket_id, :kendaraan_id, :hotel_id, :tgl_pemesanan, :status)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pengguna_id', $data['pengguna_id'], PDO::PARAM_INT);
            $stmt->bindParam(':paket_id', $data['paket_id'], PDO::PARAM_INT);
            $stmt->bindParam(':kendaraan_id', $data['kendaraan_id'], PDO::PARAM_INT);
            $stmt->bindParam(':hotel_id', $data['hotel_id'], PDO::PARAM_INT);
            $stmt->bindParam(':tgl_pemesanan', $data['tgl_pemesanan']);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function update(string|int $id, array $data)
    {
        try {
            $sql = "UPDATE pemesanan SET pengguna_id = :pengguna_id, paket_id = :paket_id, kendaraan_id = :kendaraan_id, hotel_id = :hotel_id, tgl_pemesanan = :tgl_pemesanan, status = :status WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':pengguna_id', $data['pengguna_id'], PDO::PARAM_INT);
            $stmt->bindParam(':paket_id', $data['paket_id'], PDO::PARAM_INT);
            $stmt->bindParam(':kendaraan_id', $data['kendaraan_id'], PDO::PARAM_INT);
            $stmt->bindParam(':hotel_id', $data['hotel_id'], PDO::PARAM_INT);
            $stmt->bindParam(':tgl_pemesanan', $data['tgl_pemesanan']);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function delete(string|int $id)
    {
        try {
            $sql = "DELETE FROM pemesanan WHERE pemesanan_id = :pemesanan_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pemesanan_id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE pemesanan SET status = :status WHERE id = :id");
        return $stmt->execute(['id' => $id, 'status' => $status]);
    }
}
