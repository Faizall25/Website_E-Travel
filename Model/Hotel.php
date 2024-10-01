<?php

class Hotel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Method untuk membuat hotel baru
    public function createHotel($data)
    {
        $stmt = $this->db->prepare("INSERT INTO hotel (paket_id, nama, rate, harga_permalam, deskripsi, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['paket_id'], $data['nama'], $data['rate'], $data['harga_permalam'], $data['deskripsi'], $data['gambar']]);
    }

    // Method untuk mendapatkan semua hotel
    public function getAllHotel()
    {
        $stmt = $this->db->prepare("SELECT * FROM hotel");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mendapatkan hotel berdasarkan ID
    public function getHotelById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM hotel WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk memperbarui hotel berdasarkan ID
    public function updateHotel($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE hotel SET paket_id = ?, nama = ?, rate = ?, harga_permalam = ?, deskripsi = ?, gambar = ? WHERE id = ?");
        return $stmt->execute([$data['paket_id'], $data['nama'], $data['rate'], $data['harga_permalam'], $data['deskripsi'], $data['gambar'], $id]);
    }

    // Method untuk menghapus hotel berdasarkan ID
    public function deleteHotel($id)
    {
        $stmt = $this->db->prepare("DELETE FROM hotel WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
