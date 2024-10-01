<?php

namespace Repository;

use Config\Connection;
use PDO;
use PDOException;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::start();
    }

    // Mengambil semua pengguna atau berdasarkan parameter tertentu
    public function fetch(array $params = []): array
    {
        try {
            $sql = "SELECT * FROM pengguna";
            if (!empty($params)) {
                $clauses = [];
                foreach ($params as $key => $value) {
                    $clauses[] = "$key = :$key";
                }
                $sql .= " WHERE " . implode(" AND ", $clauses);
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    // Mengambil pengguna berdasarkan ID
    public function getById(string|int $id)
    {
        try {
            $sql = "SELECT * FROM pengguna WHERE pengguna_id = :pengguna_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pengguna_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    // Membuat pengguna baru
    public function create(array $data)
    {
        try {
            $sql = "INSERT INTO pengguna (username, password, email, nama_lengkap, telpon, alamat, role) VALUES (:username, :password, :email, :nama_lengkap, :telpon, :alamat, :role)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':nama_lengkap', $data['nama_lengkap'], PDO::PARAM_STR);
            $stmt->bindParam(':telpon', $data['telpon'], PDO::PARAM_STR);
            $stmt->bindParam(':alamat', $data['alamat'], PDO::PARAM_STR);
            $stmt->bindParam(':role', $data['role'], PDO::PARAM_STR);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Memperbarui pengguna berdasarkan ID
    public function update(string|int $id, array $data)
    {
        try {
            $sql = "UPDATE pengguna SET username = :username, password = :password, email = :email, nama_lengkap = :nama_lengkap, telpon = :telpon, alamat = :alamat, role = :role WHERE pengguna_id = :pengguna_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pengguna_id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':nama_lengkap', $data['nama_lengkap'], PDO::PARAM_STR);
            $stmt->bindParam(':telpon', $data['telpon'], PDO::PARAM_STR);
            $stmt->bindParam(':alamat', $data['alamat'], PDO::PARAM_STR);
            $stmt->bindParam(':role', $data['role'], PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Menghapus pengguna berdasarkan ID
    public function delete(string|int $id)
    {
        try {
            $sql = "DELETE FROM pengguna WHERE pengguna_id = :pengguna_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pengguna_id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}
