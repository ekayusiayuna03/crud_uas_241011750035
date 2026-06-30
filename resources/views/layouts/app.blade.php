<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jadwal Pertandingan') - UAS Rekayasa Web</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @yield('styles')

    <style>
        :root {
            --bg-primary: #0b0f19;
            --bg-secondary: #161e31;
            --bg-accent: #243049;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --primary-color: #6366f1;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --accent-gradient: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
            --success-color: #10b981;
            --glass-bg: rgba(22, 30, 49, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --shadow-premium: 0 10px 30px -10px rgba(0, 0, 0, 0.7);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            background-image: 
                radial-gradient(at 10% 20%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(244, 63, 94, 0.1) 0px, transparent 50%);
            background-attachment: fixed;
        }

        .navbar-premium {
            background: rgba(11, 15, 25, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
            padding: 18px 0;
            z-index: 1000;
        }
        
        .navbar-brand-premium {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #a5b4fc 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link-premium {
            color: var(--text-secondary) !important;
            font-weight: 600;
            padding: 8px 18px !important;
            border-radius: 8px;
            transition: var(--transition-smooth);
        }

        .nav-link-premium:hover, .nav-link-premium.active {
            color: var(--text-primary) !important;
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-login-premium {
            background: var(--primary-gradient);
            border: none;
            color: #fff !important;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: var(--transition-smooth);
        }

        .btn-login-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-logout-premium {
            background: rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(244, 63, 94, 0.2);
            color: #f43f5e !important;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 10px;
            transition: var(--transition-smooth);
        }

        .btn-logout-premium:hover {
            background: #f43f5e;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(244, 63, 94, 0.3);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            padding: 25px;
            box-shadow: var(--shadow-premium);
            transition: var(--transition-smooth);
        }

        .glass-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 15px 35px -10px rgba(99, 102, 241, 0.15);
        }

        .form-control-premium {
            background-color: var(--bg-accent) !important;
            border: 1px solid var(--glass-border) !important;
            color: var(--text-primary) !important;
            padding: 12px 16px;
            border-radius: 10px;
            transition: var(--transition-smooth);
        }

        .form-control-premium:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
            outline: none;
        }

        .form-label-premium {
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        footer {
            margin-top: auto;
            border-top: 1px solid var(--glass-border);
            background: rgba(11, 15, 25, 0.95);
            padding: 25px 0;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .badge-premium {
            font-size: 0.8rem;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 6px;
        }

        .alert-premium {
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background-color: var(--bg-secondary);
            color: var(--text-primary);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-premium">
        <div class="container">
            <a class="navbar-brand navbar-brand-premium" href="{{ route('home') }}">
                <i class="fa-solid fa-trophy text-warning"></i>
                JadwalPertandingan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fa-solid fa-calendar-days me-1"></i> Beranda
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-gauge me-1"></i> Dashboard CRUD
                        </a>
                    </li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-login-premium">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Login Admin
                        </a>
                    @endguest
                    @auth
                        <span class="text-secondary me-3 d-none d-md-inline">
                            <i class="fa-solid fa-user-shield text-info me-1"></i> {{ Auth::user()->name ?: Auth::user()->username }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-logout-premium">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-premium alert-dismissible fade show mb-4 border-start border-success border-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-check text-success fs-4 me-3"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-premium alert-dismissible fade show mb-4 border-start border-danger border-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-exclamation text-danger fs-4 me-3"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start mb-3 mb-md-0">
                    <p class="mb-0">&copy; 2026 <strong>Jadwal Pertandingan</strong>. Ujian Akhir Semester .</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        NIM: <strong>241011750035</strong> | Eka Yusi Ayuna
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>
