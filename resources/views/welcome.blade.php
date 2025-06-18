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
        <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
        <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
        <meta name="apple-mobile-web-app-title" content="TenaMart" />
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />

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
    <body class="min-h-screen font-['Raleway'] flex flex-col items-center justify-center px-4 py-6 md:py-8 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="decorative-elements">
            <!-- Left side - 13 icons (6 pills, 7 bottles) -->
            <i class="ri-medicine-bottle-line floating-icon mobile-visible" style="font-size: 2.5rem; top: 5%; left: 5%; animation-delay: 0s;"></i>
            <i class="ri-capsule-line floating-icon" style="font-size: 3rem; top: 15%; left: 8%; animation-delay: 2s;"></i>
            <i class="ri-medicine-bottle-fill floating-icon mobile-visible" style="font-size: 2rem; top: 28%; left: 6%; animation-delay: 4s;"></i>
            <i class="ri-capsule-fill floating-icon" style="font-size: 2.5rem; top: 42%; left: 11%; animation-delay: 1.5s;"></i>
            <i class="ri-medicine-bottle-line floating-icon" style="font-size: 3.2rem; top: 55%; left: 7%; animation-delay: 3.5s;"></i>
            <i class="ri-capsule-line floating-icon mobile-visible" style="font-size: 2rem; top: 68%; left: 9%; animation-delay: 5.5s;"></i>
            <i class="ri-medicine-bottle-fill floating-icon" style="font-size: 2.4rem; top: 82%; left: 12%; animation-delay: 1.2s;"></i>
            <i class="ri-capsule-fill floating-icon mobile-visible" style="font-size: 1.8rem; top: 12%; left: 14%; animation-delay: 3.2s;"></i>
            <i class="ri-medicine-bottle-line floating-icon" style="font-size: 2.3rem; top: 32%; left: 15%; animation-delay: 5.2s;"></i>
            <i class="ri-capsule-line floating-icon" style="font-size: 2.2rem; top: 58%; left: 16%; animation-delay: 1.7s;"></i>
            <i class="ri-medicine-bottle-fill floating-icon mobile-visible" style="font-size: 1.8rem; top: 25%; left: 20%; animation-delay: 1.8s;"></i>
            <i class="ri-capsule-fill floating-icon" style="font-size: 2.3rem; top: 65%; left: 24%; animation-delay: 3.8s;"></i>
            <i class="ri-medicine-bottle-line floating-icon" style="font-size: 2.4rem; top: 15%; left: 27%; animation-delay: 5.8s;"></i>

            <!-- Right side - 13 icons (6 pills, 7 bottles) -->
            <i class="ri-medicine-bottle-fill floating-icon mobile-visible" style="font-size: 2rem; top: 8%; right: 7%; animation-delay: 1s;"></i>
            <i class="ri-capsule-line floating-icon" style="font-size: 2.2rem; top: 22%; right: 5%; animation-delay: 3s;"></i>
            <i class="ri-medicine-bottle-fill floating-icon mobile-visible" style="font-size: 1.8rem; top: 35%; right: 9%; animation-delay: 5s;"></i>
            <i class="ri-capsule-fill floating-icon" style="font-size: 1.8rem; top: 48%; right: 6%; animation-delay: 2.5s;"></i>
            <i class="ri-medicine-bottle-line floating-icon" style="font-size: 2.3rem; top: 62%; right: 12%; animation-delay: 4.5s;"></i>
            <i class="ri-capsule-line floating-icon mobile-visible" style="font-size: 1.8rem; top: 75%; right: 8%; animation-delay: 0.5s;"></i>
            <i class="ri-medicine-bottle-fill floating-icon" style="font-size: 1.9rem; top: 88%; right: 6%; animation-delay: 2.2s;"></i>
            <i class="ri-capsule-fill floating-icon mobile-visible" style="font-size: 1.6rem; top: 18%; right: 14%; animation-delay: 4.2s;"></i>
            <i class="ri-medicine-bottle-line floating-icon" style="font-size: 1.7rem; top: 45%; right: 15%; animation-delay: 0.2s;"></i>
            <i class="ri-capsule-line floating-icon" style="font-size: 2.2rem; top: 72%; right: 16%; animation-delay: 2.7s;"></i>
            <i class="ri-medicine-bottle-fill floating-icon mobile-visible" style="font-size: 1.8rem; top: 40%; right: 22%; animation-delay: 2.8s;"></i>
            <i class="ri-capsule-fill floating-icon" style="font-size: 1.9rem; top: 85%; right: 25%; animation-delay: 4.8s;"></i>
            <i class="ri-medicine-bottle-fill floating-icon" style="font-size: 2rem; top: 35%; right: 27%; animation-delay: 0.8s;"></i>
        </div>

        <div class="blur-edge"></div>
        <div class="max-w-2xl w-full space-y-4 md:space-y-6 text-center content-wrapper">
            <img src="{{ asset('logo/logo-teal.svg') }}" alt="TenaMart" class="w-40 md:w-64 mx-auto mb-6 md:mb-8">
            
            <h1 class="text-2xl md:text-4xl font-bold text-[#10b982] mb-2 md:mb-4">Join Our Waitlist</h1>
            <p class="text-gray-600 text-sm md:text-lg mb-4 md:mb-6 max-w-md mx-auto px-2 md:px-4">
                The future of pharmacy is here. Join the waitlist to get early access & special offers from TenaMart.
            </p>

            <form action="/register" method="post" id="waitlistForm" class="max-w-md mx-auto space-y-3 md:space-y-4 px-2 md:px-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                    <input type="text" 
                           name="name" 
                           placeholder="Your Name" 
                           required
                           class="w-full bg-white px-3 md:px-4 py-2 md:py-2.5 rounded-lg border-2 border-gray-200 focus:border-[#10b982] focus:ring-2 focus:ring-[#10b982]/20 outline-none transition-all duration-200 text-gray-700 text-sm md:text-base">
                    <input type="email" 
                           name="email" 
                           placeholder="Your Email" 
                           required
                           class="w-full bg-white px-3 md:px-4 py-2 md:py-2.5 rounded-lg border-2 border-gray-200 focus:border-[#10b982] focus:ring-2 focus:ring-[#10b982]/20 outline-none transition-all duration-200 text-gray-700 text-sm md:text-base">
                </div>
                <div>
                    <input type="text" 
                           name="phone" 
                           placeholder="Your Phone Number" 
                           required
                           class="w-full bg-white px-3 md:px-4 py-2 md:py-2.5 rounded-lg border-2 border-gray-200 focus:border-[#10b982] focus:ring-2 focus:ring-[#10b982]/20 outline-none transition-all duration-200 text-gray-700 text-sm md:text-base">
                </div>
                <button type="submit" 
                        class="w-full bg-[#10b982] text-white font-semibold py-2 md:py-2.5 px-6 rounded-lg hover:bg-[#059669] transform hover:-translate-y-0.5 transition-all duration-200 text-sm md:text-base">
                    Join Waitlist
                </button>
            </form>

            <!-- Success Message -->
            <div id="successMessage" class="hidden max-w-md mx-auto mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700 text-sm md:text-base"></p>
            </div>

            <!-- Error Message -->
            <div id="errorMessage" class="hidden max-w-md mx-auto mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-700 text-sm md:text-base"></p>
            </div>

            <script>
                document.getElementById('waitlistForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const form = this;
                    const submitButton = form.querySelector('button[type="submit"]');
                    const successMessage = document.getElementById('successMessage');
                    const errorMessage = document.getElementById('errorMessage');
                    
                    // Disable submit button and show loading state
                    submitButton.disabled = true;
                    submitButton.innerHTML = 'Processing...';
                    
                    // Hide any existing messages
                    successMessage.classList.add('hidden');
                    errorMessage.classList.add('hidden');
                    
                    // Get form data
                    const formData = new FormData(form);
                    
                    // Send AJAX request
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => Promise.reject(err));
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Hide the form
                        form.style.display = 'none';
                        
                        // Show success message
                        successMessage.querySelector('p').textContent = data.message;
                        successMessage.classList.remove('hidden');
                        
                        // Reset form
                        form.reset();
                    })
                    .catch(error => {
                        // Show error message
                        let errorText = 'Something went wrong. Please try again.';
                        
                        if (error.errors) {
                            // Handle validation errors
                            errorText = Object.values(error.errors).flat().join('<br>');
                        } else if (error.message) {
                            errorText = error.message;
                        }
                        
                        errorMessage.querySelector('p').innerHTML = errorText;
                        errorMessage.classList.remove('hidden');
                    })
                    .finally(() => {
                        // Re-enable submit button
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Join Waitlist';
                    });
                });
            </script>
        </div>
    </body>
</html>