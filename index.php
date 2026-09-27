<?php
require_once 'config.php';

try {
    // 1. Total Seluruh Peserta
    $count_participants = $pdo->query("SELECT COUNT(*) FROM registrations")->fetchColumn();

    // 2. Total Artikel (Hanya yang mendaftar sebagai Presenter)
    $count_articles = $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Presenter'")->fetchColumn();

    // 3. Total Universitas (Menghitung institusi unik/berbeda)
    $count_universities = $pdo->query("SELECT COUNT(DISTINCT institution) FROM registrations")->fetchColumn();

    // 4. Total Negara (Menghitung negara unik/berbeda)
    $count_countries = $pdo->query("SELECT COUNT(DISTINCT country) FROM registrations")->fetchColumn();

    // 5. Total Non-Presenter
    $count_non_presenter = $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Non Presenter'")->fetchColumn();

    } catch (PDOException $e) {
        // Jika error, set default ke 0
        $count_participants = $count_articles = $count_universities = $count_countries = $count_non_presenter = 0;
    }
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digits - Digital Transformation & Sustainable Technologies</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Smooth scroll agar perpindahan antar section halus */
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <nav x-data="{ mobileMenu: false, downloadDrop: false }" 
     style="background-color: #070620;"
     class="fixed top-0 left-0 w-full z-50 py-4 shadow-lg border-b border-white border-opacity-10 transition-all duration-300 ease-in-out">
     
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center">
                <img src="img/logocohost/ubhinus_logo.png" alt="UBHINUS Logo" class="h-11 w-auto object-contain"> 
                <img src="img/logocohost/digits_lengkap.png" alt="Digits Logo" class="h-12 w-auto object-contain">
            </div>

            <div class="hidden lg:flex space-x-5 items-center">
                <a href="#home" class="text-sm font-medium text-white hover:text-blue-400 transition">Home</a>
                <a href="#about" class="text-sm font-medium text-white hover:text-blue-400 transition">About</a>
                <a href="#speakers" class="text-sm font-medium text-white hover:text-blue-400 transition">Speakers</a>
                <a href="#statistic" class="text-sm font-medium text-white hover:text-blue-400 transition">Statistics</a>
                <a href="#important-dates" class="text-sm font-medium text-white hover:text-blue-400 transition">Dates</a>
                <a href="#contact" class="text-sm font-medium text-white hover:text-blue-400 transition">Contact</a>
                
                <div class="relative" @click.away="downloadDrop = false">
                    <button @click="downloadDrop = !downloadDrop" class="flex items-center text-sm font-medium text-white hover:text-blue-400 focus:outline-none transition">
                        Download
                        <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="downloadDrop" x-transition class="absolute mt-2 w-48 bg-white rounded-md shadow-xl py-2 text-gray-800 border border-gray-100">
                        <a href="https://drive.google.com/drive/folders/1SsPUymvCXmxxPos-iWXtfDdknCGQUae2?usp=drive_link" class="block px-4 py-2 text-xs hover:bg-gray-100 transition">Guidebook</a>
                        <a href="https://docs.google.com/document/d/1otTs8b6cmrpYVtZVd_OCxYbRqzPFk-pL/edit?usp=sharing&ouid=100000270113189637214&rtpof=true&sd=true" target="_blank" class="block px-4 py-2 text-xs hover:bg-gray-100 transition">Abstract Template</a>
                    </div>
                </div>

                <a href="#archive" class="text-sm font-medium text-white hover:text-blue-400 transition">Archive</a>

                <a href="registration.php" class="border border-white text-white px-5 py-2 rounded-full text-xs font-semibold hover:bg-white hover:text-[#070620] transition-all duration-300">
                    Register
                </a>
            </div>

            <div class="lg:hidden">
                <button @click="mobileMenu = !mobileMenu" class="text-white focus:outline-none transition">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenu" 
         style="background-color: #070620;"
         class="lg:hidden shadow-xl text-white px-4 py-8 space-y-4 border-t border-white border-opacity-10 absolute w-full left-0 top-full">
        <a href="#home" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Home</a>
        <a href="#about" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">About</a>
        <a href="#speakers" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Speakers</a>
        <a href="#statistic" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Statistics</a>
        <a href="#important-dates" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Dates</a>
        <a href="#contact" @click="mobileMenu = false" class="block text-sm font-medium hover:text-blue-400">Contact</a>
        
        <div x-data="{ mobDownloadDrop: false }" class="space-y-2">
            <button @click="mobDownloadDrop = !mobDownloadDrop" class="flex items-center text-sm font-medium hover:text-blue-400 focus:outline-none w-full text-left">
                Download
                <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="mobDownloadDrop" class="pl-4 space-y-2 border-l border-white border-opacity-20">
                <a href="#" class="block text-xs hover:text-blue-400 py-1">Guidebook</a>
                <a href="#" class="block text-xs hover:text-blue-400 py-1">Abstract Template</a>
            </div>
        </div>

        <a href="#archive" class="block text-sm font-medium hover:text-blue-400">Archive</a>
        <a href="registration.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full text-xs font-semibold mt-4 w-full text-center">Register</a>
    </div>
