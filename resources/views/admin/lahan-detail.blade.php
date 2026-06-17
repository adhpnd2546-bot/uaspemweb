<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Detail Lahan - Sneat TaniPantau</title>
    
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
                    <span class="text-[11px] font-medium uppercase text-muted tracking-widest relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-2 before:h-[1px] before:bg-muted ml-3">Menu Utama</span>
                </li>
                
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">home</span>
                            <span class="text-[15px]">Analitik</span>
                        </div>
                    </a>
                </li>
                
                <!-- Lahan (Active) -->
                <li>
                    <a href="{{ route('admin.lahan') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] bg-primary/10 text-primary font-medium transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">landscape</span>
                            <span class="text-[15px]">Area Lahan</span>
                        </div>
                    </a>
                </li>
                
                <!-- Petugas -->
                <li>
                    <a href="{{ route('admin.petani') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">group</span>
                            <span class="text-[15px]">Data Petani</span>
                        </div>
                    </a>
                </li>

                <!-- Section Header -->
                <li class="px-4 mt-6 mb-2">
                    <span class="text-[11px] font-medium uppercase text-muted tracking-widest relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-2 before:h-[1px] before:bg-muted ml-3">Manajemen</span>
                </li>

                <!-- Irigasi -->
                <li>
                    <a href="#" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">water_drop</span>
                            <span class="text-[15px]">Kontrol Irigasi</span>
                        </div>
                    </a>
                </li>
                
                <!-- Panen -->
                <li>
                    <a href="#" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">agriculture</span>
                            <span class="text-[15px]">Manajemen Panen</span>
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
                        <input type="text" placeholder="Cari data..." class="w-full bg-transparent border-none focus:ring-0 text-[15px] text-body placeholder:text-muted py-2" />
                    </div>
                </div>

                <!-- Right: Profile & Notifications -->
                <div class="flex items-center gap-4 flex-shrink-0">
                    <!-- Notification -->
                    <div class="relative" x-data="{ open: false }">
                        <button class="relative p-1.5 text-body hover:bg-black/5 rounded-full transition-colors" @click="open = !open">
                            <span class="material-symbols-outlined text-[22px]">notifications</span>
                        </button>
                        
                        <!-- Notification Dropdown -->
                        <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-card border border-border py-2 z-50" x-cloak>
                            <div class="px-4 py-2 border-b border-border mb-2">
                                <h6 class="text-[14px] font-semibold text-heading m-0">Notifikasi</h6>
                            </div>
                            <p class="text-[13px] text-muted px-4 py-2 text-center">Tidak ada notifikasi baru.</p>
                        </div>
                    </div>

                    <!-- Profile Avatar -->
                    <div class="relative" x-data="{ open: false }">
                        <button class="relative w-10 h-10 rounded-full border-2 border-transparent hover:border-primary/20 transition-all p-0.5 focus:outline-none" @click="open = !open">
                            <img src="https://ui-avatars.com/api/?name=Ahmad+Manager&background=16A34A&color=fff&rounded=true" alt="User" class="w-full h-full object-cover rounded-full shadow-sm">
                            <span class="absolute bottom-0.5 right-0.5 w-2.5 h-2.5 bg-success border-2 border-white rounded-full"></span>
                        </button>
                        
                        <!-- Profile Dropdown -->
                        <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-card border border-border py-1 z-50" x-cloak>
                            <div class="px-4 py-3 flex items-center gap-3 border-b border-border">
                                <img src="https://ui-avatars.com/api/?name=Ahmad+Manager&background=16A34A&color=fff&rounded=true" alt="User" class="w-10 h-10 rounded-full">
                                <div>
                                    <h6 class="text-[14px] font-semibold text-heading m-0">Ahmad Manager</h6>
                                    <small class="text-muted text-[12px]">Administrator</small>
                                </div>
                            </div>
                            <div class="py-1">
                                <a href="#" class="flex items-center gap-2 px-4 py-2 text-[14px] text-body hover:bg-black/5 transition-colors">
                                    <span class="material-symbols-outlined text-[18px] text-muted">person</span> Profil
                                </a>
                                <a href="#" class="flex items-center gap-2 px-4 py-2 text-[14px] text-body hover:bg-black/5 transition-colors">
                                    <span class="material-symbols-outlined text-[18px] text-muted">settings</span> Pengaturan
                                </a>
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
                
                <!-- Page Header & Actions -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.lahan') }}" class="p-2 rounded-full hover:bg-black/5 transition-colors text-heading flex items-center justify-center">
                            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
                        </a>
                        <div>
                            <h4 class="text-[1.25rem] font-medium text-heading mb-0">Detail Lahan: Blok A1</h4>
                            <p class="text-[0.875rem] text-muted m-0">ID: LHN-2023-0042 • Status <span class="text-success font-medium">Aktif</span></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <button class="flex-1 sm:flex-none bg-primary/10 text-primary hover:bg-primary hover:text-white transition-colors text-[14px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">edit</span> Edit
                        </button>
                        <button class="flex-1 sm:flex-none bg-danger/10 text-danger hover:bg-danger hover:text-white transition-colors text-[14px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">delete</span> Hapus
                        </button>
                    </div>
                </div>

                <!-- First Row: Info & Map -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
                    
                    <!-- Card 1: Informasi Umum (8 cols) -->
                    <div class="lg:col-span-8 bg-white rounded-[0.5rem] shadow-card p-6 flex flex-col">
                        <div class="flex items-center gap-2 border-b border-border pb-4 mb-5">
                            <span class="material-symbols-outlined text-primary text-[22px]">info</span>
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Informasi Umum</h5>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Nama Lahan</small>
                                <p class="text-[15px] font-medium text-heading m-0">Blok A1 - Sawah Irigasi</p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Pemilik / Petani</small>
                                <p class="text-[15px] font-medium text-primary flex items-center gap-1 cursor-pointer hover:underline m-0">
                                    Budi Santoso
                                    <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                                </p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-2">Komoditas</small>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[0.25rem] bg-info/10 text-info text-[13px] font-medium">
                                    <span class="material-symbols-outlined text-[14px]">grass</span>
                                    Padi (IR64)
                                </span>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Luas Lahan</small>
                                <p class="text-[15px] font-medium text-heading m-0">2.5 Hektar <span class="text-muted font-normal text-[13px]">(25,000 m²)</span></p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Tanggal Mulai Tanam</small>
                                <p class="text-[15px] font-medium text-heading m-0">12 Oktober 2023</p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Wilayah Administratif</small>
                                <p class="text-[15px] font-medium text-heading m-0">Desa Sukamaju, Kec. Subang</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Lokasi Peta (4 cols) -->
                    <div class="lg:col-span-4 bg-white rounded-[0.5rem] shadow-card flex flex-col overflow-hidden h-full min-h-[300px]">
                        <div class="p-4 border-b border-border flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[22px]">location_on</span>
                                <h5 class="text-[1rem] font-medium text-heading m-0">Lokasi Peta</h5>
                            </div>
                            <button class="text-muted hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">fullscreen</span>
                            </button>
                        </div>
                        <div class="relative flex-1 bg-background">
                            <!-- Map Image Placeholder -->
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2pPk8yYf5jUzOigIwmQlP8Nk11mZUuttzCJi2E4GR-zOzJ2w4kF2Xn-IRwppfZVZPHHV665VCYWeVqVJ2dRcvbVWRysv6bOj3S3n5ON9gR5aaOs4czZmBoB3QanPHq9WQru9tZY8VDYJTY5V1HX7wus_gbV7Vx7f7gQ4T0HMtBJXqbaTvQ_AExOwjzNSrUoMc-DshfKbLxOntKDKh2_d-kbO6_YPTxhoQlSqkFF0aTMbSEJz1hhC6uEd7TkVexUGWA3Ia2sFtBmA" 
                                 alt="Map Placeholder" 
                                 class="absolute inset-0 w-full h-full object-cover">
                            <!-- Pin overlay -->
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center drop-shadow-md">
                                <div class="w-4 h-4 bg-primary rounded-full animate-pulse border-2 border-white shadow-[0_0_10px_rgba(22,163,74,0.8)]"></div>
                                <span class="material-symbols-outlined text-danger text-[36px] -mt-1" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            </div>
                            <!-- Coordinate Badge -->
                            <div class="absolute bottom-3 left-3 right-3 bg-white/95 backdrop-blur shadow-sm rounded border border-border p-2 text-center text-[12px] font-medium text-heading">
                                -6.5684° S, 107.7589° E
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Row: Stepper & Kunjungan -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
                    
                    <!-- Card 3: Status Fase Pertumbuhan (6 cols) -->
                    <div class="lg:col-span-7 bg-white rounded-[0.5rem] shadow-card p-6">
                        <div class="flex items-center gap-2 border-b border-border pb-4 mb-6">
                            <span class="material-symbols-outlined text-warning text-[22px]" style="font-variation-settings: 'FILL' 1;">psychiatry</span>
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Fase Pertumbuhan</h5>
                        </div>
                        
                        <!-- Stepper Component -->
                        <div class="relative w-full px-4 sm:px-8 pb-4">
                            <!-- Line Background -->
                            <div class="absolute top-5 left-[10%] right-[10%] h-[2px] bg-border z-0"></div>
                            <!-- Line Progress -->
                            <div class="absolute top-5 left-[10%] w-[35%] h-[2px] bg-primary z-0"></div>

                            <div class="flex justify-between items-start relative z-10">
                                
                                <!-- Step 1 (Done) -->
                                <div class="flex flex-col items-center gap-2 w-1/4">
                                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center shadow-primary">
                                        <span class="material-symbols-outlined text-[20px]">check</span>
                                    </div>
                                    <span class="text-[13px] font-semibold text-heading mt-1">Persiapan</span>
                                </div>
                                
                                <!-- Step 2 (Active) -->
                                <div class="flex flex-col items-center gap-2 w-1/4 relative">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 border-primary text-primary flex items-center justify-center shadow-sm z-10 ring-4 ring-primary/10">
                                        <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                                    </div>
                                    <!-- Tooltip -->
                                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-primary text-white text-[11px] font-bold px-2 py-1 rounded-[0.25rem] shadow-sm whitespace-nowrap">
                                        Saat Ini
                                    </div>
                                    <span class="text-[13px] font-bold text-primary mt-1">Tanam</span>
                                </div>

                                <!-- Step 3 (Pending) -->
                                <div class="flex flex-col items-center gap-2 w-1/4">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 border-border text-muted flex items-center justify-center bg-background">
                                        <span class="material-symbols-outlined text-[20px]">water_drop</span>
                                    </div>
                                    <span class="text-[13px] font-medium text-muted mt-1">Vegetatif</span>
                                </div>

                                <!-- Step 4 (Pending) -->
                                <div class="flex flex-col items-center gap-2 w-1/4">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 border-border text-muted flex items-center justify-center bg-background">
                                        <span class="material-symbols-outlined text-[20px]">agriculture</span>
                                    </div>
                                    <span class="text-[13px] font-medium text-muted mt-1">Panen</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Ringkasan Kunjungan (5 cols) -->
                    <div class="lg:col-span-5 bg-white rounded-[0.5rem] shadow-card p-6">
                        <div class="flex items-center gap-2 border-b border-border pb-4 mb-6">
                            <span class="material-symbols-outlined text-info text-[22px]">fact_check</span>
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Ringkasan Laporan</h5>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-primary/5 rounded-[0.5rem] p-4 flex flex-col justify-center items-center text-center border border-primary/10">
                                <span class="text-[2rem] font-bold text-primary leading-none mb-1">12</span>
                                <span class="text-[12px] font-medium text-muted uppercase tracking-wider">Total Kunjungan</span>
                            </div>
                            <div class="bg-background rounded-[0.5rem] p-4 flex flex-col justify-center border border-border">
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Kunjungan Terakhir</small>
                                <p class="text-[15px] font-semibold text-heading mb-2">02 Nov 2023</p>
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium w-fit">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                    Normal
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Third Row: Riwayat Kunjungan Table -->
                <div class="bg-white rounded-[0.5rem] shadow-card">
                    <div class="px-6 py-5 border-b border-border flex items-center justify-between">
                        <h5 class="text-[1.125rem] font-medium text-heading m-0">Riwayat Kunjungan Petugas</h5>
                        <button class="bg-background hover:bg-black/5 text-body text-[13px] font-medium py-1.5 px-3 rounded-[0.375rem] border border-border transition-colors flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">filter_list</span> Filter
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Tanggal & Waktu</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Petugas</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Kondisi</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Catatan & Lampiran</th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] text-body">
                                
                                <!-- Row 1 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">02 Nov 2023, 09:30</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-bold">AS</div>
                                            Ahmad Sobari
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-2 py-1 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium">Normal</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-4">
                                            <span class="text-body truncate max-w-[200px]" title="Pertumbuhan bibit baik, air irigasi cukup.">Pertumbuhan bibit baik, air iri...</span>
                                            <button class="text-info hover:text-primary transition-colors flex items-center gap-1 text-[13px] font-medium">
                                                <span class="material-symbols-outlined text-[16px]">image</span> 2 Foto
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">26 Okt 2023, 14:15</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-warning/20 text-warning flex items-center justify-center text-[10px] font-bold">DW</div>
                                            Dwi Wulandari
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-2 py-1 rounded-[0.25rem] bg-warning/10 text-warning text-[12px] font-medium">Perhatian</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-4">
                                            <span class="text-body truncate max-w-[200px]" title="Ditemukan indikasi awal hama wereng di petak timur.">Ditemukan indikasi awal ham...</span>
                                            <button class="text-info hover:text-primary transition-colors flex items-center gap-1 text-[13px] font-medium">
                                                <span class="material-symbols-outlined text-[16px]">description</span> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">12 Okt 2023, 08:00</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-bold">AS</div>
                                            Ahmad Sobari
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-2 py-1 rounded-[0.25rem] bg-info/10 text-info text-[12px] font-medium">Awal Tanam</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-4">
                                            <span class="text-body truncate max-w-[200px]">Proses penanaman bibit s...</span>
                                            <button class="text-info hover:text-primary transition-colors flex items-center gap-1 text-[13px] font-medium">
                                                <span class="material-symbols-outlined text-[16px]">image</span> 5 Foto
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 bg-background/50 text-center rounded-b-[0.5rem]">
                        <button class="text-primary hover:text-primary-hover font-medium text-[14px] transition-colors">Lihat Semua Riwayat</button>
                    </div>
                </div>

            </main>
            <!-- ===== Content Area End ===== -->
        </div>
        <!-- ===== Layout Page End ===== -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</body>
</html>
