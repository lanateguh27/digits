<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ICoBITS 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    
    <div class="absolute inset-0 pointer-events-none opacity-20">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] border-[40px] border-blue-500 rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] border-[20px] border-pink-500 rounded-full"></div>
    </div>

    <div class="max-w-md w-full relative z-10">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black italic text-white tracking-tighter">Digits <span class="text-blue-500">2026</span></h1>
            <p class="text-slate-400 mt-2 font-medium uppercase tracking-widest text-xs">Admin Control Panel</p>
        </div>

        <div class="bg-white/10 backdrop-blur-xl p-10 rounded-[2.5rem] border border-white/10 shadow-2xl">
            <form action="auth.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase text-blue-400 tracking-[0.2em] mb-2">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>
                        <input type="email" name="email" required placeholder="admin@icobits.com" 
                               class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-12 py-4 text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-blue-400 tracking-[0.2em] mb-2">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-12 py-4 text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-500/30 transition-all uppercase tracking-widest text-sm mt-4">
                    Sign In to Dashboard
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="../index.php" class="text-slate-500 text-xs hover:text-white transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Web Digits
                </a>
            </div>
        </div>

        <p class="text-center text-slate-600 text-[10px] mt-10 uppercase tracking-widest">
            &copy; 2026 Universitas Bhinneka Nusantara
        </p>
    </div>
</body>
</html>