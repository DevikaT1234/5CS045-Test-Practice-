<?php
// Database connection
$host = "localhost";
$username = "db2425687";
$password = "ManUnited123#";
$database = "db2425687"; 

$conn = new mysqli($host, $username, $password, $database);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve book records
$sql = "SELECT Book_id, Book_name, Genre, Price, Date_of_release
        FROM Books
        ORDER BY Book_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Collection</title>

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

<h1>Book Collection</h1>

<table>
    <thead>
        <tr>
            <th>Book ID</th>
            <th>Book Name</th>
            <th>Genre</th>
            <th>Price (£)</th>
            <th>Date of Release</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["Book_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Book_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Genre"]) . "</td>";
                echo "<td>" . number_format((float)$row["Price"], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row["Date_of_release"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No books found.</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>