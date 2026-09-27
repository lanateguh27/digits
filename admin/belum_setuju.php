<?php
require_once '../config.php';
require_once 'auth_check.php';
$pending = $pdo->query("SELECT * FROM registrations WHERE apply = 'Pending' ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Review - DIGITS 2026</title>
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
            background: linear-gradient(to right, #ea580c, #f97316);
            box-shadow: 0 10px 20px rgba(234, 88, 12, 0.3);
        }
        .custom-table tr { transition: all 0.3s ease; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .custom-table tr:hover { background: rgba(255,255,255,0.05); }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #05041a; }
        ::-webkit-scrollbar-thumb { background: #1e1b4b; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen overflow-x-hidden">

    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-600/5 rounded-full blur-[120px]"></div>
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
            <a href="belum_setuju.php" class="flex items-center gap-4 p-4 sidebar-active rounded-2xl font-bold text-sm transition-all group text-white">
                <i class="fas fa-user-clock group-hover:scale-110 transition-transform"></i> Pending Review
            </a>
            <a href="sudah_setuju.php" class="flex items-center gap-4 p-4 text-gray-400 hover:bg-white/5 hover:text-white rounded-2xl text-sm font-semibold transition-all group">
                <i class="fas fa-user-check group-hover:scale-110 transition-transform text-green-400"></i> Verified Data
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
            <div class="inline-block px-4 py-1 bg-orange-500/10 border border-orange-500/20 rounded-full text-orange-500 text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                Action Required
            </div>
            <h2 class="text-4xl font-black uppercase tracking-tight">Pending <span class="text-orange-500">Review</span></h2>
            <p class="text-gray-400 font-medium mt-2">Check details and approve new registrations.</p>
        </header>

        <div class="glass-bg rounded-[2.5rem] overflow-hidden shadow-2xl">
            <table class="w-full text-left custom-table">
                <thead class="bg-white/5 text-[10px] uppercase font-black text-gray-400 tracking-[0.2em]">
                    <tr>
                        <th class="p-6">ID</th>
                        <th class="p-6">Type</th>
                        <th class="p-6">Email Address</th>
                        <th class="p-6">Author 1</th>
                        <th class="p-6">Files</th>
                        <th class="p-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-300">
                    <?php if(empty($pending)): ?>
                        <tr>
                            <td colspan="6" class="p-20 text-center text-gray-500 italic">No pending registrations found.</td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php foreach($pending as $row): ?>
                    <tr>
                        <td class="p-6 font-bold text-gray-500">#<?= $row['id'] ?></td>
                        <td class="p-6">
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-lg text-[10px] font-black uppercase border border-blue-500/20">
                                <?= $row['type'] ?>
                            </span>
                        </td>
                        <td class="p-6 font-medium"><?= $row['email'] ?></td>
                        <td class="p-6 text-white font-bold"><?= $row['author1'] ?></td>
                        <td class="p-6">
                            <div class="flex gap-4">
                                <?php if (!empty($row['abstract_file'])): ?>
                                    <a href="../uploads/abstracts/<?= $row['abstract_file'] ?>" download="<?= $row['abstract_file'] ?>" target="_blank" class="w-8 h-8 bg-blue-500/20 text-blue-400 rounded-lg flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all shadow-lg" title="Open & Download Abstract">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                <?php else: ?>
                                    <div class="w-8 h-8 bg-white/5 text-gray-600 rounded-lg flex items-center justify-center cursor-not-allowed" title="No Abstract Uploaded">
                                        <i class="fas fa-file-pdf opacity-20"></i>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($row['payment_receipt'])): ?>
                                    <a href="../uploads/receipts/<?= $row['payment_receipt'] ?>" target="_blank" class="w-8 h-8 bg-pink-500/20 text-pink-400 rounded-lg flex items-center justify-center hover:bg-pink-500 hover:text-white transition-all shadow-lg" title="View Receipt Picture">
                                        <i class="fas fa-receipt"></i>
                                    </a>
                                <?php else: ?>
                                    <div class="w-8 h-8 bg-white/5 text-gray-600 rounded-lg flex items-center justify-center cursor-not-allowed" title="No Receipt">
                                        <i class="fas fa-receipt opacity-20"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center justify-center gap-4">
                                <button onclick="openDetail(<?= htmlspecialchars(json_encode($row)) ?>)" class="bg-white/10 hover:bg-orange-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-xl">
                                    Detail
                                </button>
                                <a href="actions.php?delete=<?= $row['id'] ?>&from=belum" onclick="return confirm('Hapus Permanen?')" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-red-500 transition-colors">
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
                <h3 class="text-3xl font-black uppercase tracking-tight">Registration <span class="text-blue-500">Detail</span></h3>
                <div class="h-1 w-16 bg-orange-500 mt-3 rounded-full"></div>
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
                    <h4 class="text-[10px] font-black uppercase text-blue-400 tracking-[0.2em] flex items-center gap-2">
                        <i class="fas fa-info-circle"></i> General Information
                    </h4>
                    <div class="bg-white/5 p-5 rounded-2xl border border-white/5 space-y-2 text-sm">
                        <p class="text-gray-400">ID Peserta: <span class="text-white font-bold ml-2">#${data.id}</span></p>
                        <p class="text-gray-400">Tipe Partisipasi: <span class="text-blue-400 font-black uppercase ml-2">${data.type}</span></p>
                        <p class="text-gray-400">Kategori: <span class="text-white font-semibold ml-2">${data.category}</span></p>
                        <p class="text-gray-400">Email: <span class="text-white font-semibold ml-2">${data.email}</span></p>
                    </div>
                </div>
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-blue-400 tracking-[0.2em] flex items-center gap-2">
                        <i class="fas fa-university"></i> Institution Details
                    </h4>
                    <div class="bg-white/5 p-5 rounded-2xl border border-white/5 space-y-2 text-sm">
                        <p class="text-gray-400">Institusi: <span class="text-white font-semibold ml-2">${data.institution}</span></p>
                        <p class="text-gray-400">Country: <span class="text-white font-semibold ml-2">${data.country}</span></p>
                        <p class="text-gray-400">WhatsApp: <span class="text-white font-semibold ml-2">${data.phone}</span></p>
                        <p class="text-gray-400">Group: <span class="text-white font-semibold ml-2">${data.group_name || '-'}</span></p>
                    </div>
                </div>
                <div class="col-span-full space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-blue-400 tracking-[0.2em] flex items-center gap-2">
                        <i class="fas fa-users"></i> Authors Team
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5"><span class="text-[9px] text-gray-500 uppercase block mb-1">Author 1</span><span class="font-bold">${data.author1}</span></div>
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5"><span class="text-[9px] text-gray-500 uppercase block mb-1">Author 2</span><span class="font-bold">${data.author2 || '-'}</span></div>
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5"><span class="text-[9px] text-gray-500 uppercase block mb-1">Author 3</span><span class="font-bold">${data.author3 || '-'}</span></div>
                    </div>
                </div>
                <div class="col-span-full space-y-4 bg-blue-600/10 p-6 rounded-[2rem] border border-blue-500/20">
                    <h4 class="text-[10px] font-black uppercase text-blue-400 tracking-[0.2em]">Scientific Paper Title</h4>
                    <p class="text-white font-black text-xl italic leading-tight">"${data.paper_title}"</p>
                </div>
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-blue-400 tracking-[0.2em]">Documents</h4>
                    <div class="flex gap-4">
                        ${data.abstract_file 
                            ? `<a href="../uploads/abstracts/${data.abstract_file}" download="${data.abstract_file}" target="_blank" class="flex-1 py-3 bg-blue-500 text-white rounded-xl text-[10px] font-black uppercase text-center tracking-widest hover:bg-blue-600 transition shadow-lg shadow-blue-500/20">Open & Download Abstract</a>`
                            : `<span class="flex-1 py-3 bg-white/5 text-gray-500 rounded-xl text-[10px] font-black uppercase text-center tracking-widest border border-white/5 cursor-not-allowed">No Abstract</span>`
                        }
                        
                        ${data.payment_receipt 
                            ? `<a href="../uploads/receipts/${data.payment_receipt}" target="_blank" class="flex-1 py-3 bg-pink-600 text-white rounded-xl text-[10px] font-black uppercase text-center tracking-widest hover:bg-pink-700 transition shadow-lg shadow-pink-600/20">View Receipt Image</a>`
                            : `<span class="flex-1 py-3 bg-white/5 text-gray-500 rounded-xl text-[10px] font-black uppercase text-center tracking-widest border border-white/5 cursor-not-allowed">No Receipt</span>`
                        }
                    </div>
                </div>
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase text-blue-400 tracking-[0.2em]">Current Status</h4>
                    <div class="px-6 py-3 bg-orange-500/20 border border-orange-500/30 rounded-xl inline-block">
                        <span class="text-orange-500 text-xs font-black uppercase tracking-widest">
                            <i class="fas fa-clock mr-2"></i> Waiting Approval
                        </span>
                    </div>
                </div>
            </div>
        `;

        footer.innerHTML = `<button onclick="closeModal()" class="px-8 py-3 text-gray-500 font-bold uppercase text-[10px] hover:text-white tracking-widest transition-colors">Close</button>`;
        
        if(data.apply === 'Pending') {
            footer.innerHTML += `<a href="actions.php?approve=${data.id}" class="px-12 py-3 bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-blue-500/30 hover:scale-105 transition-all">Verify & Approve Now</a>`;
        }

        document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }

    document.addEventListener('keydown', (e) => { if(e.key === 'Escape') closeModal(); });
</script>
    
</body>
</html>