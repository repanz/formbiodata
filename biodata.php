<?php
// Tahap 1: Form input jumlah data
if (!isset($_POST['jumlah']) && !isset($_POST['biodata'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 80px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 25px;
            color: #333;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 16px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Masukkan Jumlah Data Biodata</h2>
        <form method="post">
            <label>Berapa data yang ingin dimasukkan?</label><br>
            <input type="number" name="jumlah" min="1" required>
            <br>
            <button type="submit">Lanjut</button>
        </form>
    </div>
</body>
</html>

<?php
// Tahap 2: Tampilkan form biodata sesuai jumlah
} elseif (isset($_POST['jumlah']) || (isset($_POST['tambah']) && isset($_POST['biodata']))) {
    $jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : count($_POST['biodata']) + 1;
    $biodataSebelumnya = isset($_POST['biodata']) ? $_POST['biodata'] : [];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 900px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        fieldset {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        legend {
            font-weight: bold;
            color: #555;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: 500;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            padding: 12px 20px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[name="submit"] {
            background-color: #3498db;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Input Biodata (<?= $jumlah ?> Data)</h2>
        <form method="post">
            <?php for ($i = 0; $i < $jumlah; $i++): 
                $panggilan = $biodataSebelumnya[$i]['panggilan'] ?? '';
                $lengkap   = $biodataSebelumnya[$i]['lengkap'] ?? '';
                $usia      = $biodataSebelumnya[$i]['usia'] ?? '';
            ?>
            <fieldset>
                <legend>Data Ke-<?= $i + 1 ?></legend>
                <label>Nama Panggilan:</label>
                <input type="text" name="biodata[<?= $i ?>][panggilan]" value="<?= htmlspecialchars($panggilan) ?>" required>

                <label>Nama Lengkap:</label>
                <input type="text" name="biodata[<?= $i ?>][lengkap]" value="<?= htmlspecialchars($lengkap) ?>" required>

                <label>Usia:</label>
                <input type="number" name="biodata[<?= $i ?>][usia]" value="<?= htmlspecialchars($usia) ?>" min="0" required>
            </fieldset>
            <?php endfor; ?>

            <button type="submit" name="tambah">➕ Tambah Lagi</button>
            <button type="submit" name="submit">✅ Submit</button>
        </form>
    </div>
</body>
</html>

<?php
// Tahap 3: Tampilkan hasil tabel dengan tombol kembali ke awal
} elseif (isset($_POST['submit']) && isset($_POST['biodata'])) {
    $data = $_POST['biodata'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Biodata</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #bbb;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-kembali {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background-color: #e74c3c;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-kembali:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Output Data Biodata</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Panggilan</th>
                    <th>Nama Lengkap</th>
                    <th>Usia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($row['panggilan']) ?></td>
                    <td><?= htmlspecialchars($row['lengkap']) ?></td>
                    <td><?= htmlspecialchars($row['usia']) ?> tahun</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form method="post" action="">
            <button type="submit" class="btn-kembali">🔁 Kembali ke Awal</button>
        </form>
    </div>
</body>
</html>
<?php } ?>
