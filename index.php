<?php
// Include database connection
require_once 'config/database.php';

// Handle contact form submission
$alert = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (saveContact($conn, $name, $email, $subject, $message)) {
            $alert = '<div class="alert alert-success">✓ Pesan Anda telah terkirim. Terima kasih!</div>';
        } else {
            $alert = '<div class="alert alert-error">✗ Gagal mengirim pesan. Silakan coba lagi.</div>';
        }
    } else {
        $alert = '<div class="alert alert-error">✗ Harap isi semua field yang wajib diisi.</div>';
    }
}

// Get articles from database
$articles = getArticles($conn);
$articles_count = $articles ? $articles->num_rows : 0;

// Get testimonials from database
$testimonials = getTestimonials($conn);
$testimonials_count = $testimonials ? $testimonials->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelajarWeb - Ilmu Statistik & Peranannya dalam Teknologi</title>
    <meta name="description"
        content="Pelajari ilmu statistik dan peran pentingnya dalam perkembangan teknologi modern. Materi lengkap dan mudah dipahami.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- ===== Navigation ===== -->
    <nav class="navbar">
        <a href="#" class="logo">
            <i class="fas fa-chart-line"></i>
            Belajar<span>Web</span>
        </a>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links">
            <li><a href="#home" class="active">Beranda</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#articles">Artikel</a></li>
            <li><a href="#features">Fitur</a></li>
            <li><a href="#testimonials">Testimoni</a></li>
            <li><a href="#contact">Kontak</a></li>
        </ul>
    </nav>

    <!-- ===== Hero Section ===== -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Ilmu <span class="highlight">Statistik</span> & Peranannya dalam <span
                    class="highlight">Teknologi</span></h1>
            <p class="subtitle">Memahami data adalah kunci masa depan. Pelajari bagaimana statistik menjadi fondasi
                inovasi teknologi modern.</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="number" data-target="4">0</span>
                    <span class="label">Artikel</span>
                </div>
                <div class="stat-item">
                    <span class="number" data-target="3">0</span>
                    <span class="label">Testimoni</span>
                </div>
                <div class="stat-item">
                    <span class="number" data-target="100">0</span>
                    <span class="label">% Gratis</span>
                </div>
            </div>
            <div class="btn-group">
                <a href="#articles" class="btn btn-primary">
                    <i class="fas fa-book-open"></i> Mulai Belajar
                </a>
                <a href="#contact" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- ===== About Section ===== -->
    <section id="about" class="about section">
        <div class="section-title">Apa itu Ilmu Statistik?</div>
        <p class="section-subtitle">Memahami dasar-dasar statistik dan mengapa ilmu ini sangat penting di era digital
        </p>
        <div class="about-grid">
            <div class="about-text">
                <h3>Statistik: Bahasa Data di Era Digital</h3>
                <p>
                    <strong>Statistika</strong> adalah cabang ilmu yang mempelajari cara mengumpulkan,
                    mengolah, menganalisis, dan menginterpretasikan data. Dalam era digital modern ini,
                    statistika menjadi fondasi penting dalam berbagai bidang teknologi.
                </p>
                <p>
                    Dari <strong>Data Science</strong>, <strong>Machine Learning</strong>, hingga
                    <strong>Artificial Intelligence</strong> - semua membutuhkan pemahaman statistik
                    yang kuat untuk bekerja secara efektif.
                </p>
                <ul>
                    <li><i class="fas fa-check-circle"></i> Pengumpulan dan pengolahan data sistematis</li>
                    <li><i class="fas fa-check-circle"></i> Analisis menggunakan metode ilmiah</li>
                    <li><i class="fas fa-check-circle"></i> Interpretasi data untuk pengambilan keputusan</li>
                    <li><i class="fas fa-check-circle"></i> Prediksi dan peramalan berbasis data</li>
                    <li><i class="fas fa-check-circle"></i> Visualisasi data yang informatif</li>
                </ul>
            </div>
            <div class="about-cards">
                <div class="about-card">
                    <i class="fas fa-database"></i>
                    <h4>Data Science</h4>
                    <p>Menggali wawasan dari data menggunakan metode statistik dan komputasi</p>
                </div>
                <div class="about-card">
                    <i class="fas fa-robot"></i>
                    <h4>Machine Learning</h4>
                    <p>Membangun model prediktif berbasis probabilitas dan statistika</p>
                </div>
                <div class="about-card">
                    <i class="fas fa-brain"></i>
                    <h4>AI & Deep Learning</h4>
                    <p>Jaringan saraf tiruan yang berakar pada konsep statistik</p>
                </div>
                <div class="about-card">
                    <i class="fas fa-chart-bar"></i>
                    <h4>Big Data Analytics</h4>
                    <p>Menganalisis dataset besar untuk pola dan tren bisnis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Articles Section ===== -->
    <section id="articles" class="articles section">
        <div class="section-title">Artikel & Materi</div>
        <p class="section-subtitle">Kumpulan artikel yang membahas ilmu statistik dan penerapannya dalam teknologi</p>
        <div class="articles-grid">
            <?php
            if ($articles && $articles_count > 0) {
                $icons = ['fas fa-calculator', 'fas fa-laptop-code', 'fas fa-robot', 'fas fa-chart-pie'];
                $i = 0;
                while ($article = $articles->fetch_assoc()) {
                    $icon = $icons[$i % count($icons)];
                    $i++;
            ?>
            <div class="article-card">
                <div class="card-header">
                    <span class="category">
                        <?php echo $article['category'] === 'technology' ? 'Teknologi' : 'Statistik'; ?>
                    </span>
                    <i class="<?php echo $icon; ?> card-icon"></i>
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                </div>
                <div class="card-body">
                    <p><?php echo htmlspecialchars($article['content']); ?></p>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<p style="text-align:center;grid-column:1/-1;color:var(--text-light);">Belum ada artikel. Silakan jalankan database/setup.sql untuk mengisi data.</p>';
            }
            ?>
        </div>
    </section>

    <!-- ===== Features Section ===== -->
    <section id="features" class="features section">
        <div class="section-title">Peranan Statistik dalam Teknologi</div>
        <p class="section-subtitle">Bagaimana statistik menjadi tulang punggung inovasi teknologi modern</p>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-search"></i>
                <h3>Search Engine</h3>
                <p>Algoritma pencarian Google menggunakan statistik untuk menentukan relevansi dan peringkat halaman
                    web.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-thumbs-up"></i>
                <h3>Sistem Rekomendasi</h3>
                <p>Netflix, YouTube, dan Spotify menggunakan analisis statistik untuk merekomendasikan konten yang
                    sesuai.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-credit-card"></i>
                <h3>Deteksi Fraud</h3>
                <p>Bank dan fintech menggunakan statistik untuk mendeteksi transaksi mencurigakan secara real-time.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-dna"></i>
                <h3>Bioinformatika</h3>
                <p>Analisis data genom dan penelitian medis sangat bergantung pada metode statistika.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-cloud-sun"></i>
                <h3>Prediksi Cuaca</h3>
                <p>BMKG menggunakan model statistik untuk memprediksi cuaca dan perubahan iklim.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-shopping-cart"></i>
                <h3>E-commerce</h3>
                <p>Analisis perilaku konsumen, optimasi harga, dan manajemen inventaris berbasis statistik.</p>
            </div>
        </div>
    </section>

    <!-- ===== Testimonials Section ===== -->
    <section id="testimonials" class="testimonials section">
        <div class="section-title">Apa Kata Mereka</div>
        <p class="section-subtitle">Testimoni dari para pembelajar yang telah merasakan manfaat materi statistik</p>
        <div class="testimonials-grid">
            <?php
            if ($testimonials && $testimonials_count > 0) {
                while ($testimonial = $testimonials->fetch_assoc()) {
                    $initials = '';
                    $names = explode(' ', $testimonial['name']);
                    foreach ($names as $n) {
                        $initials .= strtoupper($n[0]);
                    }
            ?>
            <div class="testimonial-card">
                <div class="stars">
                    <?php for ($s = 0; $s < $testimonial['rating']; $s++): ?>
                    <i class="fas fa-star"></i>
                    <?php endfor; ?>
                    <?php for ($s = $testimonial['rating']; $s < 5; $s++): ?>
                    <i class="far fa-star"></i>
                    <?php endfor; ?>
                </div>
                <p>"<?php echo htmlspecialchars($testimonial['message']); ?>"</p>
                <div class="author">
                    <div class="avatar"><?php echo $initials; ?></div>
                    <div class="info">
                        <h4><?php echo htmlspecialchars($testimonial['name']); ?></h4>
                        <span><?php echo htmlspecialchars($testimonial['position']); ?></span>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<p style="text-align:center;grid-column:1/-1;color:var(--gray);">Belum ada testimoni. Silakan jalankan database/setup.sql untuk mengisi data.</p>';
            }
            ?>
        </div>
    </section>

    <!-- ===== Contact Section ===== -->
    <section id="contact" class="contact section">
        <div class="section-title">Hubungi Kami</div>
        <p class="section-subtitle">Punya pertanyaan tentang statistik? Jangan ragu untuk menghubungi kami</p>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Informasi Kontak</h3>
                <p>Kami siap membantu Anda memahami dunia statistik dan penerapannya dalam teknologi. Silakan hubungi
                    kami melalui:</p>
                <ul class="contact-details">
                    <li>
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong><br>
                            <a href="mailto:muhtar.kusuma@protonmail.com">muhtar.kusuma@protonmail.com</a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <strong>Telepon</strong><br>
                            <a href="tel:+6281258601972">+62 812 5860 1972</a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Lokasi</strong><br>
                            Indonesia
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>Jam Operasional</strong><br>
                            Senin - Jumat, 08:00 - 17:00 WIB
                        </div>
                    </li>
                </ul>
            </div>
            <div class="contact-form">
                <?php echo $alert; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Nama Lengkap *" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email *" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="subject" name="subject" placeholder="Subjek Pesan">
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Pesan Anda *" required></textarea>
                    </div>
                    <button type="submit" name="submit_contact" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- ===== Footer ===== -->
    <footer>
        <div class="footer-content">
            <div class="footer-about">
                <h3><i class="fas fa-chart-line"></i> BelajarWeb</h3>
                <p>
                    Platform pembelajaran ilmu statistik dan peranannya dalam teknologi.
                    Kami berkomitmen untuk menyediakan materi berkualitas tinggi yang mudah
                    dipahami oleh siapa saja yang ingin belajar statistik.
                </p>
            </div>
            <div class="footer-links">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#articles">Artikel</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#testimonials">Testimoni</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Kontak</h4>
                <ul>
                    <li><a href="mailto:muhtar.kusuma@protonmail.com"><i class="fas fa-envelope"></i> Email</a></li>
                    <li><a href="tel:+6281258601972"><i class="fas fa-phone"></i> Telepon</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 BelajarWeb. Hak Cipta Dilindungi. | Ilmu Statistik & Peranannya dalam Teknologi</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php $conn->close(); ?>