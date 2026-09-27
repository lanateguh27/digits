<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - DIGITS 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800;900&display=swap');
        body { font-family: 'Montserrat', sans-serif; }
        
        .glass-bg {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #3b82f6;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
        }
        select option { background: #070620; color: white; }
    </style>
</head>
<body class="bg-[#070620] min-h-screen relative overflow-x-hidden text-white">

    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-600/10 rounded-full blur-[120px] -ml-48 -mb-48"></div>
    </div>

    <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <div class="inline-block px-4 py-1 bg-blue-500/20 border border-blue-500/30 rounded-full text-blue-400 text-xs font-bold uppercase tracking-widest mb-4">
                International Conference on Digital Transformation & Sustainable Technologies
            </div>
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-4">
                Registration <span class="text-blue-500">Form</span>
            </h1>
            <p class="text-gray-400 font-medium italic opacity-80">Join the digital transformation movement. Please fill in your details.</p>
        </div>

        <div class="max-w-4xl mx-auto glass-bg rounded-[2.5rem] shadow-2xl p-8 md:p-14">
            <form action="process_registration.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group">
                        <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3 ml-1">Participation Type</label>
                        <select name="type" required class="input-glass w-full rounded-2xl px-5 py-4 outline-none appearance-none">
                            <option value="" disabled selected>Select Type</option>
                            <option value="Presenter">Presenter</option>
                            <option value="Non Presenter">Non Presenter</option>
                        </select>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3 ml-1">Participant Category</label>
                        <select name="category" required class="input-glass w-full rounded-2xl px-5 py-4 outline-none">
                            <option value="" disabled selected>Select Category</option>
                            <option value="Domestic Student Presenter">Domestic Student Presenter</option>
                            <option value="Domestic Non Student Presenter">Domestic Non Student Presenter</option>
                            <option value="Domestic Participant (Non-Presenter)">Domestic Participant (Non-Presenter)</option>
                            <option value="International Student Presenter">International Student Presenter</option>
                            <option value="International Non Student Presenter">International Non Student Presenter</option>
                            <option value="International Participant (Non-Presenter)">International Participant (Non-Presenter)</option>
                        </select>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3 ml-1">Email Address</label>
                        <input type="email" name="email" required placeholder="yourname@domain.com" class="input-glass w-full rounded-2xl px-5 py-4 outline-none">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3 ml-1">WhatsApp Number</label>
                        <input type="text" name="phone" required placeholder="+62 812..." class="input-glass w-full rounded-2xl px-5 py-4 outline-none">
                    </div>
                </div>

                <div class="h-px bg-white/10 w-full"></div>

                <div>
                    <label class="block text-[11px] font-black text-white text-center uppercase tracking-[0.3em] mb-8 bg-white/5 py-3 rounded-xl border border-white/5">Author List</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <input type="text" name="author1" required placeholder="Main Author" class="input-glass rounded-xl px-5 py-3.5 text-sm outline-none">
                        <input type="text" name="author2" placeholder="Author 2" class="input-glass rounded-xl px-5 py-3.5 text-sm outline-none">
                        <input type="text" name="author3" placeholder="Author 3" class="input-glass rounded-xl px-5 py-3.5 text-sm outline-none">
                        <input type="text" name="author4" placeholder="Author 4" class="input-glass rounded-xl px-5 py-3.5 text-sm outline-none">
                        <input type="text" name="author5" placeholder="Author 5" class="input-glass rounded-xl px-5 py-3.5 text-sm outline-none">
                        <input type="text" name="group_name" placeholder="Team Name (Optional)" class="input-glass rounded-xl px-5 py-3.5 text-sm outline-none border-blue-500/30">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3 ml-1">Full Paper Title</label>
                        <input type="text" name="paper_title" required placeholder="Enter the complete title of your research" class="input-glass w-full rounded-2xl px-5 py-4 outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3 ml-1">Institution / University</label>
                        <input type="text" name="institution" required placeholder="e.g. UBHINUS University" class="input-glass w-full rounded-2xl px-5 py-4 outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3 ml-1">Country</label>
                        <input type="text" name="country" required placeholder="e.g. Indonesia" class="input-glass w-full rounded-2xl px-5 py-4 outline-none">
                    </div>
                </div>

                <div class="h-px bg-white/10 w-full"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="relative group">
                        <label class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-white/10 rounded-[2rem] hover:border-blue-500/50 hover:bg-white/5 transition-all cursor-pointer">
                            <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-file-upload text-2xl"></i>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest text-white mb-1">Abstract File</span>
                            <span class="file-info text-[10px] text-gray-500">PDF (Max 2MB)</span>
                            <input type="file" name="abstract_file" class="hidden file-input">
                        </label>
                    </div>
                    <div class="relative group">
                        <label class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-white/10 rounded-[2rem] hover:border-cyan-500/50 hover:bg-white/5 transition-all cursor-pointer">
                            <div class="w-16 h-16 bg-cyan-500/10 rounded-2xl flex items-center justify-center text-cyan-500 mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-receipt text-2xl"></i>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest text-white mb-1">Payment Receipt</span>
                            <span class="file-info text-[10px] text-gray-500">JPG, PNG, PDF (Required)</span>
                            <input type="file" name="payment_receipt" required class="hidden file-input">
                        </label>
                    </div>
                </div>

                <input type="hidden" name="apply" value="Pending">

                <div class="flex flex-col md:flex-row items-center justify-center gap-6 pt-10">
                    <a href="index.php" class="order-2 md:order-1 text-gray-400 hover:text-white font-bold text-xs uppercase tracking-widest transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Home
                    </a>
                    <button type="submit" class="order-1 md:order-2 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-black px-12 py-5 rounded-full shadow-[0_10px_30px_rgba(59,130,246,0.4)] hover:scale-105 hover:shadow-blue-500/50 transition-all uppercase tracking-[0.2em] text-sm w-full md:w-auto">
                        Submit Registration <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
                <p class="text-center text-[9px] text-gray-500 tracking-wider">By submitting, you agree to the conference terms and data privacy policy.</p>

            </form>
        </div>

        <div class="mt-16 text-center opacity-30 flex items-center justify-center gap-3">
            <span class="text-[10px] font-bold uppercase tracking-[0.4em]">DIGITS 2026 Organizing Committee</span>
        </div>
    </div>

    <script>
    // --- 1. LOGIKA PREVIEW UPLOAD FILE ---
    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                const infoSpan = this.parentElement.querySelector('.file-info');
                infoSpan.innerHTML = "✅ " + fileName;
                infoSpan.classList.remove('text-gray-500');
                infoSpan.classList.add('text-blue-400', 'font-bold');
            }
        });
    });

    // --- 2. LOGIKA NOTIFIKASI SUKSES (GABUNGAN) ---
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.get('status') === 'success') {
        Swal.fire({
            title: '<span style="color: #3b82f6;">Congratulations!</span>',
            html: `
                <div class="text-left text-sm leading-relaxed" style="color: #d1d5db; font-family: 'Montserrat', sans-serif;">
                    <p class="mb-4 text-center">You have successfully completed your registration and payment for <b>DIGITS 2026</b>. Thank you for your participation!</p>
                    
                    <div style="background: rgba(255,255,255,0.05); padding: 15px; border-radius: 15px; border-left: 4px solid #3b82f6; margin-bottom: 20px;">
                        <b style="color: #fff; display: block; margin-bottom: 8px; text-transform: uppercase; font-size: 11px;">Important Dates:</b>
                        <ul style="list-style: none; padding-left: 0; font-size: 12px; line-height: 1.8;">
                            <li>📅 <b>July 1, 2026:</b> Abstract Acceptance Announcement</li>
                            <li>📅 <b>July 8, 2026:</b> Full Paper Submission Deadline</li>
                            <li>📅 <b>July 15, 2026:</b> Full Paper Acceptance Announcement</li>
                            <li>📅 <b>July 20, 2026:</b> Socialization for Presenters</li>
                            <li>📅 <b>July 22, 2026:</b> The 4th International Student Conference 2025</li>
                        </ul>
                    </div>

                    <p class="mb-4" style="font-size: 12px;"><b>Additional Information:</b> The Zoom link will be sent to your registered email one day before the event.</p>
                    
                    <div class="text-center">
                        <p class="mb-2 text-[11px]">Join our coordination group:</p>
                        <a href="https://chat.whatsapp.com/GyYocKo3jGoKjWuAdytYtZ?mode=gi_t" target="_blank" 
                           style="display: inline-block; background: #25D366; color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none; font-weight: bold; font-size: 13px;">
                           <i class="fab fa-whatsapp mr-2"></i> Join WhatsApp Group
                        </a>
                    </div>

                    <p class="mt-6 text-center text-[11px] italic opacity-60">Best regards,<br>Conference Committee DIGITS 2026</p>
                </div>
            `,
            background: '#070620',
            confirmButtonText: 'Great, I Got It!',
            confirmButtonColor: '#3b82f6',
            width: '600px',
            borderRadius: '2.5rem',
            allowOutsideClick: false, // User wajib klik tombol agar baca informasi
            customClass: {
                popup: 'glass-bg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php'; 
            }
        });
    } 
    
    // Logika Error Tetap Sama
    else if (urlParams.get('status') === 'error') {
        Swal.fire({
            title: 'Registration Failed',
            text: decodeURIComponent(urlParams.get('message') || 'Please check your data.'),
            icon: 'error',
            background: '#070620',
            color: '#fff',
            confirmButtonColor: '#ef4444',
            borderRadius: '2rem'
        });
    }
</script>
</body>
</html>