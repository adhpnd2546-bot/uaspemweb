<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Dashboard Sneat - TaniPantau</title>
    
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
                        primary: '#16A34A', // Agriculture Green (Sneat styled)
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
                
                <!-- Dashboard (Active) -->
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] bg-primary/10 text-primary font-medium transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">home</span>
                            <span class="text-[15px]">Analitik</span>
                        </div>
                    </a>
                </li>
                
                <!-- Lahan -->
                <li>
                    <a href="{{ route('admin.lahan') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">landscape</span>
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
            <nav class="flex items-center justify-between bg-white/95 backdrop-blur-[6px] rounded-[0.375rem] shadow-card min-h-[62px] mx-4 sm:mx-6 mt-4 mb-6 px-4 sm:px-6 sticky top-4 z-30 transition-all">
                
                <!-- Left: Hamburger & Search -->
                <div class="flex items-center gap-3 flex-1">
                    <button class="lg:hidden text-heading hover:bg-black/5 p-1 rounded-md transition-colors" @click="sidebarOpen = true">
                        <span class="material-symbols-outlined text-[24px]">menu</span>
                    </button>
                    
                    <div class="flex items-center gap-2 w-full max-w-sm">
                        <span class="material-symbols-outlined text-[20px] text-muted">search</span>
                        <input type="text" placeholder="Cari data lahan, petani..." class="w-full bg-transparent border-none focus:ring-0 text-[15px] text-body placeholder:text-muted py-2" />
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
                                <h6 class="text-[14px] font-semibold text-heading m-0">Notifikasi</h6>
                            </div>
                            <a href="#" class="block px-4 py-2 hover:bg-black/5 transition-colors">
                                <p class="text-[13px] font-medium text-heading mb-1">Panen Blok A Siap!</p>
                                <p class="text-[12px] text-muted">Estimasi hasil 2.5 ton.</p>
                            </a>
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
                
                <!-- Row 1: Welcome & Weather -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
                    <!-- Welcome Card (Spans 8 cols on desktop) -->
                    <div class="md:col-span-12 lg:col-span-8">
                        <div class="bg-primary text-white rounded-[0.5rem] shadow-primary relative overflow-hidden h-full">
                            <div class="flex flex-col sm:flex-row items-center sm:items-stretch h-full">
                                <div class="p-6 sm:w-2/3 flex flex-col justify-center relative z-10">
                                    <h5 class="text-[1.125rem] font-medium text-white mb-3">Selamat Datang, Ahmad! 🎉</h5>
                                    <p class="text-[0.9375rem] mb-4 text-white/90 leading-relaxed">
                                        Performa lahan pertanian Anda naik <span class="font-bold text-white">18%</span> bulan ini. Cek laporan irigasi dan estimasi panen sekarang.
                                    </p>
                                    <div>
                                        <a href="#" class="inline-block px-4 py-1.5 rounded-[0.375rem] bg-white text-primary text-[13px] font-semibold hover:bg-white/90 transition-all shadow-sm">Lihat Laporan</a>
                                    </div>
                                </div>
                                <!-- Subtle Icon Background -->
                                <div class="sm:w-1/3 flex items-end justify-center sm:justify-end pb-0 sm:pr-6 mt-4 sm:mt-0 relative h-32 sm:h-auto pointer-events-none z-0">
                                    <span class="material-symbols-outlined text-white/20 text-[120px] absolute -bottom-6 -right-6" style="font-variation-settings: 'FILL' 1;">eco</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weather Widget (Spans 4 cols on desktop) -->
                    <div class="md:col-span-12 lg:col-span-4">
                        <div class="bg-white rounded-[0.5rem] shadow-card p-6 h-full flex flex-col justify-between relative overflow-hidden">
                            <div class="flex justify-between items-start relative z-10">
                                <div>
                                    <h6 class="text-[14px] font-semibold text-heading mb-1">Cuaca Hari Ini</h6>
                                    <p class="text-[12px] text-muted">Kecamatan Ngawi</p>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-warning/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-warning text-[24px]">partly_cloudy_day</span>
                                </div>
                            </div>
                            <div class="mt-4 relative z-10">
                                <h3 class="text-[2.25rem] font-bold text-heading m-0 leading-tight">28°C</h3>
                                <p class="text-[13px] font-medium text-body mt-1">Cerah Berawan • Kelembaban 65%</p>
                            </div>
                            <!-- Decorative background element -->
                            <div class="absolute -bottom-8 -right-8 opacity-5 pointer-events-none">
                                <span class="material-symbols-outlined text-[150px]" style="font-variation-settings: 'FILL' 1;">cloud</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 2: 4 Stats Grids -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Stat 1: Lahan -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-success/10 text-success flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">landscape</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Total Lahan (Ha)</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">1,240</h3>
                        <small class="text-success font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 12.5%
                        </small>
                    </div>

                    <!-- Stat 2: Panen -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-info/10 text-info flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">agriculture</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Est. Panen (Ton)</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">8,450</h3>
                        <small class="text-success font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 4.2%
                        </small>
                    </div>

                    <!-- Stat 3: Petugas -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">group</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Petugas Aktif</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">45</h3>
                        <small class="text-success font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 2 Petugas Baru
                        </small>
                    </div>

                    <!-- Stat 4: Peringatan -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-danger/10 text-danger flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">warning</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Peringatan Lahan</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">3</h3>
                        <small class="text-danger font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 1 Serangan Hama
                        </small>
                    </div>
                </div>

                <!-- Data Table Section -->
                <div class="mt-6">
                    <div class="bg-white rounded-[0.5rem] shadow-card">
                        
                        <!-- Table Header -->
                        <div class="px-6 py-5 flex items-center justify-between border-b border-border">
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Status Lahan Operasional</h5>
                            <button class="p-1.5 hover:bg-black/5 rounded-md transition-colors text-muted">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Nama Lahan</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Komoditas</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Kelembaban</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Petugas</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Status</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-[14px] text-body">
                                    <!-- Row 1 -->
                                    <tr class="hover:bg-black/[0.02] transition-colors group">
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded bg-primary/10 text-primary flex items-center justify-center font-bold text-[12px]">U1</div>
                                                <span class="font-medium text-heading">Blok Utara A1</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">Padi</td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <div class="w-full h-1.5 bg-border rounded-full overflow-hidden max-w-[80px]">
                                                    <div class="h-full bg-primary" style="width: 65%;"></div>
                                                </div>
                                                <span class="text-[13px] font-medium">65%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Budi+S&background=random&rounded=true" class="w-6 h-6 rounded-full" alt="Budi">
                                                <span>Budi S.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <span class="px-2 py-1 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium">Terawat</span>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border text-center">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Row 2 -->
                                    <tr class="hover:bg-black/[0.02] transition-colors group">
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded bg-warning/10 text-warning flex items-center justify-center font-bold text-[12px]">S2</div>
                                                <span class="font-medium text-heading">Blok Selatan B2</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">Jagung</td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <div class="w-full h-1.5 bg-border rounded-full overflow-hidden max-w-[80px]">
                                                    <div class="h-full bg-warning" style="width: 42%;"></div>
                                                </div>
                                                <span class="text-[13px] font-medium">42%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Agus+T&background=random&rounded=true" class="w-6 h-6 rounded-full" alt="Agus">
                                                <span>Agus T.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <span class="px-2 py-1 rounded-[0.25rem] bg-warning/10 text-warning text-[12px] font-medium">Irigasi</span>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border text-center">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        </td>
                                    </tr>

                                    <!-- Row 3 -->
                                    <tr class="hover:bg-black/[0.02] transition-colors group">
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded bg-danger/10 text-danger flex items-center justify-center font-bold text-[12px]">T1</div>
                                                <span class="font-medium text-heading">Blok Timur C1</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">Kedelai</td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <div class="w-full h-1.5 bg-border rounded-full overflow-hidden max-w-[80px]">
                                                    <div class="h-full bg-danger" style="width: 28%;"></div>
                                                </div>
                                                <span class="text-[13px] font-medium">28%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Dewi+K&background=random&rounded=true" class="w-6 h-6 rounded-full" alt="Dewi">
                                                <span>Dewi K.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <span class="px-2 py-1 rounded-[0.25rem] bg-danger/10 text-danger text-[12px] font-medium">Kritis</span>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border text-center">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                title: 'Berhasil masuk sebagai Admin!'
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
