<?php
include 'config.php';

$search = $_GET['search'] ?? '';

echo "<div class='container'>";
echo "<h1>Products</h1>";

if (!empty($search)) {
    // VULNERABLE CODE - SQL Injection
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
    echo "<p>Search results for: " . htmlspecialchars($search) . "</p>";
    echo "<p>SQL Query: $sql</p>";
} else {
    $sql = "SELECT * FROM products";
}

$result = $pdo->query($sql);

echo "<div class='products'>";
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='product-card'>";
    echo "<h3>{$row['name']}</h3>";
    echo "<p>Price: \${$row['price']}</p>";
    echo "<p>{$row['description']}</p>";
    echo "</div>";
}
echo "</div>";

echo "<a href='/'>Back to Home</a>";
echo "</div>";
