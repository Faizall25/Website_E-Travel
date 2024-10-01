<?php

class Pemesanan
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Method untuk membuat pemesanan baru
    public function createPemesanan($data)
    {
        $stmt = $this->db->prepare("INSERT INTO pemesanan (pengguna_id, paket_id, kendaraan_id, hotel_id, tgl_pemesanan, status) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['pengguna_id'], $data['paket_id'], $data['kendaraan_id'], $data['hotel_id'], $data['tgl_pemesanan'], $data['status']]);
    }

    // Method untuk mendapatkan semua pemesanan
    public function getAllPemesanan()
    {
        $stmt = $this->db->prepare("SELECT * FROM pemesanan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mendapatkan pemesanan berdasarkan ID
    public function getPemesananById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM pemesanan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk memperbarui status pemesanan berdasarkan ID
    public function updatePemesananStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE pemesanan SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    // Method untuk menghapus pemesanan berdasarkan ID
    public function deletePemesanan($id)
    {
        $stmt = $this->db->prepare("DELETE FROM pemesanan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
