# DIGITS  "Digital Transformation & Sustainable Technologies"

Website platform untuk mendukung pelaksanaan **DIGITS (Digital Transformation & Sustainable Technologies)**, sebuah international conference yang diselenggarakan oleh **Universitas Bhinneka Nusantara (UBHINUS)**.

Platform ini dikembangkan untuk mendukung kebutuhan informasi konferensi, registrasi peserta, pengumpulan abstrak, pembayaran, serta pengelolaan data peserta melalui sistem administrasi.

---

## 📌 Project Overview

**DIGITS — Digital Transformation & Sustainable Technologies** merupakan platform website konferensi yang dirancang untuk membantu proses penyelenggaraan konferensi secara digital.

Website menyediakan informasi mengenai konferensi sekaligus menyediakan sistem registrasi online yang memungkinkan peserta untuk mengirimkan data pendaftaran, abstrak penelitian, dan bukti pembayaran.

Di sisi administrator, sistem menyediakan dashboard untuk membantu panitia melakukan pengelolaan, pemeriksaan, dan verifikasi data peserta.

### Main Objectives

* Menyediakan pusat informasi konferensi secara digital.
* Mempermudah proses registrasi peserta.
* Mendukung proses pengumpulan abstrak secara online.
* Mendukung pengumpulan bukti pembayaran.
* Membantu administrator mengelola data peserta.
* Menyediakan export data peserta untuk kebutuhan administrasi.

---

## ✨ Features

### 🌐 Public Conference Website

Website utama menyediakan informasi konferensi, meliputi:

* Conference Overview
* Conference Theme
* Paper Scope
* Keynote Speakers
* Important Dates
* Registration Information
* Payment Information
* Publication Information
* Co-host Information
* Contact Information
* Responsive Web Interface

### 📝 Online Registration

Peserta dapat melakukan pendaftaran melalui sistem secara online.

Fitur registrasi meliputi:

* Participant Registration
* Participant Type Selection
* Personal Information
* Institution Information
* Abstract Submission
* Payment Receipt Upload
* Form Validation
* Registration Confirmation

### 📄 Abstract Submission

Peserta dapat mengirimkan abstrak penelitian melalui sistem.

Dokumen yang dapat dikirimkan meliputi:

* Abstract File
* Payment Receipt

File yang dikirimkan kemudian dapat diperiksa oleh administrator.

### 💳 Payment Receipt

Sistem menyediakan fitur upload bukti pembayaran sebagai bagian dari proses registrasi peserta.

File pembayaran disimpan pada server dan dapat diakses oleh administrator untuk kebutuhan verifikasi.

### 🔐 Administrator Dashboard

Sistem menyediakan halaman administrasi untuk membantu panitia mengelola peserta.

Fitur utama meliputi:

* Administrator Login
* Authentication
* Participant Statistics
* Pending Participant List
* Verified Participant List
* Participant Detail
* Abstract Review
* Payment Receipt Review
* Participant Verification
* Participant Data Management
* Excel Export
* Logout

### 📧 Email Notification

Sistem menggunakan **PHPMailer** untuk mendukung kebutuhan pengiriman email terkait proses registrasi dan komunikasi sistem.

---

## 🛠️ Technology Stack

### Frontend

* HTML5
* CSS3
* JavaScript
* Tailwind CSS
* Font Awesome
* SweetAlert2

### Backend

* PHP
* MySQL / MariaDB
* PDO
* PHPMailer

### Development Tools

* Visual Studio Code
* Laragon / XAMPP
* Composer
* Git
* GitHub

---

## 📁 Project Structure

```text
DIGITS/
│
├── admin/
│   ├── .htaccess
│   ├── actions.php
│   ├── auth.php
│   ├── auth_check.php
│   ├── belum_setuju.php
│   ├── export_excel.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   └── sudah_setuju.php
│
├── img/
│   ├── coverhalaman/
│   ├── icon/
│   ├── keynotespeaker/
│   └── logocohost/
│
├── index.php
├── registration.php
├── process_registration.php
├── composer.json
├── composer.lock
├── .gitignore
└── README.md
```

> **Note:** Direktori `uploads/`, `vendor/`, file konfigurasi lokal, dan archive files tidak disertakan dalam repository karena dapat berisi data pengguna, dependency hasil instalasi, atau informasi sensitif.

---

## ⚙️ Requirements

Untuk menjalankan project secara lokal, diperlukan:

* PHP 8.x atau versi yang sesuai dengan project
* MySQL / MariaDB
* Apache
* Composer
* Laragon atau XAMPP
* Web browser modern

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/lanateguh27/digits.git
cd digits
```

### 2. Install Composer Dependencies

Jalankan:

```bash
composer install
```

Composer akan meng-install dependency project ke dalam direktori `vendor/`.

### 3. Create Database

Buat database MySQL / MariaDB untuk aplikasi DIGITS.

Contoh:

```text
digits_database
```

Kemudian import database schema yang sesuai dengan project.

> Database dump yang berisi data peserta asli tidak disertakan dalam repository.

### 4. Configure Database

Buat konfigurasi database secara lokal.

Contoh:

```php
<?php

$host = 'localhost';
$db   = 'digits_database';
$user = 'root';
$pass = '';

$pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8mb4",
    $user,
    $pass
);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
```

Simpan konfigurasi tersebut pada file lokal sesuai struktur aplikasi.

**Jangan memasukkan credential database atau API key ke repository publik.**

### 5. Configure Upload Directory

Buat struktur folder berikut pada environment lokal:

```text
uploads/
├── abstracts/
└── receipts/
```

Folder tersebut digunakan untuk menyimpan dokumen yang diunggah melalui sistem.

### 6. Run the Application

Jika menggunakan Laragon:

```text
C:\laragon\www\digits\
```

Aktifkan:

* Apache
* MySQL

Kemudian buka:

```text
http://localhost/digits/
```

---


## 📸 Screenshots

![digits](img/screenshot/digits1.png)
![digist](img/screenshot/digits2.png)


---

## 👨‍💻 Development

Project ini dikembangkan sebagai platform web untuk mendukung proses digitalisasi penyelenggaraan **DIGITS — Digital Transformation & Sustainable Technologies**.

Pengembangan mencakup:

* Frontend development
* Backend development
* Database integration
* Online registration system
* File upload handling
* Administrator authentication
* Participant management
* Abstract submission
* Payment receipt management
* Email notification
* Excel data export

---

## 📄 Project Information

**Project:** DIGITS — Digital Transformation & Sustainable Technologies
**Organization:** Universitas Bhinneka Nusantara (UBHINUS)
**Project Type:** Conference Management Website
**Platform:** Web Application
**Backend:** PHP
**Database:** MySQL / MariaDB

---

## 📜 License

This project is intended for educational, professional portfolio, and project documentation purposes.

Copyright © DIGITS — Digital Transformation & Sustainable Technologies.
