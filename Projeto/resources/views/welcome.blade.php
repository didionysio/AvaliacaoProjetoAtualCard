<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicativo Médico</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Fundo branco */
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background-color: #008000; /* Verde */
            color: white;
        }
        .header {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
        }
        .hero-section {
            display: flex;
            align-items: center;
            height: 100vh; /* Altura da tela cheia */
        }
        .hero-text {
            font-size: 1.5rem;
            line-height: 2;
        }
        .hero-image img {
            max-width: 100%;
            height: 50vh; /* Metade da altura da tela */
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="d-flex align-items-center justify-content-between bg-success text-white py-3 px-4">
    <div class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="me-3" viewBox="0 0 62 65" fill="currentColor" width="48" height="48">
            <path d="M61.8548 14.6253C61.8778..."></path>
        </svg>
        <h1 class="h4 mb-0">Projeto</h1>
    </div>

    <nav>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-light me-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>
</header>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Texto -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-5">
                <div>
                    <h2 class="mb-4">O jeito fácil de cuidar da sua saúde</h2>
                    <p class="hero-text">
                        Nosso aplicativo foi projetado para simplificar o processo de marcação de consultas médicas.
                        Encontre médicos especializados, escolha o horário ideal e gerencie seu histórico médico
                        diretamente na palma da sua mão.
                    </p>
                    <p class="hero-text">
                        Com uma interface amigável e segura, você pode garantir a sua consulta em poucos cliques.
                        Experimente hoje mesmo e aproveite mais praticidade para cuidar do que realmente importa: sua saúde.
                    </p>
                </div>
            </div>
            <!-- Imagem -->
            <div class="col-lg-6 hero-image">
                <img src="https://media.istockphoto.com/id/1496615445/pt/foto/portrait-of-beautiful-happy-woman-smiling-during-sunset-outdoor.jpg?s=612x612&w=0&k=20&c=h-VbaP0pgTqWsjd4t45TkzUF0n5IM1ZGHmnibjJFtgI=" 
                     alt="Aplicativo Médico" 
                     class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <p>&copy; {{ date('Y') }} Aplicativo Médico. Todos os direitos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
