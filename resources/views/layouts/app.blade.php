<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title', 'Computer Friends')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">







    <style>
        :root{ --cf-yellow:#FACC15; }
        .cf-hero-title{ color:var(--cf-yellow); font-weight:800; text-align:center; }

        /* Slider: aucune overlay, image toujours claire et sans blanc */
        .cf-slider{ position:relative; overflow:hidden; border-radius:1rem; }
        .cf-slider-track{ display:flex; width:100%; transition:transform 700ms cubic-bezier(.2,.8,.2,1); will-change:transform; }
        .cf-slider-slide{ min-width:100%; }
        .cf-slider-img{ width:100%; height:420px; object-fit:contain; background:#000; display:block; }
        @media (max-width:768px){ .cf-slider-img{ height:280px; } }
        @media (prefers-reduced-motion:reduce){ .cf-slider-track{ transition:none; } }
    </style>
</head>

<body class="bg-black text-white antialiased">
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js" referrerpolicy="no-referrer"></script>
</body>
</html>

