<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web3donate | Admin</title>
    <link rel="shortcut icon" href="img/logo.png" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body class="flex h-screen"> <!-- Add class attribute to body -->

    <!-- Sidebar -->
    <div class="w-64 bg-blue-900 text-white p-4">
        <img src="img/logo.png" class="w-40 h-40 mx-auto" alt="">
        <h2 class="text-2xl font-semibold mb-4 text-center">Web3donate Dashboard</h2>
        <nav>
            <a href="tb_donate.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Donate</a>
            <a href="tb_add_donate.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Add Donate</a>
            <a href="tb_user.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Users Donate</a>
            <a href="tb_data.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Data Report</a>
            <a href="tb_crypto.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Crypto</a>
            <a href="tb_feedback.php" class="block py-2.5 px-4 rounded hover:bg-blue-700">Feedback</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold mb-10">Data Report</h1>
        <!-- Tambahkan form untuk memilih tanggal -->
        <div class="flex justify-end mb-4">
            <form action="" method="get">
                <input type="date" name="selected_date" class="border p-2 rounded" value="<?php echo htmlspecialchars($_GET['selected_date'] ?? date('Y-m-d')); ?>">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Select Date</button>
            </form>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full min-w-max text-sm text-left rtl:text-right text-black-500 border">
                <thead class="text-center text-xs text-black-700 uppercase bg-gray-50 border">
                    <tr>
                        <th scope="col" class="px-6 py-3 border">Email</th>
                        <th scope="col" class="px-6 py-3 border">Donation Name</th>
                        <th scope="col" class="px-6 py-3 border">Amount</th>
                        <th scope="col" class="px-6 py-3 border">Payment</th>
                        <th scope="col" class="px-6 py-3 border">Message</th>
                        <th scope="col" class="px-6 py-3 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menghubungkan ke database dan mengambil data pembayaran
                    require 'fetch_payment.php';

                    // Ambil tanggal yang dipilih, default ke tanggal hari ini jika tidak ada yang dipilih
                    $selected_date = isset($_GET['selected_date']) ? $_GET['selected_date'] : date('Y-m-d');

                    foreach ($payment_data as $row):
                        // Tampilkan hanya data yang sesuai dengan tanggal yang dipilih
                        $row_date = date('Y-m-d', strtotime($row['created_at']));
                        if ($selected_date != $row_date) {
                            continue;
                        }
                    ?>
                    <tr class="text-center border">
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['donate_name']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['Amount']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['crypto_name']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['message']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['STATUS']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
