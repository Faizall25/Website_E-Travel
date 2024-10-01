<?php

class Paket
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Method untuk membuat paket wisata baru
    public function createPaket($data)
    {
        $stmt = $this->db->prepare("INSERT INTO paket_wisata (kendaraan_id, hotel_id, pengguna_id, nama_paket, deskripsi, harga, tgl_berangkat, tgl_pulang, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['kendaraan_id'], $data['hotel_id'], $data['pengguna_id'], $data['nama_paket'], $data['deskripsi'], $data['harga'], $data['tgl_berangkat'], $data['tgl_pulang'], $data['gambar']]);
    }

    // Method untuk mendapatkan semua paket wisata
    public function getAllPaket()
    {
        $stmt = $this->db->prepare("SELECT * FROM paket_wisata");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mendapatkan paket wisata berdasarkan ID
    public function getPaketById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM paket_wisata WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk memperbarui paket wisata berdasarkan ID
    public function updatePaket($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE paket_wisata SET kendaraan_id = ?, hotel_id = ?, pengguna_id = ?, nama_paket = ?, deskripsi = ?, harga = ?, tgl_berangkat = ?, tgl_pulang = ?, gambar = ? WHERE id = ?");
        return $stmt->execute([$data['kendaraan_id'], $data['hotel_id'], $data['pengguna_id'], $data['nama_paket'], $data['deskripsi'], $data['harga'], $data['tgl_berangkat'], $data['tgl_pulang'], $data['gambar'], $id]);
    }

    // Method untuk menghapus paket wisata berdasarkan ID
    public function deletePaket($id)
    {
        $stmt = $this->db->prepare("DELETE FROM paket_wisata WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
