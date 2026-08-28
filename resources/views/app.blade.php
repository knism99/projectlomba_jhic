<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="theme-color" content="#081236">
        <meta name="color-scheme" content="dark light">

        <!-- SEO & OpenGraph Metadata (WhatsApp, Facebook, Google) -->
        <meta name="description" content="Website Resmi SMK Airlangga Balikpapan - Sekolah Tangguh, Berakhlak, dan Berwawasan Digital. Program keahlian PPLG, DKV, TJKT, AKL, dan MPLB.">
        <meta name="keywords" content="SMK Airlangga Balikpapan, Skarla, SMK Terbaik Balikpapan, PPLG, DKV, TJKT, AKL, MPLB, PPDB Balikpapan">
        <meta name="robots" content="index, follow, max-image-preview:large">
        <meta property="og:type" content="website">
        <meta property="og:title" content="SMK Airlangga Balikpapan - Sekolah Tangguh & Berwawasan Digital">
        <meta property="og:description" content="Pusat keunggulan pendidikan vokasi dan teknologi kejuruan di Kota Balikpapan.">
        <meta property="og:image" content="/images/logo-airlangga.webp">
        <meta property="og:site_name" content="SMK Airlangga Balikpapan">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="SMK Airlangga Balikpapan">
        <meta name="twitter:description" content="Sekolah Tangguh, Berakhlak, dan Berwawasan Digital.">

        <!-- JSON-LD Schema.org Structured Data -->
        <script type="application/ld+json">
        @verbatim
        {
          "@context": "https://schema.org",
          "@type": "EducationalOrganization",
          "name": "SMK Airlangga Balikpapan",
          "alternateName": "Skarla",
          "url": "https://smkairlanggabpn.sch.id",
          "logo": "https://smkairlanggabpn.sch.id/images/logo-airlangga.webp",
          "description": "Sekolah Menengah Kejuruan di Balikpapan dengan program keahlian Bisnis Manajemen dan Teknologi.",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jl. Letjen S. Parman No. 14 Gn. Guntur",
            "addressLocality": "Balikpapan",
            "addressRegion": "Kalimantan Timur",
            "postalCode": "76122",
            "addressCountry": "ID"
          }
        }
        @endverbatim
        </script>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="/favicon.png">
        <link rel="icon" type="image/x-icon" href="/favicon.ico">

        <!-- Preload Critical Above-The-Fold Images (Mobile & Desktop Responsive) -->
        <link rel="preload" as="image" href="/images/hero-mobile.webp" type="image/webp" media="(max-width: 640px)" fetchpriority="high">
        <link rel="preload" as="image" href="/images/hero.webp" type="image/webp" media="(min-width: 641px)" fetchpriority="high">
        <link rel="preload" as="image" href="/images/logo-airlangga-sm.webp" type="image/webp" fetchpriority="high">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-slate-950 text-white">
        @inertia
    </body>
</html>
