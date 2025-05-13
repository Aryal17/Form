<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form method="post" action="index.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="issue">Select Issue:</label>
        <select id="issue" name="issue" required>
            <option value="Query">Query</option>
            <option value="Feedback">Feedback</option>
            <option value="Complaint">Complaint</option>
            <option value="Other">Other</option>
        </select>

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>

    <?php
    session_start();

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "form";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $issue = $_POST["issue"];
        $comment = $_POST["comment"];

        // Insert into database
        $sql = "INSERT INTO form (name, email, issue, comment) 
                VALUES ('$name', '$email', '$issue', '$comment')";

        if (mysqli_query($conn, $sql)) {
            // Save data to session
            $_SESSION['submitted'] = [
                'name' => $name,
                'email' => $email,
                'issue' => $issue,
                'comment' => $comment
            ];
            // Redirect to outcome.php
            header("Location: outcome.php");
            exit();
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>

</body>
</html>
