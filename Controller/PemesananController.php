<?php
// controller/PemesananController.php
namespace Controller;

use Repository\PemesananRepository;
use Repository\HotelRepository;
use Repository\KendaraanRepository;
use Repository\PaketRepository;

class PemesananController
{
    private $pemesananRepository;
    private $hotelRepository;
    private $kendaraanRepository;
    private $paketRepository;

    public function __construct()
    {
        $this->pemesananRepository = new PemesananRepository();
        $this->hotelRepository = new HotelRepository();
        $this->kendaraanRepository = new KendaraanRepository();
        $this->paketRepository = new PaketRepository();
    }

    // Menampilkan daftar semua pemesanan
    public function index(array $params = null)
    {
        $pemesanan = $this->pemesananRepository->fetch([]);
        return $pemesanan;
    }

    // Menampilkan formulir untuk membuat pemesanan baru dan memprosesnya
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'pengguna_id' => $_POST['pengguna_id'],
                'paket_id' => $_POST['paket_id'],
                'kendaraan_id' => $_POST['kendaraan_id'],
                'hotel_id' => $_POST['hotel_id'],
                'tgl_pemesanan' => date('Y-m-d H:i:s'),
                'status' => 'pending'
            ];
            $this->pemesananRepository->create($data);
            header('Location: index.php?controller=booking&action=index');
        } else {
            $paket = $this->paketRepository->fetch([]);
            $kendaraan = $this->kendaraanRepository->fetch([]);
            $hotel = $this->hotelRepository->fetch([]);
            include 'views/booking/create.php';
        }
    }

    // Menampilkan detail pemesanan tertentu berdasarkan ID
    public function view($id)
    {
        $pemesanan = $this->pemesananRepository->getById($id);
        include 'views/booking/view.php';
    }

    // Menampilkan formulir untuk mengedit pemesanan yang sudah ada dan memprosesnya
    public function update($id, $data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'pengguna_id' => $_POST['pengguna_id'],
                'paket_id' => $_POST['paket_id'],
                'kendaraan_id' => $_POST['kendaraan_id'],
                'hotel_id' => $_POST['hotel_id'],
                'status' => $_POST['status']
            ];
            $this->pemesananRepository->update($id, $data);
            header('Location: index.php?controller=booking&action=index');
        } else {
            $pemesanan = $this->pemesananRepository->getById($id);
            $paket = $this->paketRepository->fetch([]);
            $kendaraan = $this->kendaraanRepository->fetch([]);
            $hotel = $this->hotelRepository->fetch([]);
            include 'views/booking/edit.php';
        }
    }

    // Menghapus pemesanan tertentu berdasarkan ID
    public function delete($id)
    {
        $this->pemesananRepository->delete($id);
        header('Location: index.php?controller=booking&action=index');
    }

    // Memperbarui status pemesanan
    public function updateStatus($id, $status)
    {
        $this->pemesananRepository->updateStatus($id, $status);
        header('Location: index.php?controller=booking&action=index');
    }
}
