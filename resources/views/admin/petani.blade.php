<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Daftar Petani - Sneat TaniPantau</title>
    
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
                
                <!-- Lahan -->
                <li>
                    <a href="{{ route('admin.lahan') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] text-body hover:bg-black/5 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px] text-muted group-hover:text-body transition-colors">landscape</span>
                            <span class="text-[15px]">Area Lahan</span>
                        </div>
                    </a>
                </li>
                
                <!-- Petugas (Active) -->
                <li>
                    <a href="{{ route('admin.petani') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] bg-primary/10 text-primary font-medium transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">group</span>
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
                        <input type="text" placeholder="Cari NIK, Nama..." class="w-full bg-transparent border-none focus:ring-0 text-[15px] text-body placeholder:text-muted py-2" />
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
                                <p class="text-[13px] font-medium text-heading mb-1">Registrasi Petani Baru</p>
                                <p class="text-[12px] text-muted">2 data petani menunggu verifikasi.</p>
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
                
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h4 class="text-[1.25rem] font-medium text-heading mb-1">Daftar Petani</h4>
                        <p class="text-[0.9375rem] text-body m-0">Kelola data petani, kelompok tani, lokasi, dan status keaktifan.</p>
                    </div>
                    <button class="bg-primary hover:bg-primary-hover text-white text-[15px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center gap-2 transition-all shadow-primary">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                        Tambah Petani
                    </button>
                </div>

                <!-- Filters Card -->
                <div class="bg-white rounded-[0.5rem] shadow-card mb-6 p-5">
                    <div class="flex flex-col md:flex-row items-end gap-4">
                        
                        <!-- Search -->
                        <div class="flex flex-col w-full md:flex-1">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Pencarian</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-muted text-[18px]">search</span>
                                <input type="text" placeholder="Cari Nama Petani atau NIK..." class="w-full pl-10 pr-4 py-2 border border-border rounded-[0.375rem] text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                            </div>
                        </div>
                        
                        <!-- Desa / Kecamatan -->
                        <div class="flex flex-col w-full md:w-48">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Desa / Kecamatan</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua Wilayah</option>
                                <option value="desa_a">Suka Maju</option>
                                <option value="desa_b">Tani Makmur</option>
                                <option value="desa_c">Sumber Rejo</option>
                            </select>
                        </div>
                        
                        <!-- Status -->
                        <div class="flex flex-col w-full md:w-40">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Status</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Non-Aktif</option>
                                <option value="pending">Menunggu</option>
                            </select>
                        </div>

                        <!-- Action -->
                        <div class="w-full md:w-auto">
                            <button class="w-full md:w-auto border border-border hover:bg-black/5 text-heading font-medium text-[15px] py-2 px-4 rounded-[0.375rem] transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">filter_list</span>
                                Filter
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Data Table Card -->
                <div class="bg-white rounded-[0.5rem] shadow-card">
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[900px]">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase w-12 text-center">#</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Nama Petani</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">NIK</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Desa / Kecamatan</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Total Lahan</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Status</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase text-right w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] text-body">
                                
                                <!-- Row 1 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">1</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Budi+S&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Budi">
                                            <div>
                                                <div class="font-medium text-heading">Budi Santoso</div>
                                                <div class="text-[12px] text-muted">Kelompok Tani Makmur</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050001</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Suka Maju</div>
                                        <div class="text-[12px] text-muted">Kec. Nglegok</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            2.5 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-primary/10 text-primary text-[12px] font-medium">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">2</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Siti+M&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Siti">
                                            <div>
                                                <div class="font-medium text-heading">Siti Maryam</div>
                                                <div class="text-[12px] text-muted">Kelompok Tani Sejahtera</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050002</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Suka Maju</div>
                                        <div class="text-[12px] text-muted">Kec. Nglegok</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            1.8 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-warning/10 text-warning text-[12px] font-medium">Menunggu</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">3</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Haji+M&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Haji">
                                            <div>
                                                <div class="font-medium text-heading">Haji Maman</div>
                                                <div class="text-[12px] text-muted">Ketua Gapoktan</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050003</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Sumber Rejo</div>
                                        <div class="text-[12px] text-muted">Kec. Ponggok</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            4.0 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-primary/10 text-primary text-[12px] font-medium">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">4</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Tarjo&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Tarjo">
                                            <div>
                                                <div class="font-medium text-heading">Tarjo Kusumo</div>
                                                <div class="text-[12px] text-muted">Petani Mandiri</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050004</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Tani Makmur</div>
                                        <div class="text-[12px] text-muted">Kec. Udanawu</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            1.2 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-secondary/10 text-secondary text-[12px] font-medium">Non-Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-[13px] text-muted">Menampilkan 1 hingga 4 dari 85 Petani</span>
                        <div class="flex items-center gap-1">
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border text-muted hover:bg-black/5 transition-colors disabled:opacity-50" disabled>
                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] bg-primary text-white font-medium text-[13px] shadow-primary">1</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">2</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">3</button>
                            <span class="w-8 h-8 flex items-center justify-center text-muted text-[13px]">...</span>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">12</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border text-muted hover:bg-black/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </button>
                        </div>
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
