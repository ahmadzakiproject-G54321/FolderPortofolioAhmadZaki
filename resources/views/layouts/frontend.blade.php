<!DOCTYPE html>
<html lang="id">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', $setting?->site_name ?? 'Portfolio Ahmad Zaki')</title>
    <meta name="description" content="@yield('meta_description', 'Portofolio digital profesional Ahmad Zaki - Web Developer spesialis PHP, Laravel, RESTful API & MySQL.')">
    <meta name="author" content="{{ $profile->full_name ?? 'Ahmad Zaki' }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / WhatsApp / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $setting?->site_name ?? 'Portofolio Ahmad Zaki')">
    <meta property="og:description" content="@yield('meta_description', 'Portofolio digital profesional Ahmad Zaki - Web Developer spesialis PHP, Laravel, RESTful API & MySQL.')">
    <meta property="og:image" content="{{ !empty($profile?->profile_photo_url) ? $profile->profile_photo_url : asset('assets/profile.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $setting?->site_name ?? 'Portofolio Ahmad Zaki')">
    <meta name="twitter:description" content="@yield('meta_description', 'Portofolio digital profesional Ahmad Zaki - Web Developer spesialis PHP, Laravel, RESTful API & MySQL.')">
    <meta name="twitter:image" content="{{ !empty($profile?->profile_photo_url) ? $profile->profile_photo_url : asset('assets/profile.png') }}">
    @php
        $faviconVersion = $setting?->updated_at?->timestamp ?? time();
        $rawFavicon = $setting?->favicon_url ?? asset('assets/site-favicon.svg');
        $siteFavicon = $rawFavicon . '?v=' . $faviconVersion;
        $siteFaviconMime = \App\Models\Setting::getFaviconMimeType($rawFavicon);
    @endphp
    <link rel="icon" type="{{ $siteFaviconMime }}" href="{{ $siteFavicon }}">
    <link rel="apple-touch-icon" href="{{ $siteFavicon }}">

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ file_exists(public_path('css/style.css')) ? filemtime(public_path('css/style.css')) : time() }}">

    @if(!empty($setting?->primary_color) || !empty($setting?->secondary_color))
    <style>
      :root {
        @if(!empty($setting->primary_color)) --primary: {{ $setting->primary_color }}; @endif
        @if(!empty($setting->secondary_color)) --secondary: {{ $setting->secondary_color }}; @endif
      }
    </style>
    @endif

    @stack('styles')
</head>

<body>

    @yield('content')

    <!-- Back To Top -->
    <button id="backToTop" class="back-to-top">
        <i class="bi bi-arrow-up"></i>
    </button>

    @stack('scripts')

</body>

</html>