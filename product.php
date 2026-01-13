<?php
session_start();
require_once 'config/db.php';

// Check if product ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

// Get product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Management</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1>Products</h1>
            <div class="nav-links">
                <a href="index.php" class="btn btn-secondary">Back to Products</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
                    <?php if ($_SESSION['user_role'] == 'admin'): ?>
                        <a href="admin/dashboard.php" class="btn btn-primary">Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="auth/logout.php" class="btn btn-secondary">Logout</a>
                <?php else: ?>
                    <a href="auth/login.php" class="btn btn-primary">Login</a>
                    <a href="auth/register.php" class="btn btn-secondary">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="product-detail">
            <div class="product-image-large">
                <?php if ($product['image']): ?>
                    <img src="assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <?php else: ?>
                    <div class="no-image-large">No Image Available</div>
                <?php endif; ?>
            </div>
            <div class="product-info-detail">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="category">Category: <?php echo htmlspecialchars($product['category']); ?></p>
                <p class="price">$<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></p>

                <?php if ($product['description']): ?>
                    <div class="description">
                        <h3>Description</h3>
                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    </div>
                <?php endif; ?>

                <p class="created-date">Added on: <?php echo htmlspecialchars(date('F j, Y', strtotime($product['created_at']))); ?></p>
            </div>
        </div>
    </div>
    <script src="assets/js/validation.js"></script>
</body>
</html>
