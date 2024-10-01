<?php

// require_once '../repository/PemesananRepository.php';
// require_once '../repository/HotelRepository.php';
// require_once '../repository/KendaraanRepository.php';
// require_once '../repository/PaketRepository.php';

use Controller\PemesananController; // Sesuaikan dengan namespace yang benar

$controller = new PemesananController();
$datas = $controller->index();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bookings</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Bookings</h1>
        <a href="index.php?controller=booking&action=create" class="btn btn-success mb-3">Create New Booking</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Package</th>
                    <th>Vehicle</th>
                    <th>Hotel</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($datas)) : ?>
                    <?php foreach ($datas as $index => $data) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['pemesanan_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['pengguna_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['paket_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['kendaraan_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['hotel_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['tgl_pemesanan']); ?></td>
                            <td><?php echo htmlspecialchars($data['status']); ?></td>
                            <td>
                                <a href="index.php?controller=booking&action=view&id=<?php echo $data['pemesanan_id']; ?>" class="btn btn-info">View</a>
                                <a href="index.php?controller=booking&action=edit&id=<?php echo $data['pemesanan_id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?controller=booking&action=delete&id=<?php echo $data['pemesanan_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>