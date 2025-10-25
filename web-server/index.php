<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>WAF Test - E-commerce Site</title>
    <style>
        body { font-family: Arial, margin: 40px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .form-section { background: #f8f9fa; padding: 20px; margin: 20px 0; border-radius: 8px; }
        .products { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 20px 0; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛒 E-commerce Test Site</h1>
        <p>เว็บทดสอบ WAF พร้อม Database</p>
        
        <div class="form-section">
            <h2>🔐 Login (SQL Injection Test)</h2>
            <form action="login.php" method="POST">
                Username: <input type="text" name="username" required>
                Password: <input type="password" name="password" required>
                <input type="submit" value="Login">
            </form>
        </div>

        <div class="form-section">
            <h2>🔍 Search Products</h2>
            <form action="products.php" method="GET">
                Search: <input type="text" name="search">
                <input type="submit" value="Search">
            </form>
        </div>

        <div class="form-section">
            <h2>📊 Products</h2>
            <div class="products">
                <?php
                $stmt = $pdo->query("SELECT * FROM products LIMIT 6");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='product-card'>";
                    echo "<h3>{$row['name']}</h3>";
                    echo "<p>Price: \${$row['price']}</p>";
                    echo "<p>{$row['description']}</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
