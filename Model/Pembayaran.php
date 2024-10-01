<?php

class Pembayaran
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createPembayaran($data)
    {
        $stmt = $this->db->prepare("INSERT INTO pembayaran (pemesanan_id, jumlah_bayar, tgl_bayar, bukti_file, status) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['pemesanan_id'], $data['jumlah_bayar'], $data['tgl_bayar'], $data['bukti_file'], $data['status']]);
    }

    public function getAllPembayarans()
    {
        $stmt = $this->db->prepare("SELECT * FROM pembayaran");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metode lain sesuai kebutuhan
}
