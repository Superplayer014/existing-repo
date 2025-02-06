<?php 
include 'db.php'; // Ensure the path to 'db.php' is correct

// Fetch client details based on client_id from the URL
$client_id = $_GET['client_id']; 
$sql_client = "SELECT * FROM client WHERE client_id = $client_id";
$result_client = $conn->query($sql_client);

if (!$result_client) {
    die("Query failed: " . $conn->error);
}

$client = $result_client->fetch_assoc();

if (!$client) {
    die("Client not found.");
}

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];

    // Validate the file type
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($file['type'], $allowed_types) && $file['error'] == 0) {
        // Define a directory to store uploaded files
        $upload_dir = 'uploads/';
        $file_name = $upload_dir . basename($file['name']);
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($file['tmp_name'], $file_name)) {
            // Update the database with the file path
            $sql_update = "UPDATE client SET profile_picture = '$file_name' WHERE client_id = $client_id";
            if ($conn->query($sql_update) === TRUE) {
                echo "<script>alert('Profile picture uploaded successfully.');</script>";
            } else {
                echo "<script>alert('Error updating database: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload the file.');</script>";
        }
    } else {
        echo "<script>alert('Invalid file type or upload error.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Information</title>
    <style>
    /* Body styling */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #121212; /* Dark background */
        color: #E0E0E0; /* Light text for contrast */
        margin: 0;
        padding: 0;
    }

    /* Header styling */
    header {
        background-color: #1F1F1F; /* Darker background */
        color: #00E5FF; /* Neon blue text */
        padding: 20px;
        text-align: center;
        font-size: 28px;
        box-shadow: 0 4px 10px rgba(0, 229, 255, 0.3); /* Subtle neon shadow */
        text-shadow: 0 0 8px rgba(0, 229, 255, 0.6); /* Glow effect */
    }

    /* Main content styling */
    .content {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #1C1C1C; /* Dark content background */
        border: 1px solid #333; /* Slight border */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 2px 20px rgba(0, 229, 255, 0.2); /* Neon shadow */
        position: relative;
        color: #E0E0E0;
    }

    /* Profile picture styling */
    .profile-picture {
        max-width: 150px;
        border-radius: 50%; /* Circular image */
        position: absolute;
        top: 20px;
        right: 20px;
        box-shadow: 0 4px 10px rgba(0, 229, 255, 0.4); /* Soft neon shadow */
    }

    /* Label and form control styling */
    label {
        color: #00E5FF;
        font-size: 16px;
    }

    input[type="file"], input[type="submit"] {
        background-color: #333;
        color: #fff;
        border: 1px solid #333;
        border-radius: 5px;
        padding: 8px 12px;
        width: 100%;
        margin-top: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="file"]:hover, input[type="submit"]:hover {
        background-color: #00E5FF;
    }

    /* Button styling */
    .back-button {
        display: inline-block;
        padding: 12px 18px;
        background-color: #00E5FF; /* Neon blue */
        color: #121212; /* Dark text */
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 229, 255, 0.4); /* Glow effect */
    }

    .back-button:hover {
        background-color: #00BBD4; /* Darker neon blue on hover */
        box-shadow: 0 6px 15px rgba(0, 229, 255, 0.6); /* Enhanced glow on hover */
    }

    /* Footer styling */
    footer {
        background-color: #1A1A1A; /* Darker grey */
        color: #9E9E9E; /* Lighter grey for contrast */
        text-align: center;
        padding: 10px;
        position: relative;
        bottom: 0;
        width: 100%;
        box-shadow: 0 -1px 10px rgba(0, 229, 255, 0.2); /* Subtle shadow on top */
    }
</style>
</head>
<body>

    <header>
        Contact Information
    </header>

    <div class="content">
        <?php if (!empty($client['profile_picture'])): ?>
            <img class="profile-picture" src="<?= htmlspecialchars($client['profile_picture']) ?>" alt="Profile Picture">
        <?php endif; ?>
        
        <div>
            <h2>Client Details</h2>
            <p><strong>Full Name:</strong> <?= htmlspecialchars($client['full_name']) ?></p>
            <p><strong>Contact:</strong> <?= htmlspecialchars($client['contact']) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($client['address']) ?></p>
            <p><strong>Username:</strong> <?= htmlspecialchars($client['username']) ?></p>
            <p><strong>Password:</strong> <em>********</em> <!-- Masked password display --></p>

            <form action="" method="POST" enctype="multipart/form-data">
                <label for="profile_picture">Upload Profile Picture:</label><br>
                <input type="file" name="profile_picture" id="profile_picture" required><br><br>
                <input type="submit" value="Upload">
            </form>
            <br>
            
            <a class="back-button" href="edit_client.php?client_id=<?= $client_id ?>">Edit Information</a>
            <a class="back-button" href="product_dashboard.php?client_id=<?= $client_id ?>">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
