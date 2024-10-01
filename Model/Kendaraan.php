<?php

class Kendaraan
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Method untuk membuat kendaraan baru
    public function createKendaraan($data)
    {
        $stmt = $this->db->prepare("INSERT INTO kendaraan (jenis, merek, deskripsi, stok, harga_perhari, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['jenis'], $data['merek'], $data['deskripsi'], $data['stok'], $data['harga_perhari'], $data['gambar']]);
    }

    // Method untuk mendapatkan semua kendaraan
    public function getAllKendaraans()
    {
        $stmt = $this->db->prepare("SELECT * FROM kendaraan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mendapatkan kendaraan berdasarkan ID
    public function getKendaraanById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM kendaraan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk memperbarui kendaraan berdasarkan ID
    public function updateKendaraan($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE kendaraan SET jenis = ?, merek = ?, deskripsi = ?, stok = ?, harga_perhari = ?, gambar = ? WHERE id = ?");
        return $stmt->execute([$data['jenis'], $data['merek'], $data['deskripsi'], $data['stok'], $data['harga_perhari'], $data['gambar'], $id]);
    }

    // Method untuk menghapus kendaraan berdasarkan ID
    public function deleteKendaraan($id)
    {
        $stmt = $this->db->prepare("DELETE FROM kendaraan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
