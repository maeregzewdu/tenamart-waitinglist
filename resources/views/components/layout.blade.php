<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TenaMart – Join the Waitlist for Ethiopia’s New Pharmacy Marketplace</title>
        <meta name="description" content="TenaMart is a new online pharmacy marketplace for Ethiopia. Join the waitlist to get early access and special offers.">
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="TenaMart, Tena Mart, Ethiopia pharmacy, online medicine, pharmacy marketplace, digital health, online pharmacy, waitlist, early access, healthcare, medicine delivery">

        <!-- Canonical -->
        <link rel="canonical" href="https://tenamart.et/">

        <!-- Open Graph (Facebook, LinkedIn) -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="TenaMart – Join the Waitlist">
        <meta property="og:description" content="Get early access to Ethiopia’s first pharmacy marketplace.">
        <meta property="og:image" content="{{ asset('favicon/og-image.png') }}">
        <meta property="og:url" content="https://tenamart.et/">
        <meta property="og:site_name" content="TenaMart">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="TenaMart – Join the Waitlist">
        <meta name="twitter:description" content="Be the first to access TenaMart — Ethiopia’s digital pharmacy platform.">
        <meta name="twitter:image" content="{{ asset('favicon/og-image.png') }}">

        <!-- Language -->
        <meta http-equiv="Content-Language" content="en">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=raleway:400,500,600,700" rel="stylesheet" />
        
        <!-- Remix Icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

        <!-- Favicons -->
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
        <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
        <meta name="apple-mobile-web-app-title" content="TenaMart" />
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            .blur-edge {
                position: fixed;
                width: 100vw;
                height: 100vh;
                pointer-events: none;
                z-index: 0;
            }
            .blur-edge::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 300px;
                background: linear-gradient(to bottom, rgba(255,255,255,1), rgba(255,255,255,0));
            }
            .blur-edge::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 300px;
                background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));
            }
            .content-wrapper {
                position: relative;
                z-index: 1;
            }

            /* Dot pattern background */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: radial-gradient(rgba(16, 185, 130, 0.4) 1px, transparent 1px);
                background-size: 30px 30px;
                pointer-events: none;
                z-index: 0;
            }

            body {
                font-family: 'Raleway', sans-serif;
            }

            /* Decorative elements */
            .decorative-elements {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 0;
            }

            .floating-icon {
                position: absolute;
                color: rgba(16, 185, 130, 0.25);
                animation: float 6s ease-in-out infinite;
            }

            @keyframes float {
                0% {
                    transform: translateY(0) rotate(0deg);
                }
                50% {
                    transform: translateY(-20px) rotate(5deg);
                }
                100% {
                    transform: translateY(0) rotate(0deg);
                }
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .content-wrapper {
                    padding: 0 1rem;
                }
                .floating-icon {
                    display: none;
                }
                .floating-icon.mobile-visible {
                    display: block;
                }
                body::before {
                    background-size: 20px 20px;
                }
            }
        </style>
    </head>
    
    {{ $slot }}

</html>