</nav>
    <!-- Section Home -->
    
    <section id="home" class="relative w-full h-screen flex items-center overflow-hidden bg-gray-900 mt-[70px]"> 
        <div class="absolute inset-0 z-0">
            <img src="img/cover_home.png" 
                alt="ICoBITS Cover" 
                class="w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-blue-900 bg-opacity-10"></div>
        </div>

        <div class="relative z-10 px-6 md:px-8 lg:px-14 w-full">
            <div class="max-w-3xl text-left">
                <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight mb-6 drop-shadow-md">
                    Call For Papers!
                </h1>
                
                <div class="space-y-2 mb-10">
                    <p class="text-xl md:text-2xl text-gray-100 font-light tracking-wide">
                        The 1<sup>st</sup> International Conference
                    </p>
                    <p class="text-2xl md:text-4xl font-bold text-white uppercase leading-tight">
                        on Digital Transformation <br class="hidden md:block"> & Sustainable Technologies
                    </p>
                    <p class="text-lg md:text-xl text-gray-200 font-medium mt-6 border-l-4 border-blue-500 pl-5 max-w-2xl">
                        Advancing Digital Innovation for Sustainable <br class="hidden md:block"> Societal Impact and Global Collaboration
                    </p>
                </div>

                <a href="registration.php" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-10 rounded-md transition-all transform hover:scale-105 shadow-xl uppercase text-sm tracking-widest">
                    Register Now !
                </a>
            </div>
        </div>

        <a href="#about" class="absolute bottom-10 left-10 z-10 flex flex-col items-center text-white opacity-40 hover:opacity-100 transition animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7"></path>
            </svg>
        </a>
    </section>

     <!-- Section pre conference -->
    <section id="briefing" class="py-24 relative overflow-hidden border-b border-white/5 bg-[#05041a]">
    <!-- Efek Cahaya Latar Belakang (Glow Effect) -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="space-y-8 text-center sm:text-left">
            
            <!-- Header Informasi -->
            <div class="space-y-4">
                <div class="inline-block px-4 py-1 bg-green-500/10 border border-green-500/20 rounded-full text-green-400 text-[10px] font-black uppercase tracking-[0.2em]">
                    Upcoming Event
                </div>
                
                <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tight leading-none text-white">
                    Pre-Conference <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">Briefing Session</span>
                </h2>
                
                <p class="text-gray-400 font-medium text-sm md:text-base max-w-2xl mx-auto sm:mx-0">
                    Ikuti sesi sosialisasi dan pengarahan awal untuk mempersiapkan segala kebutuhan presentasi serta administrasi teknis sebelum konferensi utama dimulai.
                </p>
            </div>

            <!-- Grid Informasi Waktu & Tempat -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2 text-left">
                <!-- Tanggal -->
                <div class="glass-bg p-5 rounded-2xl flex items-center gap-4 bg-white/5 border border-white/10 backdrop-blur-md">
                    <div class="w-12 h-12 bg-green-500/20 text-green-400 rounded-xl flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Date</p>
                        <p class="text-white font-bold text-sm">July 20, 2026</p>
                    </div>
                </div>

                <!-- Jam -->
                <div class="glass-bg p-5 rounded-2xl flex items-center gap-4 bg-white/5 border border-white/10 backdrop-blur-md">
                    <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-xl flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Time</p>
                        <p class="text-white font-bold text-sm">10.00 - 11.00 AM</p>
                    </div>
                </div>

                <!-- Platform -->
                <div class="glass-bg p-5 rounded-2xl flex items-center gap-4 bg-white/5 border border-white/10 backdrop-blur-md">
                    <div class="w-12 h-12 bg-purple-500/20 text-purple-400 rounded-xl flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-video"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Platform</p>
                        <p class="text-white font-bold text-sm">Zoom & YouTube</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

    <!-- Section countdown -->
    <section id="countdown" class="py-32 relative overflow-hidden bg-slate-900">
    
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/cover_countdown.png" alt="Countdown Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/60"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <p id="countdown-label" class="text-yellow-400 font-bold uppercase tracking-[0.3em] text-xs md:text-sm mb-2">
                Submission Deadline
            </p>
            <h2 class="text-white font-black uppercase tracking-[0.4em] text-xl md:text-3xl mb-4">
                Paper Submission <span class="text-yellow-400"> Deadline </span>
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10">
            
            <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 md:p-12 flex flex-col items-center transition-all hover:bg-white/20 hover:-translate-y-2 shadow-2xl">
                <span id="days" class="text-5xl md:text-7xl font-black text-white mb-2">00</span>
                <span class="text-blue-100 text-sm md:text-base font-bold uppercase tracking-widest">Days</span>
            </div>

            <div class="group bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 md:p-12 flex flex-col items-center transition-all hover:bg-white/20 hover:-translate-y-2 shadow-2xl">
                <span id="hours" class="text-5xl md:text-7xl font-black text-white mb-2">00</span>
                <span class="text-blue-100 text-sm md:text-base font-bold uppercase tracking-widest">Hours</span>
            </div>

            <div class="group bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 md:p-12 flex flex-col items-center transition-all hover:bg-white/20 hover:-translate-y-2 shadow-2xl">
                <span id="minutes" class="text-5xl md:text-7xl font-black text-white mb-2">00</span>
                <span class="text-blue-100 text-sm md:text-base font-bold uppercase tracking-widest">Minutes</span>
            </div>

            <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 md:p-12 flex flex-col items-center transition-all hover:bg-white/20 hover:-translate-y-2 shadow-2xl">
                <span id="seconds" class="text-5xl md:text-7xl font-black text-yellow-400 mb-2">00</span>
                <span class="text-blue-100 text-sm md:text-base font-bold uppercase tracking-widest">Seconds</span>
            </div>

        </div>

        <div class="mt-12 text-center">
    <!-- Komponen Tanggal yang Dicoret dan Tanggal Baru -->
    <div class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-4 mb-8 text-sm md:text-base font-medium">
        <p class="text-red-400/70 line-through italic flex items-center gap-2">
            <i class="fas fa-calendar-times"></i> Deadline: June 24, 2026
        </p>
        <span class="hidden md:inline text-blue-100/40">➔</span>
        <p class="text-blue-100/90 bg-yellow-400/10 border border-yellow-400/20 px-4 py-2 rounded-2xl flex items-center gap-2">
            <i class="fas fa-calendar-check text-yellow-400 animate-pulse"></i> 
            Extended Deadline: <span class="text-yellow-400 font-black">July 1, 2026</span>
        </p>
    </div>

    <!-- Tombol Pendaftaran -->
    <a href="registration.php" class="inline-block bg-blue-600 text-white font-black px-12 py-4 rounded-full shadow-2xl hover:bg-yellow-400 hover:text-slate-900 transition-all transform hover:scale-105 uppercase tracking-[0.2em] text-sm">
        Submit Your Paper
    </a>
</div>

    </div>
