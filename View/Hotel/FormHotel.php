<?php

use Controller\HotelController;

// Buat instance controller
$controller = new HotelController();
$hotelList = $controller->index();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Hotel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 8px 12px;
            margin: 4px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #4CAF50;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-upload {
            background-color: #008CBA;
        }
    </style>
</head>

<body>

    <h1>Daftar Hotel</h1>

    <!-- Tabel Hotel -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Rate</th>
                <th>Harga per Malam</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelList as $hotel) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($hotel['hotel_id']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['nama']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['rate']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['harga_permalam']); ?></td>
                    <td><?php echo htmlspecialchars($hotel['deskripsi']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($hotel['gambar']); ?>" alt="Gambar Hotel" style="width: 100px;"></td>
                    <td>
                        <form method="post" action="editHotel.php" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($hotel['hotel_id']); ?>">
                            <button type="submit" class="btn btn-edit">Edit</button>
                        </form>
                        <form method="post" action="deleteHotel.php" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($hotel['hotel_id']); ?>">
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tombol Upload -->
    <form method="post" action="uploadHotel.php">
        <button type="submit" class="btn btn-upload">Upload Hotel</button>
    </form>

</body>

</html>