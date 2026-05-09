<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Computer Friends</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .pc-slider { position: relative; overflow: hidden; }
        .pc-slider-track { display: flex; transition: transform 900ms cubic-bezier(0.2,0.8,0.2,1); will-change: transform; }
        .pc-slider-slide { min-width: 100%; height: 420px; }
        @media (max-width: 768px) {
            .pc-slider-slide { height: 300px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .pc-slider-track { transition: none; }
        }
    </style>
</head>
<body class="bg-black text-white antialiased" style="font-family: Figtree, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;">

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            {{-- Sidebar --}}
            <aside class="lg:col-span-3">
                <div class="h-full rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-4">
                    <div class="flex items-center gap-3 px-2 py-2">
                        <div class="h-10 w-10 rounded-xl bg-yellow-400/15 border border-yellow-400/40 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="14" rx="2"/>
                                <path d="M7 20h10"/>
                            </svg>
                        </div>
                        <h2 class="text-sm md:text-base font-semibold">Catégories</h2>
                    </div>

                    <nav class="mt-3 space-y-2">
                        <a href="#" class="group flex items-center gap-3 px-3 py-3 rounded-xl border border-white/10 bg-white/0 hover:bg-white/5 hover:border-yellow-400/30 transition">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 border border-white/10 group-hover:border-yellow-400/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="6" width="18" height="12" rx="2"/>
                                    <path d="M8 20h8"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold">Ordinateurs</span>
                        </a>

                        <a href="#" class="group flex items-center gap-3 px-3 py-3 rounded-xl border border-white/10 bg-white/0 hover:bg-white/5 hover:border-yellow-400/30 transition">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 border border-white/10 group-hover:border-yellow-400/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 7h16"/>
                                    <path d="M7 4h10"/>
                                    <rect x="3" y="7" width="18" height="14" rx="2"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold">Serveurs</span>
                        </a>

                        <a href="#" class="group flex items-center gap-3 px-3 py-3 rounded-xl border border-white/10 bg-white/0 hover:bg-white/5 hover:border-yellow-400/30 transition">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 border border-white/10 group-hover:border-yellow-400/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 7h10v10H7z"/>
                                    <path d="M4 7h3M17 7h3M4 17h3M17 17h3"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold">PDV</span>
                        </a>

                        <a href="#" class="group flex items-center gap-3 px-3 py-3 rounded-xl border border-white/10 bg-white/0 hover:bg-white/5 hover:border-yellow-400/30 transition">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 border border-white/10 group-hover:border-yellow-400/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="14" rx="2"/>
                                    <path d="M8 20h8"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold">Moniteurs</span>
                        </a>
                    </nav>

                    <div class="mt-4 rounded-2xl border border-white/10 bg-black/30 p-4">
                        <p class="text-xs text-white/55">Astuce</p>
                        <p class="mt-1 text-sm font-semibold text-white">Trouvez votre modèle rapidement.</p>
                        <p class="mt-2 text-xs text-white/45">Cliquez sur une catégorie pour filtrer (à connecter plus tard).</p>
                    </div>
                </div>
            </aside>

            {{-- Main content --}}
            <section class="lg:col-span-9">
                {{-- Slider --}}
                <div class="pc-slider rounded-2xl border border-white/10 bg-white/5">
                    <div class="pc-slider-track" id="pc-slider-track">
                        @php
                            $pcSlides = [
                                [
                                    'src' => asset('Dell-latitude5480.jpg'),
                                    'alt' => 'Dell Latitude 5480',
                                    'title' => 'PC Pro Performance',
                                    'subtitle' => 'Performance, fiabilité et durabilité pour votre quotidien.',
                                ],
                                [
                                    'src' => asset('hp-elitebook-840-g7.jpg'),
                                    'alt' => 'HP EliteBook 840 G7',
                                    'title' => 'Mobilité Premium',
                                    'subtitle' => 'Conçu pour travailler partout, avec une qualité irréprochable.',
                                ],
                            ];
                        @endphp

                        @foreach($pcSlides as $s)
                            <article class="pc-slider-slide relative">
                                <img src="{{ $s['src'] }}" alt="{{ $s['alt'] }}" class="absolute inset-0 w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/35 to-black/10"></div>

                                <div class="relative h-full flex items-end p-5 md:p-8">
                                    <div class="max-w-2xl">
                                        <p class="text-xs md:text-sm text-white/70 uppercase tracking-widest">Computer Friends</p>
                                        <h1 class="mt-2 text-2xl md:text-4xl font-bold leading-tight">
                                            {{ $s['title'] }}
                                        </h1>
                                        <p class="mt-3 text-sm md:text-base text-white/70 leading-relaxed">{{ $s['subtitle'] }}</p>

                                        <div class="mt-6 flex flex-wrap gap-3">
                                            <a href="#" class="inline-flex items-center justify-center rounded-full bg-yellow-400/20 border border-yellow-400/50 px-5 py-2.5 text-sm font-semibold text-yellow-200 hover:bg-yellow-400/25">Découvrir</a>
                                            <a href="#" class="inline-flex items-center justify-center rounded-full bg-white/5 border border-white/10 px-5 py-2.5 text-sm font-semibold text-white hover:bg-white/10">Comparer</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="absolute bottom-4 md:bottom-6 left-1/2 -translate-x-1/2 flex gap-2 px-3" id="pc-slider-dots">
                        @for($i = 0; $i < count($pcSlides); $i++)
                            <button type="button" class="h-2.5 w-2.5 rounded-full bg-white/20 hover:bg-white/40" data-dot="{{ $i }}" aria-label="Slide {{ $i+1 }}"></button>
                        @endfor
                    </div>
                </div>

                {{-- Benefits band (Arabic) --}}
                <div class="mt-5">
                    <div class="rounded-2xl border border-black/10 bg-white">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-0">
                            <div class="p-5 border-b border-black/10 sm:border-b-0 sm:border-r border-black/10 last:sm:border-r-0">
                                <div class="flex items-start gap-3">
                                    <span class="text-2xl leading-none">💻</span>
                                    <div>
                                        <p class="font-semibold text-black">حواسيب أصلية</p>
                                        <p class="text-sm text-black/75">عروض حصرية • توصيل مجاني 🚚</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 border-b border-black/10 sm:border-b-0 sm:border-r border-black/10 last:sm:border-r-0">
                                <div class="flex items-start gap-3">
                                    <span class="text-2xl leading-none">📍</span>
                                    <div>
                                        <p class="font-semibold text-black">بيع وشراء الحواسيب بجودة مضمونة</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 border-b border-black/10 sm:border-b-0 sm:border-r border-black/10 last:sm:border-r-0">
                                <div class="flex items-start gap-3">
                                    <span class="text-2xl leading-none">🎁</span>
                                    <div>
                                        <p class="font-semibold text-black">ضمان 3 شهور</p>
                                        <p class="text-sm text-black/75">+ الدفع عند الاستلام</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="flex items-start gap-3">
                                    <span class="text-2xl leading-none">📲</span>
                                    <div>
                                        <p class="font-semibold text-black">تواصل معنا على واتساب</p>
                                        <p class="text-sm text-black/75">وخد العرض ديالك الآن</p>
                                    </div>
                                </div>
                                <a href="#" class="mt-4 inline-flex items-center rounded-xl bg-black text-white px-4 py-2 text-sm font-semibold hover:bg-black/90 transition">
                                    واتساب
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 12a8 8 0 0 1-8 8 8 8 0 0 1-4.9-1.7L4 20l1.7-3.1A8 8 0 1 1 20 12z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        (function () {
            const track = document.getElementById('pc-slider-track');
            const dotsWrap = document.getElementById('pc-slider-dots');
            if (!track || !dotsWrap) return;

            const slidesCount = track.children.length;
            let index = 0;
            let timer = null;

            const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const dotBtns = Array.from(dotsWrap.querySelectorAll('button[data-dot]'));

            function setIndex(i) {
                index = (i + slidesCount) % slidesCount;
                track.style.transform = `translateX(${-index * 100}%)`;

                dotBtns.forEach(btn => {
                    const dotIndex = Number(btn.getAttribute('data-dot'));
                    const active = dotIndex === index;
                    btn.classList.toggle('bg-yellow-400', active);
                    btn.classList.toggle('bg-white/20', !active);
                });
            }

            function next() { setIndex(index + 1); }

            setIndex(0);

            if (!prefersReduced) {
                timer = window.setInterval(next, 3600);
            }

            dotsWrap.addEventListener('click', (e) => {
                const btn = e.target.closest('button[data-dot]');
                if (!btn) return;
                const i = Number(btn.getAttribute('data-dot'));
                if (!Number.isFinite(i)) return;

                if (timer) {
                    window.clearInterval(timer);
                    timer = window.setInterval(next, 3600);
                }

                setIndex(i);
            });
        })();
    </script>
</body>
</html>