</section>

    <!-- Section About Us -->

    <section id="about" class="relative w-full min-h-screen flex items-center overflow-hidden bg-[#070620] py-24 md:py-32">
    
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/cover_aboutus.png" 
             alt="About Us Background" 
             class="w-full h-full object-cover object-center" />
    </div>

    <div class="relative z-10 px-6 md:px-16 lg:px-24 w-full max-w-7xl mx-auto">
        <div class="max-w-4xl text-left">
            
            <h4 class="text-blue-400 font-bold uppercase tracking-widest text-sm mb-3 drop-shadow-lg">
                About Us
            </h4>

            <h2 class="text-4xl md:text-5xl font-extrabold text-white leading-tight tracking-tight mb-2 drop-shadow-xl">
                The 1<sup>st</sup> International Conference
            </h2>
            <h3 class="text-3xl md:text-4xl font-bold text-white uppercase leading-tight mb-10 drop-shadow-xl">
                on Digital Transformation <br class="hidden md:block"> & Sustainable Technologies
            </h3>
            
            <div class="w-20 h-1.5 bg-blue-500 rounded-full mb-10 shadow-lg"></div>

            <div class="space-y-6 text-white text-base md:text-lg leading-relaxed font-medium text-justify drop-shadow-md">
                <p>
                    The International Conference on Information Technology and Security (IC-ITECHS) is the annual international conference held by STIKI Malang, Indonesia.
                </p>
                <p>
                    Papers that are accepted and presented at IC-ITECH 2024 will be submitted for possible inclusion in International Proceeding indexed by Google Scholar and Indonesia National Journal. If an author fails to register for the conference or does not present their paper, the paper will be flagged as a 'no show' and removed from the conference proceedings.
                </p>
                <p>
                    The event is intended to provide the technical forum and research discussion related to advanced engineering on computer science, informatics and visual communication design. The conference is aimed to bring researchers, academicians, scientists, students, engineers and practitioners together to participate and present their latest research finding, developments and applications related to the various aspects of computer & telecommunication engineering, signal, image & video processing, soft computing, computer science, informatics and visual communication design.
                </p>
            </div>

        </div>
    </div>
