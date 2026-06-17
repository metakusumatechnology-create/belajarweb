-- Database setup for Belajar Web - Ilmu Statistik
CREATE DATABASE IF NOT EXISTS belajarweb;
USE belajarweb;

-- Table for contact messages
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for website content/articles
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category VARCHAR(100) DEFAULT 'statistics',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample articles about statistics
INSERT INTO articles (title, content, category) VALUES
('Apa itu Ilmu Statistik?', 'Statistika adalah cabang ilmu yang mempelajari cara mengumpulkan, mengolah, menganalisis, dan menginterpretasikan data. Dalam era digital modern ini, statistika menjadi fondasi penting dalam berbagai bidang teknologi seperti data science, machine learning, dan artificial intelligence. Tanpa statistika, mustahil bagi kita untuk mengambil keputusan berdasarkan data yang akurat dan terpercaya.', 'statistics'),
('Peranan Statistik dalam Teknologi Informasi', 'Statistik memainkan peran vital dalam teknologi informasi. Dari analisis data pengguna, optimasi algoritma pencarian, hingga pengembangan sistem rekomendasi - semua bergantung pada metode statistika. Big Data dan Data Analytics yang menjadi tulang punggung industri 4.0 tidak akan ada tanpa fondasi statistika yang kuat. Perusahaan teknologi raksasa seperti Google, Amazon, dan Microsoft menggunakan statistika untuk meningkatkan layanan mereka setiap hari.', 'technology'),
('Statistik dalam Machine Learning', 'Machine Learning sangat bergantung pada konsep statistika seperti distribusi probabilitas, regresi, clustering, dan hypothesis testing. Algoritma pembelajaran mesin menggunakan prinsip-prinsip statistika untuk mengenali pola, membuat prediksi, dan terus belajar dari data baru. Tanpa pemahaman statistika yang baik, mustahil untuk membangun model machine learning yang andal dan akurat.', 'technology'),
('Penerapan Statistik dalam Kehidupan Sehari-hari', 'Statistik bukan hanya untuk ilmuwan data. Dalam kehidupan sehari-hari, kita menggunakan statistik ketika membandingkan harga produk, melihat tren cuaca, atau bahkan ketika membaca berita yang menyajikan data dalam bentuk grafik. Statistik membantu kita membuat keputusan yang lebih baik dengan memahami data di sekitar kita.', 'statistics');

-- Table for testimonials
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(150) DEFAULT NULL,
    message TEXT NOT NULL,
    rating INT DEFAULT 5,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample testimonials
INSERT INTO testimonials (name, position, message, rating) VALUES
('Dr. Andi Pratama', 'Data Scientist di TechCorp', 'Materi statistik yang disajikan sangat komprehensif dan mudah dipahami. Sangat membantu dalam pekerjaan saya sehari-hari.', 5),
('Siti Nurhaliza', 'Mahasiswa Teknik Informatika', 'Belajar statistik jadi lebih menyenangkan dengan penjelasan yang aplikatif dan relevan dengan teknologi modern.', 5),
('Budi Santoso', 'Analyst di Bank Central', 'Pemahaman statistik sangat krusial di era big data. Website ini memberikan dasar yang kuat untuk memulainya.', 4);