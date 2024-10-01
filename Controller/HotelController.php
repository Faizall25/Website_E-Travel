<?php

namespace Controller;

use Repository\HotelRepository;

class HotelController
{
    private HotelRepository $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function getAllHotel($params = null)
    {
        // Mengambil semua data hotel dari repository
        return $this->hotelRepository->fetch($params);
    }

    public function getHotelById($id)
    {
        // Mengambil data hotel berdasarkan id dari repository
        return $this->hotelRepository->getById($id);
    }

    public function createHotel($data)
    {
        // Membuat data hotel baru menggunakan repository
        return $this->hotelRepository->create($data);
    }

    public function updateHotel($id, $data)
    {
        // Memperbarui data hotel berdasarkan id menggunakan repository
        return $this->hotelRepository->update($id, $data);
    }

    public function deleteHotel($id)
    {
        // Menghapus data hotel berdasarkan id menggunakan repository
        return $this->hotelRepository->delete($id);
    }
}