</section>

    <!-- Section Registration Process -->

    <section id="registration" class="py-16 relative overflow-hidden bg-gradient-to-r from-cyan-500 to-blue-600">

    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/cover_prosesregis.png" alt="Countdown Background" class="w-full h-full object-cover">
    </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
            
            <h2 class="text-3xl md:text-4xl font-bold text-white text-center mb-16 tracking-wide drop-shadow-md">
                Registration Process
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-10 md:gap-y-14 gap-x-8">

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-1 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">01</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">Click Download to get the abstract template.</p>
                    <div class="hidden md:block absolute top-1/2 -right-6 -translate-y-1/2 text-white font-bold text-xl drop-shadow-md">›</div>
                </div>

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-2 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">02</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">Register at <br> <span class="italic text-blue-600">digits.ubhinus.ac.id/register</span></p>
                    <div class="hidden md:block absolute top-1/2 -right-6 -translate-y-1/2 text-white font-bold text-xl drop-shadow-md">›</div>
                </div>

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-3 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">03</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">Fill in the form, upload your abstract and proof of payment, then click Submit Registration.</p>
                    <div class="hidden md:block absolute top-1/2 -right-6 -translate-y-1/2 text-white font-bold text-xl drop-shadow-md">›</div>
                </div>

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-4 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">04</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">Please join the DIGITS 2026 WhatsApp group.</p>
                    <div class="hidden md:block absolute -bottom-10 left-1/2 -translate-x-1/2 text-white font-bold text-xl drop-shadow-md">⌄</div>
                </div>

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-5 md:order-8 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">05</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">Abstract Acceptance Announcement, Please check your emai <br> <span class="font-semibold italic text-blue-800">July 1, 2026</span></p>
                    <div class="hidden md:block absolute top-1/2 -left-6 -translate-y-1/2 text-white font-bold text-xl drop-shadow-md">‹</div>
                </div>

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-6 md:order-7 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">06</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">Upload your full paper at <br> <span class="italic text-blue-600">https://jurnal.ubhinus.ac.id/IC-ITECHS</span></p>
                    <div class="hidden md:block absolute top-1/2 -left-6 -translate-y-1/2 text-white font-bold text-xl drop-shadow-md">‹</div>
                </div>

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-7 md:order-6 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">07</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">Socialization Session <br> <span class="font-semibold italic text-blue-800">July 20, 2026</span></p>
                    <div class="hidden md:block absolute top-1/2 -left-6 -translate-y-1/2 text-white font-bold text-xl drop-shadow-md">‹</div>
                </div>

                <div class="bg-white rounded-lg p-5 pt-8 relative shadow-lg order-8 md:order-5 transition hover:-translate-y-1">
                    <div class="absolute -top-4 left-5 bg-blue-400 text-white font-bold py-1.5 px-3 rounded shadow-md text-sm">08</div>
                    <p class="text-sm text-gray-700 font-medium leading-relaxed">The 1st International Conference on Digital Transformation & Sustainable Technologies <br> <span class="font-semibold italic text-blue-800">July 22, 2026</span></p>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Tema -->

    <section id="theme" class="py-20 relative overflow-hidden bg-white text-center">

        <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/cover_theme.png" alt="Countdown Background" class="w-full h-full object-cover">
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 flex flex-col items-center">
            
            <span class="bg-gradient-to-r from-green-400 to-green-500 text-white font-extrabold px-10 py-2.5 rounded-full text-sm md:text-base shadow-sm mb-8 tracking-widest">
                THEME :
            </span>

            <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-blue-600 leading-snug uppercase mb-8">
                "Advancing Digital Innovation for Sustainable Societal Impact and Global Collaboration"
            </h2>

            <div class="w-16 h-0.5 bg-blue-600 mb-8"></div>

            <div class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded shadow-md font-semibold text-sm md:text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                July 22th, 2026
            </div>

        </div>
    </section>

    <!-- Section keynote Speaker -->
    <section id="speakers" class="py-24 relative overflow-hidden bg-white">
    
        <div class="absolute inset-0 z-0">
            <img src="img/coverhalaman/cover_theme.png" alt="Countdown Background" class="w-full h-full object-cover">
        </div>

    <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none z-0">
        <div class="absolute top-10 left-10 w-64 h-64 bg-green-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-20">
            <h2 class="text-3xl md:text-5xl font-black text-[#1800ad] uppercase tracking-wider">
                Keynote Speakers
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-16">

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 group">
               <div class="relative shrink-0 group">
                    <div class="absolute inset-0 bg-[#A3D977] transform -rotate-6 rounded-xl group-hover:rotate-0 transition-transform duration-300"></div> 
                    <div class="relative w-48 h-56 md:w-52 md:h-60 overflow-hidden rounded-xl border-2 border-white shadow-xl bg-gray-100">
                        <img src="img/keynotespeaker/Sugiyono2.jpg" alt="Prof.Sugiyono" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>
                <div class="text-center sm:text-left pt-4">
                    <h4 class="text-2xl md:text-3xl font-black text-blue-800 leading-tight mb-4">
                        Prof. Dr. <br> Sugiyono, M.Pd.
                    </h4>
                    <p class="text-sm md:text-base text-blue-900 font-medium leading-relaxed max-w-xs">
                        Recognized with 4 MURI Records in Research Methodology Indonesia
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 group">
                <div class="relative shrink-0">
                    <div class="absolute inset-0 bg-[#A3D977] transform -rotate-6 rounded-xl group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative w-48 h-56 md:w-52 md:h-60 overflow-hidden rounded-xl border-2 border-white shadow-xl">
                        <img src="img/keynotespeaker/prof lu dan.jpg" alt="Dr. Catherine" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>
                <div class="text-center sm:text-left pt-4">
                    <h4 class="text-2xl md:text-3xl font-black text-blue-800 leading-tight mb-4">
                        Prof. Dr. Lu Dan
                    </h4>
                    <p class="text-sm md:text-base text-blue-900 font-medium leading-relaxed max-w-xs">
                        President of Sanya University Chairman of ACAPHEI, China
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 group">
                <div class="relative shrink-0">
                    <div class="absolute inset-0 bg-[#A3D977] transform -rotate-6 rounded-xl group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative w-48 h-56 md:w-52 md:h-60 overflow-hidden rounded-xl border-2 border-white shadow-xl">
                        <img src="img/keynotespeaker/yuyimin.jpg" alt="Fadhilah Aman" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>
                <div class="text-center sm:text-left pt-4">
                    <h4 class="text-2xl md:text-3xl font-black text-blue-800 leading-tight mb-4">
                        Prof. Yu Yimin, Ph.D
                    </h4>
                    <p class="text-sm md:text-base text-blue-900 font-medium leading-relaxed max-w-xs">
                        Yunnan University of Finance and Economics (YUFE) China
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 group">
                <div class="relative shrink-0">
                    <div class="absolute inset-0 bg-[#A3D977] transform -rotate-6 rounded-xl group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative w-48 h-56 md:w-52 md:h-60 overflow-hidden rounded-xl border-2 border-white shadow-xl">
                        <img src="img/keynotespeaker/nurdiyana.jpg" alt="Prof. Yu Yimin" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>
                <div class="text-center sm:text-left pt-4">
                    <h4 class="text-2xl md:text-3xl font-black text-blue-800 leading-tight mb-4">
                        Dr. Nurdiyana Nazihah Zainal 
                    </h4>
                    <p class="text-sm md:text-base text-blue-900 font-medium leading-relaxed max-w-xs">
                        Universiti Teknologi Mara (UiTM)
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 group">
                <div class="relative shrink-0">
                    <div class="absolute inset-0 bg-[#A3D977] transform -rotate-6 rounded-xl group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative w-48 h-56 md:w-52 md:h-60 overflow-hidden rounded-xl border-2 border-white shadow-xl">
                        <img src="img/keynotespeaker/loriemel.jpg" alt="Dr. Catherine" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>
                <div class="text-center sm:text-left pt-4">
                    <h4 class="text-2xl md:text-3xl font-black text-blue-800 leading-tight mb-4">
                        Dr. Loriemel E. Ferrera
                    </h4>
                    <p class="text-sm md:text-base text-blue-900 font-medium leading-relaxed max-w-xs">
                        Dean of SCST, Colegio de San Juan de Letran Calamba, Philippines
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Section mc-moderator -->
    <!-- <section id="mc-moderator" class="py-12 bg-white relative overflow-hidden">
    
    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20">
            
            <div>
                <h2 class="text-2xl md:text-3xl font-black text-blue-900 text-center mb-10 uppercase tracking-widest">
                    Master of Ceremony
                </h2>
                
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 group">
                <div class="relative shrink-0">
                    <div class="absolute inset-0 bg-[#A3D977] transform -rotate-6 rounded-xl group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative w-48 h-56 md:w-52 md:h-60 overflow-hidden rounded-xl border-2 border-white shadow-xl">
                        <img src="img/keynotespeaker/mc-moderator.jpg" alt="Dr. Catherine" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="text-center sm:text-left pt-4">
                    <h4 class="text-2xl md:text-3xl font-black text-blue-800 leading-tight mb-4">
                        to be confirmed
                    </h4>
                    <p class="text-sm md:text-base text-blue-900 font-medium leading-relaxed max-w-xs">
                        to be confirmed
                    </p>
                </div>
            </div>
            </div>

            <div>
                <h2 class="text-2xl md:text-3xl font-black text-blue-900 text-center mb-10 uppercase tracking-widest">
                    Moderator
                </h2>
                
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 group">
                <div class="relative shrink-0">
                    <div class="absolute inset-0 bg-[#A3D977] transform -rotate-6 rounded-xl group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative w-48 h-56 md:w-52 md:h-60 overflow-hidden rounded-xl border-2 border-white shadow-xl">
                        <img src="img/keynotespeaker/mc-moderator.jpg" alt="Dr. Catherine" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="text-center sm:text-left pt-4">
                    <h4 class="text-2xl md:text-3xl font-black text-blue-800 leading-tight mb-4">
                        to be confirmed
                    </h4>
                    <p class="text-sm md:text-base text-blue-900 font-medium leading-relaxed max-w-xs">
                        to be confirmed
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>
</section> -->

    <!-- Section Co-Host -->
    <section id="co-hosts" class="py-24 relative overflow-hidden bg-[#070620]">
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 opacity-5 rounded-full blur-[100px] -mr-48 -mt-48"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-600 opacity-5 rounded-full blur-[100px] -ml-48 -mb-48"></div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-20">
            <h2 class="text-white font-black uppercase tracking-widest text-2xl md:text-3xl">
                Our Strategic Partners
            </h2>
            <p class="text-blue-400/60 text-[10px] mt-4 uppercase tracking-[0.4em] font-bold">Collaborate with DIGITS 2026</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">

            <div class="bg-white rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.3)] text-center transition-all duration-500 hover:-translate-y-2 group border border-white/5">
                <div class="mb-12">
                    <span class="inline-block bg-gradient-to-r from-blue-700 to-blue-500 text-white font-black px-10 py-2.5 rounded-full shadow-lg text-xs uppercase tracking-[0.2em]">
                        International Co-Host
                    </span>
                </div>
                
                <div class="flex flex-wrap justify-center items-center gap-8">
                    <img src="img/logocohost/Logo_yunan.png" alt="STIP Jakarta" 
                        class="h-20 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 hover:-translate-y-1 cursor-pointer">

                    <!-- <div class="border-2 border-dashed border-blue-200 rounded-2xl p-5 flex flex-col items-center justify-center min-w-[220px] bg-blue-50/30">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest leading-tight italic">Inviting Co-Hosts</p>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1">Join Our Global Network</p>
                    </div> -->
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.3)] text-center transition-all duration-500 hover:-translate-y-2 border border-white/5">
    
                <div class="mb-12">
                    <span class="inline-block bg-gradient-to-r from-blue-700 to-blue-500 text-white font-black px-10 py-2.5 rounded-full shadow-lg text-xs uppercase tracking-[0.2em]">
                        Domestic Co-Host
                    </span>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-10">
                    <img src="img/logocohost/Logo_STIP_Jakarta.png" alt="STIP Jakarta" 
                        class="h-20 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 hover:-translate-y-1 cursor-pointer">
                    <img src="img/logocohost/logo_serambimekah.png" alt="Universitas Serambi Mekkah" 
                        class="h-20 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 hover:-translate-y-1 cursor-pointer">
                    <img src="img/logocohost/logo_unitri.png" alt="Universitas Tribuana Tunggadewi" 
                        class="h-20 w-auto object-contain transition-all duration-300 ease-in-out hover:scale-110 hover:-translate-y-1 cursor-pointer">
                </div>
            </div>

            <!-- <div class="bg-white rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.3)] text-center transition-all duration-500 hover:-translate-y-2 group border border-white/5">
                <div class="mb-12">
                    <span class="inline-block bg-gradient-to-r from-blue-700 to-blue-500 text-white font-black px-10 py-2.5 rounded-full shadow-lg text-xs uppercase tracking-[0.2em]">
                        Sponsorship
                    </span>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-8">
                    <div class="opacity-30 grayscale group-hover:opacity-100 group-hover:grayscale-0 transition-all duration-700 flex flex-wrap justify-center gap-8">
                        <img src="https://placehold.jp/32/f0f0f0/666666/200x100.png?text=SPONSOR" alt="Logo" class="h-10 w-auto object-contain">
                    </div>
                    <div class="border-2 border-dashed border-cyan-200 rounded-2xl p-5 flex flex-col items-center justify-center min-w-[220px] bg-cyan-50/30">
                        <p class="text-[10px] font-black text-cyan-600 uppercase tracking-widest leading-tight italic">Your Brand Here</p>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1">Sponsorship Opportunity</p>
                    </div>
                </div>
            </div> -->

            <!-- <div class="bg-white rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.3)] text-center transition-all duration-500 hover:-translate-y-2 group border border-white/5">
                <div class="mb-12">
                    <span class="inline-block bg-gradient-to-r from-blue-700 to-blue-500 text-white font-black px-10 py-2.5 rounded-full shadow-lg text-xs uppercase tracking-[0.2em]">
                        Media Partner
                    </span>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-8">
                    <div class="opacity-30 grayscale group-hover:opacity-100 group-hover:grayscale-0 transition-all duration-700 flex flex-wrap justify-center gap-8">
                        <img src="https://placehold.jp/32/f0f0f0/666666/200x100.png?text=MEDIA+NET" alt="Logo" class="h-10 w-auto object-contain">
                    </div>
                    <div class="border-2 border-dashed border-indigo-200 rounded-2xl p-5 flex flex-col items-center justify-center min-w-[220px] bg-indigo-50/30">
                        <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest leading-tight italic">Inviting Media</p>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-1">Join Our Press Network</p>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</section>

    <!-- Section Statistic -->
    <section id="statistic" class="py-24 relative overflow-hidden bg-slate-900 text-center">
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/cover_statistic.png" alt="Statistic Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <h2 class="text-3xl md:text-5xl font-black text-white mb-4 uppercase tracking-wider drop-shadow-lg">
            Current Participation Overview
        </h2>
        <p class="text-gray-200 font-medium mb-16 tracking-wide drop-shadow-md">
            Join the growing number of participants making an impact today!
        </p>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-10">
            
            <div class="flex flex-col items-center group">
                <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                    <i class="fas fa-users"></i>
                </div>
                <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_participants ?></span>
                <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Participants</p>
            </div>

            <div class="flex flex-col items-center group">
                <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                    <i class="fas fa-file-alt"></i>
                </div>
                <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_articles ?></span>
                <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Articles Submitted</p>
            </div>

            <div class="flex flex-col items-center group">
                <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                    <i class="fas fa-university"></i>
                </div>
                <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_universities ?></span>
                <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Universities</p>
            </div>

            <div class="flex flex-col items-center group">
                <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                    <i class="fas fa-globe"></i>
                </div>
                <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_countries ?></span>
                <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Number of Countries Involved</p>
            </div>

            <div class="flex flex-col items-center col-span-2 md:col-span-1 group">
                <div class="text-white mb-6 text-5xl md:text-6xl transition-transform group-hover:scale-110 duration-300">
                    <i class="fas fa-user-friends"></i>
                </div>
                <span class="text-5xl md:text-6xl font-black text-white drop-shadow-xl"><?= $count_non_presenter ?></span>
                <div class="w-12 h-1 bg-white/40 my-4 rounded-full"></div>
                <p class="text-[10px] md:text-xs font-bold text-white uppercase tracking-widest px-2 opacity-90">Non Presenter Participants</p>
            </div>

        </div>
    </div>
