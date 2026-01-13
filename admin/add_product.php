<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $category = trim($_POST['category']);
    $image = '';

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_filename = uniqid() . '.' . $ext;
            $upload_path = '../assets/images/' . $new_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image = $new_filename;
            } else {
                $message = 'Failed to upload image.';
            }
        } else {
            $message = 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.';
        }
    }

    // Server-side validation
    if (empty($name) || empty($price) || empty($category)) {
        $message = 'Please fill in all required fields.';
    } elseif (!is_numeric($price) || $price <= 0) {
        $message = 'Please enter a valid price.';
    } elseif (empty($message)) {
        // Insert product
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $description, $price, $image, $category])) {
            header('Location: dashboard.php');
            exit();
        } else {
            $message = 'Failed to add product.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1>Add Product</h1>
            <div class="nav-links">
                <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                <a href="../auth/logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2>Add New Product</h2>
            <?php if ($message): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <form id="addProductForm" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" required>
                </div>
                <div class="form-group">
                    <label for="image">Product Image:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/validation.js"></script>
</body>
</html>
