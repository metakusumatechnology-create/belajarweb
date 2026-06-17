<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'belajarweb';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");

// Helper function to get articles
function getArticles($conn, $category = null) {
    $sql = "SELECT * FROM articles";
    if ($category) {
        $sql .= " WHERE category = '" . $conn->real_escape_string($category) . "'";
    }
    $sql .= " ORDER BY created_at DESC";
    return $conn->query($sql);
}

// Helper function to get testimonials
function getTestimonials($conn) {
    $sql = "SELECT * FROM testimonials ORDER BY created_at DESC";
    return $conn->query($sql);
}

// Helper function to save contact
function saveContact($conn, $name, $email, $subject, $message) {
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    return $stmt->execute();
}
?>