</section>

        <!-- Section Scope Paper -->
        <section id="scope" class="py-24 relative overflow-hidden bg-[#070620]">
    
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-600/10 rounded-full blur-[120px]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-widest">
                Paper Scope
            </h2>
            <p class="text-blue-400 font-medium mt-2">Explore our areas of interest (but not limited to)</p>
        </div>

        <div class="relative group">
            
            <button id="prevBtn" class="absolute -left-6 top-1/2 -translate-y-1/2 z-30 w-14 h-14 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-all duration-300 opacity-0 group-hover:opacity-100 group-hover:left-2 shadow-2xl">
                <i class="fas fa-arrow-left"></i>
            </button>

            <div id="sliderWrapper" class="flex overflow-x-hidden scroll-smooth gap-8 px-4 py-10 snap-x snap-mandatory">
                
                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Artificial Intelligence, Machine Learning & Data Science</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Big Data & Cloud Computing</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Cybersecurity & Internet of Things (IoT)</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Digital Learning, EdTech & Future Skills</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Digital Business, E-Commerce & Entrepreneurship</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Digital Marketing & Global Competitiveness</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-city"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Smart City, Smart Tourism & Green Technology</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Digital Society, Ethics & Human-Centered Technology</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">Cross-Cultural Communication & Global Collaboration</h4>
                </div>

                <div class="min-w-[85%] md:min-w-[31%] snap-center bg-white/5 backdrop-blur-lg border border-white/10 rounded-[40px] p-10 flex flex-col items-center text-center transition-all duration-500 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-3 group/card">
                    <div class="w-24 h-24 bg-blue-500/20 rounded-3xl flex items-center justify-center text-blue-400 text-5xl mb-8 group-hover/card:bg-blue-500 group-hover/card:text-white transition-all duration-500 shadow-inner">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl leading-tight">IT/IS Governance, Audit & Technology Adoption</h4>
                </div>

            </div>

            <button id="nextBtn" class="absolute -right-6 top-1/2 -translate-y-1/2 z-30 w-14 h-14 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-all duration-300 opacity-0 group-hover:opacity-100 group-hover:right-2 shadow-2xl">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>

        <div class="mt-20 text-center">
            <div class="inline-block px-8 py-4 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md">
                <p class="text-blue-200 text-sm md:text-base font-medium">
                    Accepted papers will be published in the <span class="text-white font-bold italic">DIGITS 1st International Conference Proceedings</span>
                </p>
            </div>
        </div>
    </div>
