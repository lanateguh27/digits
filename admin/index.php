<?php
require_once '../config.php';
require_once 'auth_check.php';

$stats = [
    'total' => $pdo->query("SELECT COUNT(*) FROM registrations")->fetchColumn(),
    'presenter' => $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Presenter'")->fetchColumn(),
    'non_presenter' => $pdo->query("SELECT COUNT(*) FROM registrations WHERE type = 'Non Presenter'")->fetchColumn(),
    'verified' => $pdo->query("SELECT COUNT(*) FROM registrations WHERE apply = 'Verified'")->fetchColumn()
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DIGITS 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800;900&display=swap');
        body { font-family: 'Montserrat', sans-serif; background-color: #05041a; color: white; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-5px);
        }
        .sidebar-active {
            background: linear-gradient(to right, #2563eb, #3b82f6);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body class="flex min-h-screen overflow-x-hidden">

    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-cyan-600/10 rounded-full blur-[120px]"></div>
    </div>

    <aside class="w-72 bg-[#070620]/80 backdrop-blur-xl border-r border-white/5 min-h-screen p-8 fixed z-20 flex flex-col">
        <div class="flex items-center gap-3 mb-12 px-2">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/40">
                <i class="fas fa-microchip text-white"></i>
            </div>
            <h1 class="text-2xl font-black tracking-tighter uppercase">Digits <span class="text-blue-500">Admin</span></h1>
        </div>
        
        <nav class="space-y-4 flex-grow">
            <a href="index.php" class="flex items-center gap-4 p-4 sidebar-active rounded-2xl font-bold text-sm transition-all group">
                <i class="fas fa-chart-pie group-hover:scale-110 transition-transform"></i> Dashboard
            </a>
            <a href="belum_setuju.php" class="flex items-center gap-4 p-4 text-gray-400 hover:bg-white/5 hover:text-white rounded-2xl text-sm font-semibold transition-all group">
                <i class="fas fa-user-clock group-hover:scale-110 transition-transform text-orange-400"></i> Pending Review
            </a>
            <a href="sudah_setuju.php" class="flex items-center gap-4 p-4 text-gray-400 hover:bg-white/5 hover:text-white rounded-2xl text-sm font-semibold transition-all group">
                <i class="fas fa-user-check group-hover:scale-110 transition-transform text-green-400"></i> Verified Data
            </a>
        </nav>

        <div class="pt-8 border-t border-white/5">
            <a href="logout.php" 
               onclick="return confirm('Apakah Anda yakin ingin keluar?')"
               class="flex items-center gap-4 p-4 text-red-400 hover:bg-red-500/10 rounded-2xl text-sm font-bold transition-all">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 ml-72 p-12 relative z-10">
        <header class="mb-16 flex justify-between items-end">
            <div>
                <h2 class="text-4xl font-black uppercase tracking-tight">System <span class="text-blue-500">Dashboard</span></h2>
                <p class="text-gray-400 font-medium mt-2">Welcome back, Admin. Here's the latest conference update.</p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-xs font-bold text-blue-400 uppercase tracking-widest"><?= date('l, d F Y') ?></p>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="glass-card p-8 rounded-[2.5rem] flex flex-col items-center group">
                <div class="w-16 h-16 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center mb-6 text-2xl group-hover:bg-blue-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-users"></i>
                </div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">Total Registrant</p>
                <h3 class="text-5xl font-black tracking-tighter"><?= $stats['total'] ?></h3>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem] flex flex-col items-center group">
                <div class="w-16 h-16 bg-purple-500/20 text-purple-400 rounded-2xl flex items-center justify-center mb-6 text-2xl group-hover:bg-purple-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-microphone"></i>
                </div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">Presenters</p>
                <h3 class="text-5xl font-black tracking-tighter"><?= $stats['presenter'] ?></h3>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem] flex flex-col items-center group">
                <div class="w-16 h-16 bg-cyan-500/20 text-cyan-400 rounded-2xl flex items-center justify-center mb-6 text-2xl group-hover:bg-cyan-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-user-friends"></i>
                </div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">Non-Presenters</p>
                <h3 class="text-5xl font-black tracking-tighter"><?= $stats['non_presenter'] ?></h3>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem] flex flex-col items-center group">
                <div class="w-16 h-16 bg-green-500/20 text-green-400 rounded-2xl flex items-center justify-center mb-6 text-2xl group-hover:bg-green-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-check-double"></i>
                </div>
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">Verified Apply</p>
                <h3 class="text-5xl font-black tracking-tighter text-green-400"><?= $stats['verified'] ?></h3>
            </div>

        </div>

        <div class="mt-12 p-8 glass-card rounded-[2rem] border-blue-500/20 bg-blue-500/5 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <div class="text-blue-500 text-3xl animate-pulse">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <h4 class="font-bold text-lg">Secure Administration Area</h4>
                    <p class="text-gray-400 text-sm">All registration data is encrypted and protected by UBHINUS Security Protocol.</p>
                </div>
            </div>
            <button class="px-6 py-3 bg-white/5 hover:bg-white/10 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">
                View Logs
            </button>
        </div>
    </main>

</body>
</html>