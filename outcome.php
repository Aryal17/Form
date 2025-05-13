<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "form";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM form ORDER BY submitted_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Outcome</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 40px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h2>Submitted Form Entries</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Issue</th>
            <th>Comment</th>
            <th>Submitted At</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['issue']}</td>
                        <td>{$row['comment']}</td>
                        <td>{$row['submitted_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No submissions yet.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
        <!-- Button to go back to the form input -->
    <a href="index.php" class="back-btn">Go Back to Submit Another Feedback</a>
    
</body>
</html>