</section>

        <!-- Section Benefit -->
        <section id="benefits" class="py-24 relative overflow-hidden bg-[#070620]">
    
    <div class="absolute inset-0 z-0 opacity-10">
        <div class="absolute top-1/2 -left-10 w-40 h-40 bg-blue-500 rounded-lg transform -translate-y-1/2 rotate-12"></div>
        <div class="absolute top-1/2 -right-10 w-40 h-40 bg-green-400 rounded-lg transform -translate-y-1/2 -rotate-12"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-widest">
                BENEFITS
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center items-stretch">

            <div class="flex flex-col items-center group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-10 shadow-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-2">
                <div class="w-28 h-28 mb-8 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                    <img src="img/icon/icon_grandprize.png" alt="Prize Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-bold text-white text-base md:text-lg leading-tight tracking-wide uppercase">
                    GRAND PRIZE: 100 USD<br>FOR #1 BEST PAPER
                </h3>
            </div>

            <div class="flex flex-col items-center group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-10 shadow-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-2">
                <div class="w-28 h-28 mb-8 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                    <img src="img/icon/icon_conference.png" alt="Workshop Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-bold text-white text-base md:text-lg leading-tight tracking-wide uppercase">
                    International proceedings publication (IC-ITECHS)
                </h3>
            </div>

            <div class="flex flex-col items-center group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-10 shadow-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50 hover:-translate-y-2">
                <div class="w-28 h-28 mb-8 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                    <img src="img/icon/icon_sertifikat.png" alt="Certificate Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-bold text-white text-base md:text-lg leading-tight tracking-wide uppercase">
                    E-CERTIFICATE
                </h3>
            </div>

        </div>

    </div>
