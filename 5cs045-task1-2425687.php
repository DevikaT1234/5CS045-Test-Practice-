<?php
// Database connection
$host = "localhost";
$username = "db2425687";
$password = "ManUnited123#";
$database = "db2425687";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $username, $password, $database);
    $conn->set_charset("utf8mb4");

    // Retrieve sports records
    $sql = "SELECT sport_id, sport_name, Genre, Price, Date_of_release
            FROM sports
            ORDER BY sport_id";

    $result = $conn->query($sql);

} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("Unable to retrieve sport records. Please check the database configuration and server error log.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Collection</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }
    </style>
</head>

<body>

<h1>Sport Collection</h1>

<table>
    <thead>
        <tr>
            <th>sport id</th>
            <th>sport name</th>
            <th>Genre</th>
            <th>Price (£)</th>
            <th>Date of Release</th>
        </tr>
    </thead>

    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$row["sport_id"], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string)$row["sport_name"], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string)$row["Genre"], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= number_format((float)$row["Price"], 2) ?></td>
                    <td><?= htmlspecialchars((string)$row["Date_of_release"], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No sports found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $conn->close(); ?>

</body>
</html>