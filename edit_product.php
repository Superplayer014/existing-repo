<?php
include 'db.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare and execute the select statement
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        echo "Product not found!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $caption = $_POST['caption']; // Capture the caption from the form

    // Handle image upload
    $image = $product['image']; // Keep the old image path by default

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/"; // Directory to store uploaded images
        $image_file_name = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file; // Update the image path if upload is successful
        } else {
            echo "Error uploading image.";
        }
    } else {
        $image_path = $image; // Use the old image if no new one is uploaded
    }

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE products SET product_name = ?, price = ?, quantity = ?, image = ?, caption = ? WHERE product_id = ?");
    $stmt->bind_param("sdissi", $product_name, $price, $quantity, $image_path, $caption, $product_id); // Updated to include caption

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
    /* Global Styling */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #121212; /* Dark background */
        margin: 0;
        padding: 20px;
        color: #E0E0E0; /* Light text for contrast */
    }

    h3, h4 {
        text-align: center;
        color: #00E5FF; /* Neon blue for headings */
        text-shadow: 0 0 8px rgba(0, 229, 255, 0.5); /* Neon glow */
    }

    form {
        background-color: #1E1E1E; /* Dark form background */
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 229, 255, 0.2); /* Soft neon blue shadow */
        padding: 20px;
        max-width: 400px;
        margin: auto;
        color: #E0E0E0;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #A8A8A8; /* Subtle grey for labels */
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: none;
        border-radius: 6px;
        box-sizing: border-box;
        background-color: #1C1C1E; /* Dark input background */
        color: #E0E0E0;
        box-shadow: inset 0 0 5px rgba(0, 229, 255, 0.3); /* Soft inner glow */
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="file"]:focus,
    textarea:focus {
        outline: none;
        border-color: #00E5FF;
        box-shadow: 0 0 8px rgba(0, 229, 255, 0.5); /* Outer glow */
    }

    textarea {
        height: 100px; /* Height for the caption area */
    }

    button {
        background-color: #00E5FF; /* Neon blue button */
        color: #121212; /* Dark text on button */
        padding: 12px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        font-weight: bold;
        font-size: 16px;
        box-shadow: 0 4px 10px rgba(0, 229, 255, 0.4); /* Soft neon glow */
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    button:hover {
        background-color: #00C4D6; /* Slightly darker blue on hover */
        box-shadow: 0 6px 15px rgba(0, 229, 255, 0.6); /* Enhanced glow on hover */
    }

    img {
        display: block;
        margin: 0 auto;
        max-width: 200px;
        border: 1px solid #333;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 229, 255, 0.3); /* Soft neon border glow */
    }
</style>

</head>
<body>
    <h3>Edit Product</h3>
    <form action="edit_product.php?id=<?= htmlspecialchars($product['product_id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
        <label>Product Name: 
            <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        </label>
        <label>Price: 
            <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" step="0.01" required>
        </label>
        <label>Quantity: 
            <input type="number" name="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" required>
        </label>
        <label>Caption: 
            <textarea name="caption" required><?= htmlspecialchars($product['caption']) ?></textarea>
        </label>
        <label>Image: 
            <input type="file" name="image">
        </label>
        <button type="submit">Update Product</button>
    </form>

    <!-- Display the current image -->
    <?php if ($product['image']): ?>
        <h4>Current Image:</h4>
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="Product Image">
    <?php endif; ?>
</body>
</html>
