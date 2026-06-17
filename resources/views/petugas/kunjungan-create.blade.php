<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Input Kunjungan Lahan - Sneat TaniPantau</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        public: ['"Public Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#16A34A', // Agriculture Green
                        'primary-hover': '#15803D',
                        secondary: '#8592a3',
                        success: '#71dd37',
                        danger: '#ff3e1d',
                        warning: '#ffab00',
                        info: '#03c3ec',
                        dark: '#233446',
                        body: '#697a8d',
                        heading: '#566a7f',
                        muted: '#a1acb8',
                        background: '#f5f5f9',
                        border: '#d9dee3',
                    },
                    boxShadow: {
                        card: '0 2px 6px 0 rgba(67, 89, 113, 0.12)',
                        sm: '0 0.125rem 0.25rem rgba(161, 172, 184, 0.4)',
                        primary: '0 2px 4px 0 rgba(22, 163, 74, 0.4)',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d9dee3; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #b4bdc6; }

        /* Custom File Input Styling */
        .file-drop-zone {
            border: 2px dashed #d9dee3; /* border */
            transition: all 0.2s ease-in-out;
        }
        .file-drop-zone:hover {
            border-color: #16A34A; /* primary */
            background-color: rgba(22, 163, 74, 0.05); /* primary/5 */
        }
        
        /* Radio Tab Styling */
        .radio-tab-input:checked + .radio-tab-label {
            background-color: #16A34A;
            color: #ffffff;
            border-color: #16A34A;
        }
        .radio-tab-input:checked + .radio-tab-label-warning {
            background-color: #ffab00;
            color: #ffffff;
            border-color: #ffab00;
        }
        .radio-tab-input:checked + .radio-tab-label-danger {
            background-color: #ff3e1d;
            color: #ffffff;
            border-color: #ff3e1d;
        }
    </style>
</head>

<body class="bg-background text-body font-public antialiased overflow-hidden" x-data="{ sidebarOpen: false }">
    
    <!-- Layout Wrapper -->
    <div class="flex h-screen w-full relative">
        
        <!-- Sidebar Overlay (Mobile) -->
        <div x-show="sidebarOpen" 
             x-transition.opacity.duration.300ms
             class="fixed inset-0 bg-dark/50 z-40 lg:hidden" 
             @click="sidebarOpen = false" x-cloak>
        </div>

        <!-- ===== Sidebar Start ===== -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed lg:static inset-y-0 left-0 w-[260px] bg-white flex flex-col z-50 transition-transform duration-300 ease-in-out lg:translate-x-0 shadow-card lg:shadow-none border-r border-transparent lg:border-border">
            
            <!-- Brand Logo -->
            <div class="h-[64px] flex items-center justify-between lg:justify-start px-6 mt-3 mb-2 flex-shrink-0">
                <a href="#" class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-primary text-[32px]" style="font-variation-settings: 'FILL' 1;">eco</span>
                    <span class="text-[22px] font-bold text-heading tracking-tighter lowercase capitalize">TaniPantau</span>
                </a>
                
                <!-- Close Button (Mobile) -->
                <button class="lg:hidden text-muted hover:text-heading" @click="sidebarOpen = false">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <!-- Menu Scrollable -->
            <ul class="flex flex-col py-4 px-4 overflow-y-auto gap-1 flex-grow">
                <!-- Section Header -->
                <li class="px-4 mt-2 mb-2">
                    <span class="text-[11px] font-medium uppercase text-muted tracking-widest relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-2 before:h-[1px] before:bg-muted ml-3">Lapangan</span>
                </li>
                
                <!-- Data Entry (Active) -->
                <li>
                    <a href="#" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] bg-primary/10 text-primary font-medium transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">edit_note</span>
                            <span class="text-[15px]">Data Entry</span>
                        </div>
                    </a>
                </li>
                
                <!-- History -->
                <li>
                    <a href="#" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">history</span>
                            <span class="text-[15px]">Riwayat</span>
                        </div>
                    </a>
                </li>
                
                <!-- Settings -->
                <li>
                    <a href="#" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group mt-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">settings</span>
                            <span class="text-[15px]">Pengaturan</span>
                        </div>
                    </a>
                </li>
                
                <li class="mt-auto mb-2">
                    <button onclick="confirmLogout()" class="w-full flex items-center px-4 py-2.5 rounded-[0.375rem] text-danger hover:bg-danger/10 transition-colors group mt-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-danger/80 group-hover:text-danger transition-colors">logout</span>
                            <span class="text-[15px] font-medium">Keluar</span>
                        </div>
                    </button>
                </li>
            </ul>
        </aside>
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Layout Page Start ===== -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden relative">
            
            <!-- ===== Floating Navbar Start ===== -->
            <nav class="flex items-center justify-between bg-white/95 backdrop-blur-[6px] rounded-[0.375rem] shadow-card min-h-[62px] mx-4 sm:mx-6 mt-4 mb-6 px-4 sm:px-6 sticky top-4 z-30 transition-all flex-shrink-0">
                
                <!-- Left: Hamburger & Search -->
                <div class="flex items-center gap-3 flex-1">
                    <button class="lg:hidden text-heading hover:bg-black/5 p-1 rounded-md transition-colors" @click="sidebarOpen = true">
                        <span class="material-symbols-outlined text-[24px]">menu</span>
                    </button>
                    
                    <div class="flex items-center gap-2 w-full max-w-sm hidden sm:flex">
                        <span class="material-symbols-outlined text-[20px] text-muted">search</span>
                        <input type="text" placeholder="Cari..." class="w-full bg-transparent border-none focus:ring-0 text-[15px] text-body placeholder:text-muted py-2" />
                    </div>
                </div>

                <!-- Right: Profile & Notifications -->
                <div class="flex items-center gap-4 flex-shrink-0">
                    <!-- Notification -->
                    <div class="relative" x-data="{ open: false }">
                        <button class="relative p-1.5 text-body hover:bg-black/5 rounded-full transition-colors" @click="open = !open">
                            <span class="material-symbols-outlined text-[22px]">notifications</span>
                            <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-danger border-2 border-white box-content"></span>
                        </button>
                        
                        <!-- Notification Dropdown -->
                        <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-card border border-border py-2 z-50" x-cloak>
                            <div class="px-4 py-2 border-b border-border mb-2">
                                <h6 class="text-[14px] font-semibold text-heading m-0">Pesan Sistem</h6>
                            </div>
                            <p class="text-[13px] text-muted px-4 py-2">Jangan lupa laporkan kondisi lahan Blok C.</p>
                        </div>
                    </div>

                    <!-- Profile Avatar -->
                    <div class="relative" x-data="{ open: false }">
                        <button class="relative w-10 h-10 rounded-full border-2 border-transparent hover:border-primary/20 transition-all p-0.5 focus:outline-none" @click="open = !open">
                            <img src="https://ui-avatars.com/api/?name=Petugas+Lapang&background=16A34A&color=fff&rounded=true" alt="Officer" class="w-full h-full object-cover rounded-full shadow-sm">
                            <span class="absolute bottom-0.5 right-0.5 w-2.5 h-2.5 bg-success border-2 border-white rounded-full"></span>
                        </button>
                        
                        <!-- Profile Dropdown -->
                        <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-card border border-border py-1 z-50" x-cloak>
                            <div class="px-4 py-3 flex items-center gap-3 border-b border-border">
                                <img src="https://ui-avatars.com/api/?name=Petugas+Lapang&background=16A34A&color=fff&rounded=true" alt="User" class="w-10 h-10 rounded-full">
                                <div>
                                    <h6 class="text-[14px] font-semibold text-heading m-0">TaniPantau Officer</h6>
                                    <small class="text-muted text-[12px]">Field Operations</small>
                                </div>
                            </div>
                            <div class="border-t border-border py-1">
                                <a href="/" class="flex items-center gap-2 px-4 py-2 text-[14px] text-body hover:bg-black/5 transition-colors">
                                    <span class="material-symbols-outlined text-[18px] text-muted">power_settings_new</span> Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </nav>
            <!-- ===== Floating Navbar End ===== -->

            <!-- ===== Content Area Start ===== -->
            <main class="flex-grow overflow-y-auto px-4 sm:px-6 pb-6 pt-2">
                
                <div class="max-w-4xl mx-auto w-full">
                    <!-- Page Header -->
                    <div class="mb-6">
                        <h4 class="text-[1.25rem] font-medium text-heading mb-1">Input Kunjungan Lahan Baru</h4>
                        <p class="text-[0.9375rem] text-body m-0">Catat hasil inspeksi lapangan secara real-time untuk analisis lebih lanjut.</p>
                    </div>

                    <!-- Sneat Form Container -->
                    <form class="bg-white rounded-[0.5rem] shadow-card border border-border/50 overflow-hidden">
                        
                        <!-- Form Section 1: Lokasi & Waktu -->
                        <div class="p-6 sm:p-8 border-b border-border/50">
                            <h5 class="text-[1.125rem] font-medium text-heading flex items-center gap-2 mb-6 m-0">
                                <span class="material-symbols-outlined text-primary text-[22px]">location_on</span>
                                Lokasi & Waktu
                            </h5>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Select Lahan -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5" for="lahan">Pilih Lahan <span class="text-danger">*</span></label>
                                    <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" id="lahan">
                                        <option disabled selected value="">Pilih lokasi lahan...</option>
                                        <option value="l1">Blok A - Lahan Padi Ciherang</option>
                                        <option value="l2">Blok B - Jagung Hibrida</option>
                                        <option value="l3">Blok C - Kebun Sayur Organik</option>
                                        <option value="l4">Blok D - Area Pembibitan</option>
                                    </select>
                                </div>
                                
                                <!-- Date Tanggal Kunjungan -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5" for="tanggal">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                    <input class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" id="tanggal" type="date" value="2023-10-27" />
                                </div>
                            </div>
                        </div>

                        <!-- Form Section 2: Observasi -->
                        <div class="p-6 sm:p-8 border-b border-border/50 bg-[#f8f8f9]">
                            <h5 class="text-[1.125rem] font-medium text-heading flex items-center gap-2 mb-6 m-0">
                                <span class="material-symbols-outlined text-primary text-[22px]">visibility</span>
                                Hasil Observasi
                            </h5>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Select Kondisi Lahan -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5" for="kondisi">Kondisi Lahan Umum <span class="text-danger">*</span></label>
                                    <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white" id="kondisi">
                                        <option disabled selected value="">Pilih kondisi...</option>
                                        <option value="baik">Baik (Pertumbuhan normal, hama minimal)</option>
                                        <option value="cukup">Cukup (Perlu sedikit perhatian)</option>
                                        <option value="buruk">Buruk (Kritis, butuh tindakan segera)</option>
                                    </select>
                                </div>
                                
                                <!-- Status Tindak Lanjut (Radio Tabs) -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5">Status Tindak Lanjut <span class="text-danger">*</span></label>
                                    <div class="flex gap-2 h-10">
                                        <label class="flex-1 cursor-pointer relative">
                                            <input checked class="radio-tab-input peer sr-only" name="status" type="radio" value="aman" />
                                            <div class="radio-tab-label w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border text-body font-medium text-[14px] transition-colors hover:bg-black/5 bg-white">
                                                Aman
                                            </div>
                                        </label>
                                        <label class="flex-1 cursor-pointer relative">
                                            <input class="radio-tab-input peer sr-only" name="status" type="radio" value="pantau" />
                                            <div class="radio-tab-label-warning w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border text-body font-medium text-[14px] transition-colors hover:bg-black/5 bg-white">
                                                Pantau
                                            </div>
                                        </label>
                                        <label class="flex-1 cursor-pointer relative">
                                            <input class="radio-tab-input peer sr-only" name="status" type="radio" value="tindak" />
                                            <div class="radio-tab-label-danger w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border text-body font-medium text-[14px] transition-colors hover:bg-black/5 bg-white">
                                                Tindak
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Catatan Lapangan -->
                            <div class="flex flex-col">
                                <label class="text-[13px] font-medium text-heading mb-1.5" for="catatan">Catatan Lapangan</label>
                                <textarea class="w-full border border-border rounded-[0.375rem] p-3 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white resize-y min-h-[100px]" id="catatan" placeholder="Deskripsikan temuan spesifik (hama, penyakit, kondisi tanah, dll)..."></textarea>
                            </div>
                        </div>

                        <!-- Form Section 3: Dokumentasi -->
                        <div class="p-6 sm:p-8">
                            <h5 class="text-[1.125rem] font-medium text-heading flex items-center gap-2 mb-6 m-0">
                                <span class="material-symbols-outlined text-primary text-[22px]">photo_camera</span>
                                Dokumentasi
                            </h5>
                            
                            <!-- File Drag & Drop -->
                            <div class="file-drop-zone rounded-[0.5rem] p-8 flex flex-col items-center justify-center text-center cursor-pointer bg-[#fafafa]">
                                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                                    <span class="material-symbols-outlined text-[32px]">cloud_upload</span>
                                </div>
                                <p class="text-[15px] text-heading font-medium mb-1">Pilih foto atau tarik ke area ini</p>
                                <p class="text-[13px] text-muted mb-4">Mendukung format JPG, PNG maksimal 5MB per file.</p>
                                <button class="px-4 py-2 bg-white border border-border rounded-[0.375rem] text-[14px] text-body font-medium hover:text-primary hover:border-primary transition-colors shadow-sm" type="button">
                                    Browse Files
                                </button>
                                <input accept="image/jpeg, image/png" class="hidden" multiple type="file" />
                            </div>
                        </div>

                        <!-- Form Actions Footer -->
                        <div class="px-6 py-4 border-t border-border/50 bg-[#f9f9f9] flex justify-end gap-3">
                            <button class="px-5 py-2 bg-white border border-border rounded-[0.375rem] text-[14px] text-heading font-medium hover:bg-black/5 transition-colors shadow-sm" type="button">
                                Batal
                            </button>
                            <button class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary flex items-center gap-2" type="submit">
                                <span class="material-symbols-outlined text-[18px]">check</span>
                                Simpan Laporan
                            </button>
                        </div>
                        
                    </form>
                    
                    <div class="h-6"></div> <!-- Bottom padding -->
                </div>

            </main>
            <!-- ===== Content Area End ===== -->
        </div>
        <!-- ===== Layout Page End ===== -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('login_success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#dcfce7',
                color: '#166534',
                customClass: {
                    popup: 'swal-success-popup'
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                title: 'Berhasil masuk sebagai Petugas!'
            });
        });
    </script>
    @endif
    <script>
        
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Sesi Anda akan diakhiri.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#16A34A',
                cancelButtonColor: '#ff3e1d',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal',
                customClass: {
                    title: 'font-public text-[18px] text-heading',
                    popup: 'font-public rounded-[0.5rem] shadow-card border border-border',
                    confirmButton: 'rounded-[0.375rem]',
                    cancelButton: 'rounded-[0.375rem]'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/logout';
                }
            });
        }
    </script>
    <style>
        .swal-success-popup .swal2-timer-progress-bar {
            background-color: #22c55e !important;
        }
        .swal-success-popup {
            padding: 10px 16px !important;
            font-family: 'Public Sans', sans-serif !important;
            font-weight: 600 !important;
            font-size: 14px !important;
        }
    </style>
</body>
</html>
