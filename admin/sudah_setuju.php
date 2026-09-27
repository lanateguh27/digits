<?php
require_once '../config.php';
require_once 'auth_check.php';
$verified = $pdo->query("SELECT * FROM registrations WHERE apply = 'Verified' ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verified Data - DIGITS 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800;900&display=swap');
        body { font-family: 'Montserrat', sans-serif; background-color: #05041a; color: white; }
        
        .glass-bg {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-active {
            background: linear-gradient(to right, #059669, #10b981);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }
        .custom-table tr { transition: all 0.3s ease; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .custom-table tr:hover { background: rgba(16, 185, 129, 0.05); }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #05041a; }
        ::-webkit-scrollbar-thumb { background: #065f46; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen overflow-x-hidden">

    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-green-600/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
    </div>

    <aside class="w-72 bg-[#070620]/80 backdrop-blur-xl border-r border-white/5 min-h-screen p-8 fixed z-20 flex flex-col">
        <div class="flex items-center gap-3 mb-12 px-2">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/40">
                <i class="fas fa-microchip text-white"></i>
            </div>
            <h1 class="text-2xl font-black tracking-tighter uppercase">Digits <span class="text-blue-500">Admin</span></h1>
        </div>
        
        <nav class="space-y-4 flex-grow">
            <a href="index.php" class="flex items-center gap-4 p-4 text-gray-400 hover:bg-white/5 hover:text-white rounded-2xl text-sm font-semibold transition-all group">
                <i class="fas fa-chart-pie group-hover:scale-110 transition-transform"></i> Dashboard
            </a>
            <a href="belum_setuju.php" class="flex items-center gap-4 p-4 text-gray-400 hover:bg-white/5 hover:text-white rounded-2xl text-sm font-semibold transition-all group">
                <i class="fas fa-user-clock group-hover:scale-110 transition-transform text-orange-400"></i> Pending Review
            </a>
            <a href="sudah_setuju.php" class="flex items-center gap-4 p-4 sidebar-active rounded-2xl font-bold text-sm transition-all group text-white">
                <i class="fas fa-user-check group-hover:scale-110 transition-transform"></i> Verified Data
            </a>
        </nav>

        <div class="pt-8 border-t border-white/5">
            <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center gap-4 p-4 text-red-400 hover:bg-red-500/10 rounded-2xl text-sm font-bold transition-all">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 ml-72 p-12 relative z-10">
        <header class="mb-12">
            <div class="inline-block px-4 py-1 bg-green-500/10 border border-green-500/20 rounded-full text-green-500 text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                Verified Database
            </div>
            <h2 class="text-4xl font-black uppercase tracking-tight">Sudah <span class="text-green-500">Disetujui</span></h2>
            <p class="text-gray-400 font-medium mt-2">List pendaftar yang telah berhasil divalidasi pembayarannya.</p>
            <a href="export_excel.php" class="flex items-center gap-3 bg-white/5 hover:bg-green-600 border border-white/10 text-white px-8 py-3 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all shadow-xl group">
                <i class="fas fa-file-excel text-green-500 group-hover:text-white text-base"></i>
                Export to Excel
            </a>
        </header>

        <div class="glass-bg rounded-[2.5rem] overflow-hidden shadow-2xl">
            <table class="w-full text-left custom-table">
                <thead class="bg-white/5 text-[10px] uppercase font-black text-gray-400 tracking-[0.2em]">
                    <tr>
                        <th class="p-6">ID</th>
                        <th class="p-6">Type</th>
                        <th class="p-6">Email Address</th>
                        <th class="p-6">Author 1</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-300">
                    <?php if(empty($verified)): ?>
                        <tr>
                            <td colspan="6" class="p-20 text-center text-gray-500 italic">No verified records yet.</td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php foreach($verified as $row): ?>
                    <tr>
                        <td class="p-6 font-bold text-gray-500">#<?= $row['id'] ?></td>
                        <td class="p-6">
                            <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-lg text-[10px] font-black uppercase border border-green-500/20">
                                <?= $row['type'] ?>
                            </span>
                        </td>
                        <td class="p-6 font-medium italic opacity-70"><?= $row['email'] ?></td>
                        <td class="p-6 text-white font-bold"><?= $row['author1'] ?></td>
                        <td class="p-6">
                            <div class="flex items-center gap-2 text-green-500 font-black text-[10px] uppercase tracking-widest">
                                <i class="fas fa-check-circle"></i> Verified
                            </div>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center justify-center gap-4">
                                <button onclick="openDetail(<?= htmlspecialchars(json_encode($row)) ?>)" class="bg-white/10 hover:bg-blue-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                    Detail
                                </button>
                                <a href="actions.php?delete=<?= $row['id'] ?>&from=sudah" onclick="return confirm('Hapus Permanen?')" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <div id="modalDetail" class="fixed inset-0 bg-[#05041a]/80 backdrop-blur-md hidden z-50 flex items-center justify-center p-6">
        <div class="glass-bg rounded-[3rem] shadow-2xl max-w-3xl w-full p-10 overflow-y-auto max-h-[90vh] relative border border-white/10">
            <button onclick="closeModal()" class="absolute top-8 right-8 text-gray-400 hover:text-white text-3xl transition-colors">&times;</button>
            
            <div class="mb-10">
                <h3 class="text-3xl font-black uppercase tracking-tight">Verified <span class="text-green-500">Record</span></h3>
                <div class="h-1 w-16 bg-green-500 mt-3 rounded-full"></div>
            </div>

            <div id="modalBody" class="space-y-10"></div>

            <div id="modalFooter" class="mt-12 flex justify-end gap-4 border-t border-white/5 pt-8"></div>
        </div>
    </div>

<script>
    function openDetail(data) {
        const body = document.getElementById('modalBody');
        const footer = document.getElementById('modalFooter');

        body.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-green-500 tracking-[0.2em] flex items-center gap-2">
                        <i class="fas fa-id-card"></i> Registrant Info
                    </h4>
                    <div class="bg-white/5 p-5 rounded-2xl border border-white/5 space-y-2 text-sm">
                        <p class="text-gray-400">ID: <span class="text-white font-bold ml-2">#${data.id}</span></p>
                        <p class="text-gray-400">Type: <span class="text-green-400 font-black uppercase ml-2">${data.type}</span></p>
                        <p class="text-gray-400">Category: <span class="text-white font-semibold ml-2">${data.category}</span></p>
                        <p class="text-gray-400">Email: <span class="text-white font-semibold ml-2">${data.email}</span></p>
                    </div>
                </div>
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-green-500 tracking-[0.2em] flex items-center gap-2">
                        <i class="fas fa-building"></i> Affiliation
                    </h4>
                    <div class="bg-white/5 p-5 rounded-2xl border border-white/5 space-y-2 text-sm">
                        <p class="text-gray-400">Institusi: <span class="text-white font-semibold ml-2">${data.institution}</span></p>
                        <p class="text-gray-400">Country: <span class="text-white font-semibold ml-2">${data.country}</span></p>
                        <p class="text-gray-400">Phone: <span class="text-white font-semibold ml-2">${data.phone}</span></p>
                    </div>
                </div>
                <div class="col-span-full space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-green-500 tracking-[0.2em]">Scientific Authors</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-green-500/5 p-3 rounded-xl border border-green-500/10 font-bold text-center">${data.author1}</div>
                        ${data.author2 ? `<div class="bg-white/5 p-3 rounded-xl border border-white/5 text-center">${data.author2}</div>` : ''}
                        ${data.author3 ? `<div class="bg-white/5 p-3 rounded-xl border border-white/5 text-center">${data.author3}</div>` : ''}
                    </div>
                </div>
                <div class="col-span-full space-y-4 bg-green-600/10 p-6 rounded-[2rem] border border-green-500/20">
                    <h4 class="text-[10px] font-black uppercase text-green-500 tracking-[0.2em]">Validated Paper Title</h4>
                    <p class="text-white font-black text-xl italic leading-tight">"${data.paper_title}"</p>
                </div>
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-green-500 tracking-[0.2em]">Verified Assets</h4>
                    <div class="flex gap-4">
                        <a href="../uploads/abstracts/${data.abstract_file}" target="_blank" class="flex-1 py-3 bg-white/5 text-white border border-white/10 rounded-xl text-[10px] font-black uppercase text-center tracking-widest hover:bg-blue-600 transition transition-all">Abstract</a>
                        <a href="../uploads/receipts/${data.payment_receipt}" target="_blank" class="flex-1 py-3 bg-white/5 text-white border border-white/10 rounded-xl text-[10px] font-black uppercase text-center tracking-widest hover:bg-pink-600 transition transition-all">Receipt</a>
                    </div>
                </div>
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-green-500 tracking-[0.2em]">Validation Status</h4>
                    <div class="px-6 py-3 bg-green-500 text-black rounded-xl inline-block shadow-lg shadow-green-500/20">
                        <span class="text-xs font-black uppercase tracking-widest">
                            <i class="fas fa-verified mr-2"></i> Fully Verified
                        </span>
                    </div>
                </div>
            </div>
        `;

        footer.innerHTML = `<button onclick="closeModal()" class="px-12 py-3 bg-white/10 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-white/20 transition-all">Close Details</button>`;

        document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }
</script>
    
</body>
</html>