</section>

        <!-- Important Dates -->
        <section id="important-dates" class="py-24 relative overflow-hidden bg-black">
    
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/cover_theme.png" 
             alt="Important Dates Background" 
             class="w-full h-full object-cover opacity-100" />
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-black text-black uppercase tracking-wider">
                Important Dates
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-transform hover:scale-105 duration-300">
                <div class="bg-blue-700 text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[160px]">
                    <span class="text-xl md:text-2xl font-black uppercase">24 JUN</span>
                    <span class="text-lg md:text-xl font-bold">2026</span>
                </div>
                <div class="bg-white flex-grow flex items-center px-6 py-4">
                    <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                        Deadline for Abstract Submission and Payment
                    </p>
                </div>
            </div>

            <div class="flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-transform hover:scale-105 duration-300">
                <div class="bg-blue-700 text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[160px]">
                    <span class="text-xl md:text-2xl font-black uppercase">01 JUL</span>
                    <span class="text-lg md:text-xl font-bold">2026</span>
                </div>
                <div class="bg-white flex-grow flex items-center px-6 py-4">
                    <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                        Abstract Acceptance Announcement
                    </p>
                </div>
            </div>

            <div class="flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-transform hover:scale-105 duration-300">
                <div class="bg-blue-700 text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[160px]">
                    <span class="text-xl md:text-2xl font-black uppercase">08 JUL</span>
                    <span class="text-lg md:text-xl font-bold">2026</span>
                </div>
                <div class="bg-white flex-grow flex items-center px-6 py-4">
                    <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                        Full Paper Submission Deadline
                    </p>
                </div>
            </div>

            <div class="flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-transform hover:scale-105 duration-300">
                <div class="bg-blue-700 text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[160px]">
                    <span class="text-xl md:text-2xl font-black uppercase">15 JUL</span>
                    <span class="text-lg md:text-xl font-bold">2026</span>
                </div>
                <div class="bg-white flex-grow flex items-center px-6 py-4">
                    <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                        Full Paper Acceptance Announcement
                    </p>
                </div>
            </div>

            <div class="flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-transform hover:scale-105 duration-300">
                <div class="bg-blue-700 text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[160px]">
                    <span class="text-xl md:text-2xl font-black uppercase">20 JUL</span>
                    <span class="text-lg md:text-xl font-bold">2026</span>
                </div>
                <div class="bg-white flex-grow flex items-center px-6 py-4">
                    <p class="text-[#070620] font-bold text-sm md:text-lg leading-tight">
                        Socialization and Briefing for Presenters
                    </p>
                </div>
            </div>

            <div class="flex items-stretch rounded-2xl overflow-hidden shadow-2xl transition-transform hover:scale-105 duration-300">
                <div class="bg-blue-600 text-white flex flex-col items-center justify-center px-4 py-4 min-w-[120px] md:min-w-[160px]">
                    <span class="text-xl md:text-2xl font-black uppercase">22 JUL</span>
                    <span class="text-lg md:text-xl font-bold">2026</span>
                </div>
                <div class="bg-white flex-grow flex items-center px-6 py-4">
                    <p class="text-blue-600 font-black text-xs md:text-base leading-tight">
                        The 1st International Conference on Digital Transformation and Sustainable Technology
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

        
        <!-- Important Fee -->
        <section id="registration-fee" class="py-24 relative overflow-hidden bg-[#070620]">
    
    <div class="absolute inset-0 z-0">
        <img src="img/coverhalaman/cover_prosesregis.png" 
             alt="Fee Background" 
             class="w-full h-full object-cover opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#070620]/50 via-transparent to-[#070620]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-widest">
                Registration Fee
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <div class="group">
                <div class="flex items-center mb-6">
                    <div class="bg-green-500 w-3 h-8 rounded-full mr-4 shadow-[0_0_15px_rgba(34,197,94,0.4)]"></div>
                    <h3 class="text-2xl font-bold text-white tracking-tight">Domestic Participants</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:border-green-500/50">
                        <span class="text-gray-300 font-medium">Student Presenter</span>
                        <div class="text-right">
                            <!-- <span class="text-sm text-gray-500 line-through mr-2">250,000</span> -->
                            <span class="text-xl font-black text-white">250,000 <span class="text-xs text-green-400 ml-1">IDR</span></span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:border-green-500/50">
                        <span class="text-gray-300 font-medium">Non-Student Presenter</span>
                        <div class="text-right">
                            <!-- <span class="text-sm text-gray-500 line-through mr-2">350,000</span> -->
                            <span class="text-xl font-black text-white">350,000 <span class="text-xs text-green-400 ml-1">IDR</span></span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:border-green-500/50">
                        <span class="text-gray-300 font-medium">Participant (Non-Presenter)</span>
                        <span class="text-xl font-black text-white">50,000 <span class="text-xs text-green-400 ml-1">IDR</span></span>
                    </div>
                </div>
            </div>

            <div class="group">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-500 w-3 h-8 rounded-full mr-4 shadow-[0_0_15px_rgba(59,130,246,0.4)]"></div>
                    <h3 class="text-2xl font-bold text-white tracking-tight">International Participants</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50">
                        <span class="text-gray-300 font-medium">Student Presenter</span>
                        <div class="text-right">
                            <!-- <span class="text-sm text-gray-500 line-through mr-2">21</span> -->
                            <span class="text-xl font-black text-white">21 <span class="text-xs text-blue-400 ml-1">USD</span></span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50">
                        <span class="text-gray-300 font-medium">Non-Student Presenter</span>
                        <div class="text-right">
                            <!-- <span class="text-sm text-gray-500 line-through mr-2">27</span> -->
                            <span class="text-xl font-black text-white">27 <span class="text-xs text-blue-400 ml-1">USD</span></span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:border-blue-500/50">
                        <span class="text-gray-300 font-medium">Participant (Non-Presenter)</span>
                        <span class="text-xl font-black text-white">6 <span class="text-xs text-blue-400 ml-1">USD</span></span>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-16 flex items-center justify-center space-x-4 text-gray-400 text-sm">
            <i class="fas fa-info-circle text-blue-500"></i>
            <p>Registration fee includes E-Certificate and Publication in Conference Proceedings.</p>
        </div>
    </div>
