<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    #confetti-canvas {
        transition: opacity 0.5s;
    }

    /* Pour le bouton */
    .complete-task {
        transition: transform 0.3s;
    }

    .complete-task:active {
        transform: scale(0.95);
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <!-- Messages Flash -->
        <div id="flash-messages" class="fixed inset-x-0 top-20 z-50 flex justify-center">
            @if (session('success'))
                <div
                    class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-full max-w-md mx-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="flash-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-full max-w-md mx-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');

            flashMessages.forEach(message => {
                // Afficher avec un léger délai pour le rendu initial
                setTimeout(() => {
                    message.style.display = 'block';

                    // Masquer après 5 secondes
                    setTimeout(() => {
                        message.style.opacity = '1';
                        let fadeEffect = setInterval(() => {
                            if (!message.style.opacity) {
                                message.style.opacity = '1';
                            }
                            if (message.style.opacity > '0') {
                                message.style.opacity = parseFloat(message.style
                                    .opacity) - 0.1;
                            } else {
                                clearInterval(fadeEffect);
                                message.style.display = 'none';
                            }
                        }, 100);
                    }, 5000);
                }, 100);
            });
        });
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <canvas id="confetti-canvas"
        style="position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:1000; display:none;"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.js-confetti-btn');
            const canvas = document.getElementById('confetti-canvas') || createCanvas();
            const ctx = canvas.getContext('2d');
            let particles = [];

            function createCanvas() {
                const canvas = document.createElement('canvas');
                canvas.id = 'confetti-canvas';
                canvas.style.cssText =
                    'position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:1000; display:none;';
                document.body.appendChild(canvas);
                return canvas;
            }

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            class Confetti {
                constructor(x, y) {
                    this.x = x;
                    this.y = y;
                    this.size = Math.random() * 8 + 5;
                    this.speedX = Math.random() * 6 - 3;
                    this.speedY = Math.random() * -15 - 5;
                    this.color = `hsl(${Math.random() * 360}, 100%, 50%)`;
                    this.rotation = Math.random() * 360;
                    this.rotationSpeed = Math.random() * 5 - 2.5;
                    this.gravity = 0.2;
                }

                update() {
                    this.speedY += this.gravity;
                    this.x += this.speedX;
                    this.y += this.speedY;
                    this.rotation += this.rotationSpeed;
                }

                draw() {
                    ctx.save();
                    ctx.translate(this.x, this.y);
                    ctx.rotate(this.rotation * Math.PI / 180);
                    ctx.fillStyle = this.color;
                    ctx.fillRect(-this.size / 2, -this.size / 2, this.size, this.size);
                    ctx.restore();
                }
            }

            function animate() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                particles.forEach((particle, index) => {
                    particle.update();
                    particle.draw();

                    if (particle.y > canvas.height) {
                        particles.splice(index, 1);
                    }
                });

                if (particles.length > 0) {
                    requestAnimationFrame(animate);
                } else {
                    canvas.style.display = 'none';
                }
            }

            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const rect = button.getBoundingClientRect();
                    const x = rect.left + rect.width / 2;
                    const y = rect.top + rect.height / 2;

                    // Créer 80 particules
                    for (let i = 0; i < 80; i++) {
                        particles.push(new Confetti(x, y));
                    }

                    canvas.style.display = 'block';
                    animate();
                });
            });
        });
    </script>
</body>

</html>
