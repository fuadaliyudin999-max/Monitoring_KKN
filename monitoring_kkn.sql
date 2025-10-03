-- database/monitoring_kkn.sql
CREATE DATABASE IF NOT EXISTS monitoring_kkn CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE monitoring_kkn;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150) NOT NULL,
  nim VARCHAR(50) NOT NULL UNIQUE,
  jurusan VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE lokasi_kkn (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_lokasi VARCHAR(255) NOT NULL,
  koordinat_maps VARCHAR(255),
  foto1 VARCHAR(255),
  foto2 VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE progress (
  id INT AUTO_INCREMENT PRIMARY KEY,
  lokasi_id INT NOT NULL,
  mahasiswa_id INT NOT NULL,
  status VARCHAR(100),
  deskripsi TEXT,
  foto_progress VARCHAR(255),
  tanggal DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (lokasi_id) REFERENCES lokasi_kkn(id) ON DELETE CASCADE,
  FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- default admin (password = admin123 hashed)
INSERT INTO users (nama, email, password, role) VALUES
('Administrator','admin@kkn.com','$2y$10$jO0xvQ1GmQZQ1rO5eY3k4eJp5uG3w3ou6QKz0j6G2fQ6oH3U8c1eW','admin');
-- The hashed password string above is an example of password_hash('admin123', PASSWORD_DEFAULT).