</section>

         <!-- Section CQuotes -->
        <section id="quote-section" class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="img/bgquotes.png" alt="Conference Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-[2px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-center">
            
            <div class="w-full md:w-2/3 lg:w-1/2 border-l-4 border-blue-500 pl-8 py-4">
                <blockquote class="relative">
                    <i class="fas fa-quote-left absolute -top-6 -left-4 text-4xl text-white/10"></i>
                    
                    <p class="text-white text-xl md:text-2xl font-medium italic leading-relaxed mb-6">
                        "Innovation is the ability to see change as an opportunity, not a threat. In the rapidly evolving world of technology, those who can embrace and harness the power of change will shape the future."
                    </p>
                    
                    <footer class="flex items-center gap-4">
                        <div class="h-px w-8 bg-blue-500"></div>
                        <div class="text-white">
                            <span class="block font-black uppercase tracking-widest text-sm">Steve Jobs</span>
                            <span class="block text-blue-400 text-xs font-bold mt-1">CEO of Apple</span>
                        </div>
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>
</section>

        <!-- Section Contact -->
        <section id="contact" class="py-24 relative overflow-hidden bg-[#0747b9]">
    
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute top-1/4 -left-10 w-32 h-40 bg-blue-400/30 rotate-12 rounded-lg"></div>
        <div class="absolute top-1/3 -right-10 w-24 h-40 bg-[#a3d977] -rotate-12 rounded-lg"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">
        
        <div class="mb-16">
            <div class="inline-block bg-[#00c853] text-white font-black px-12 py-3 rounded-sm shadow-xl uppercase tracking-widest text-lg md:text-2xl mb-6">
                Get In Touch With Us
            </div>
            <p class="text-white font-medium text-lg md:text-xl tracking-wide">
                Still have Questions? Contact Us using the Form below
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-24">
            
            <div class="relative border border-white/30 rounded-2xl p-8 pt-16 bg-white/5 backdrop-blur-sm transition-all hover:bg-white/10 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fas fa-map-marker-alt text-3xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">Our Headquarters</h4>
                <p class="text-white text-sm leading-relaxed font-medium">
                    Bhinneka Nusantara University
                </p>
            </div>

            <div class="relative border border-white/30 rounded-2xl p-8 pt-16 bg-white/5 backdrop-blur-sm transition-all hover:bg-white/10 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fab fa-whatsapp text-4xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">Ask Us</h4>
                <div class="text-white text-sm font-bold space-y-1">
                    <p>+62 813-3260-2997 <span class="font-normal">(Icha)</span></p>
                </div>
            </div>

            <div class="relative border border-white/30 rounded-2xl p-8 pt-16 bg-white/5 backdrop-blur-sm transition-all hover:bg-white/10 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fas fa-envelope text-3xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">Mail Us</h4>
                <p class="text-white text-sm font-bold break-all">
                    conference@ubhinus.ac.id
                </p>
            </div>

            <div class="relative border border-white/30 rounded-2xl p-8 pt-16 bg-white/5 backdrop-blur-sm transition-all hover:bg-white/10 group">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center text-[#0747b9] shadow-2xl transition-transform group-hover:scale-110">
                    <i class="fab fa-instagram text-3xl"></i>
                </div>
                <h4 class="text-white font-black text-lg uppercase tracking-tight mb-4">Our Instagram</h4>
                <p class="text-white text-sm font-bold">
                    @conference.ubhinus
                </p>
            </div>

        </div>
    </div>
</section>


        <footer class="bg-black pt-16 pb-12 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none z-0 opacity-20">
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-blue-900 rounded-full blur-[100px]"></div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-blue-900 rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-12">
            
            <div class="flex flex-col items-center md:items-start">
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-6 mb-8">
                    <img src="img/logocohost/ubhinus_logo.png" alt="University Logo" class="h-12 md:h-16 w-auto object-contain">
                    <img src="img/logocohost/digits_lengkap.png" alt="Digits Logo" class="h-12 md:h-16 w-auto object-contain">
                </div>
                <p class="text-white text-[10px] md:text-xs italic tracking-wide opacity-90">
                    Copyrights &copy; 2026 All Rights Reserved by UBHINUS International Student Conference.
                </p>
            </div>

            <div class="flex flex-col items-center md:items-end w-full md:w-auto">
                <nav class="mb-8">
                    <ul class="flex flex-wrap justify-center md:justify-end gap-1 text-white text-xs md:text-sm font-medium">
                        <li><a href="#home" class="hover:text-blue-400 transition-colors">Home</a> /</li>
                        <li><a href="#about" class="hover:text-blue-400 transition-colors">About</a> /</li>
                        <li><a href="#speakers" class="hover:text-blue-400 transition-colors">Speakers</a> /</li>
                        <li><a href="#statistic" class="hover:text-blue-400 transition-colors">Statistics</a> /</li>
                        <li><a href="#important-dates" class="hover:text-blue-400 transition-colors">Dates</a> /</li>
                        <li><a href="#contact" class="hover:text-blue-400 transition-colors">Contact</a></li>
                    </ul>
                </nav>

                <div class="flex gap-4">
                    <a href="https://www.facebook.com/conference.ubhinus/" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-xl">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="https://www.instagram.com/conference.ubhinus/" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-xl">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="mailto:conference@ubhinus.ac.id" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black hover:bg-blue-400 hover:text-white transition-all duration-300 shadow-xl">
                        <i class="fas fa-envelope text-lg"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</footer>

<script>
    // --- LOGIKA COUNTDOWN DIALIKAN KE 1 JULI 2026 ---
const submissionDeadline = new Date("Jul 1, 2026 23:59:59").getTime();

const countdownSubmission = setInterval(function () {

    const now = new Date().getTime();
    const distance = submissionDeadline - now;

    // Jika deadline baru (1 Juli) sudah lewat
    if (distance <= 0) {

        clearInterval(countdownSubmission);

        document.getElementById("countdown-label").innerHTML = "Submission Closed";

        document.getElementById("days").innerHTML = "00";
        document.getElementById("hours").innerHTML = "00";
        document.getElementById("minutes").innerHTML = "00";
        document.getElementById("seconds").innerHTML = "00";

        const btnSubmit = document.querySelector('a[href="registration.php"]');

        if (btnSubmit) {
            btnSubmit.innerHTML = "Submission Closed";
            btnSubmit.classList.remove("bg-blue-600", "hover:bg-yellow-400", "hover:text-slate-900", "hover:scale-105");
            btnSubmit.classList.add("bg-gray-500", "cursor-not-allowed");
            
            // Kunci akses tombol
            btnSubmit.setAttribute("onclick", "return false;");
        }

        return;
    }

    // Hitung waktu tersisa menuju 1 Juli
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor(
        (distance % (1000 * 60 * 60)) / (1000 * 60)
    );
    const seconds = Math.floor(
        (distance % (1000 * 60)) / 1000
    );

    // Render hasil sisa waktu ke komponen HTML
    document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
    document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
    document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
    document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;

    document.getElementById("countdown-label").innerHTML = "Paper Submission Deadline";

}, 1000);

    // --- 2. LOGIKA SLIDER SCOPE ---
    const wrapper = document.getElementById('sliderWrapper');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');

    if (wrapper && nextBtn && prevBtn) {
        nextBtn.addEventListener('click', () => {
            const cardWidth = wrapper.querySelector('div').offsetWidth + 32; // Width + gap
            wrapper.scrollBy({ left: cardWidth, behavior: 'smooth' });
        });

        prevBtn.addEventListener('click', () => {
            const cardWidth = wrapper.querySelector('div').offsetWidth + 32;
            wrapper.scrollBy({ left: -cardWidth, behavior: 'smooth' });
        });
    }
</script>
</body>
</html>