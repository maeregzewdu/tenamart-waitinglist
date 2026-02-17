<x-layout>
    <body class="font-['Raleway']">
        <nav class="mx-auto">
            <div class="px-6 md:px-16 pt-8">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <a href="/" class="flex-shrink-0 group">
                        <img class="h-10 md:h-12 w-auto transform transition-transform group-hover:scale-105"
                            src="{{ asset('logo/logo-teal.svg') }}" alt="Logo">
                    </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex font-medium items-center text-sm text-neutral-600 gap-12">
                        <a class="hover:underline" href="/">Home</a>
                        <a class="hover:underline" href="#how-it-works">How it works</a>
                        <a class="hover:underline" href="#why-us">Why us</a>
                        <a class="hover:underline" href="#faq">FAQ</a>
                    </div>

                    <!-- Right Side Navigation -->
                    <div class="text-sm text-neutral-700 font-medium">
                        <a class="hover:underline cursor-pointer"
                            onclick="document.getElementById('nameInput').focus()">Join the waitlist</a>
                    </div>
                </div>
            </div>
        </nav>

        <div id="hero" class="py-40 md:py-40 flex flex-col items-center justify-center relative">

            <div class="max-w-2xl w-full space-y-4 md:space-y-6 text-center content-wrapper">

                <h1 class="text-2xl md:text-5xl font-bold text-[#10b982] mb-2 md:mb-4 leading-[1.3]">The Future of
                    Pharmacies <br> in Ethiopia – Coming Soon.</h1>
                <p class="text-gray-600 text-sm md:text-lg mb-4 md:mb-6 max-w-md mx-auto px-2 md:px-4">
                    Order medicines online, or grow your pharmacy business with TenaMart.
                </p>

                <form action="/waiting-list" method="post" id="waitlistForm"
                    class="max-w-md mx-auto space-y-3 md:space-y-4 px-2 md:px-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                        <input type="text" id="nameInput" name="name" placeholder="Your Name" required
                            class="w-full bg-white px-3 md:px-4 py-2 md:py-2.5 rounded-lg border-2 border-gray-200 focus:border-[#10b982] focus:ring-2 focus:ring-[#10b982]/20 outline-none transition-all duration-200 text-gray-700 text-sm md:text-base">
                        <input type="email" name="email" placeholder="Your Email" required
                            class="w-full bg-white px-3 md:px-4 py-2 md:py-2.5 rounded-lg border-2 border-gray-200 focus:border-[#10b982] focus:ring-2 focus:ring-[#10b982]/20 outline-none transition-all duration-200 text-gray-700 text-sm md:text-base">
                    </div>
                    <div>
                        <input type="text" name="phone" placeholder="Your Phone Number" required
                            class="w-full bg-white px-3 md:px-4 py-2 md:py-2.5 rounded-lg border-2 border-gray-200 focus:border-[#10b982] focus:ring-2 focus:ring-[#10b982]/20 outline-none transition-all duration-200 text-gray-700 text-sm md:text-base">
                    </div>
                    <button type="submit"
                        class="w-full cursor-pointer bg-[#10b982] text-white font-semibold py-2 md:py-2.5 px-6 rounded-lg hover:bg-[#059669] transform hover:-translate-y-0.5 transition-all duration-200 text-sm md:text-base">
                        Join Waitlist
                    </button>
                </form>

                <!-- Success Message -->
                <div id="successMessage"
                    class="hidden max-w-md mx-auto mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-700 text-sm md:text-base"></p>
                </div>

                <!-- Error Message -->
                <div id="errorMessage"
                    class="hidden max-w-md mx-auto mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-red-700 text-sm md:text-base"></p>
                </div>

            </div>
        </div>

        <!-- Demo Promotion Section -->
        <section class="py-16 md:py-20 px-6 bg-white">
            <div class="mx-auto max-w-4xl relative overflow-hidden">
                <!-- Decorative accents -->
                <span class="pointer-events-none absolute -top-16 -left-16 h-64 w-64 rounded-full bg-[#10b982]/10 blur-3xl"></span>
                <span class="pointer-events-none absolute -bottom-20 -right-20 h-64 w-64 rounded-full bg-[#10b982]/10 blur-3xl"></span>
                <div class="bg-white rounded-xl border border-neutral-200 p-8 md:p-10 text-center space-y-4 md:space-y-5 shadow-sm">
                    <div class="flex items-center justify-center gap-2 md:gap-3">
                        <h2 class="text-2xl md:text-3xl font-bold text-neutral-900">
                            Try our <span class="text-[#10b982]">demo</span> today
                        </h2>
                        <i class="ri-arrow-right-up-line text-[#10b982] text-xl md:text-2xl"></i>
                    </div>
                    <p class="text-neutral-600 text-sm md:text-base max-w-2xl mx-auto px-4">
                        Explore our fully functional demo and see how TenaMart works.
                    </p>

                    <div class="pt-2">
                        <a href="https://demo.tenamart.et" target="_blank"
                            class="relative cursor-pointer w-fit px-6 py-3 rounded-full font-semibold text-white bg-[#10b982] mx-auto inline-flex items-center gap-2 overflow-hidden transition-all duration-200 hover:bg-[#0fa972] hover:shadow-md hover:-translate-y-0.5">
                            <!-- White dotted pattern -->
                            <span
                                class="absolute inset-0 bg-[radial-gradient(white_1px,transparent_1px)] [background-size:10px_10px] opacity-20"></span>

                            <!-- Button content (above dots) -->
                            <span class="relative">Visit demo site</span>
                            <i class="ri-arrow-right-up-line relative"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="py-24 px-6 md:py-28 bg-white">
            <div class="max-w-6xl mx-auto">
                <div class="text-center space-y-6 mb-12 md:mb-16">
                    <img src="{{ asset('images/how-it-works.svg') }}" alt="How it works illustration"
                        class="mx-auto h-18 md:h-24 opacity-90">
                    <h2 class="text-2xl md:text-4xl font-bold text-neutral-900">How it works</h2>
                    <p class="text-neutral-600 text-sm md:text-base">A simple flow for both customers and pharmacies</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <!-- Customers Card -->
                    <div
                        class="bg-white rounded-xl md:rounded-2xl border border-neutral-200 p-6 md:p-8 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#10b982]/10 text-[#10b982]">
                                <i class="ri-user-line"></i>
                            </span>
                            <h3 class="text-lg md:text-xl font-semibold text-neutral-800">For Customers</h3>
                        </div>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <span
                                    class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-[#10b982] ring-1 ring-[#10b982]/50 text-sm font-semibold">1</span>
                                <div>
                                    <p class="font-medium text-neutral-900">Search & find medicines</p>
                                    <p class="text-neutral-600 text-sm md:text-base">Browse verified pharmacies, compare
                                        options, and see availability near you.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span
                                    class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-[#10b982] ring-1 ring-[#10b982]/50 text-sm font-semibold">2</span>
                                <div>
                                    <p class="font-medium text-neutral-900">Place your order</p>
                                    <p class="text-neutral-600 text-sm md:text-base">Add items to your cart and securely
                                        submit your order in a few taps.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span
                                    class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-[#10b982] ring-1 ring-[#10b982]/50 text-sm font-semibold">3</span>
                                <div>
                                    <p class="font-medium text-neutral-900">Get fast delivery or pickup</p>
                                    <p class="text-neutral-600 text-sm md:text-base">Receive your medicines at your
                                        door, or pick them up at a nearby pharmacy.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pharmacies Card -->
                    <div
                        class="bg-white rounded-xl md:rounded-2xl border border-neutral-200 p-6 md:p-8 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#10b982]/10 text-[#10b982]">
                                <i class="ri-store-2-line"></i>
                            </span>
                            <h3 class="text-lg md:text-xl font-semibold text-neutral-800">For Pharmacies</h3>
                        </div>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <span
                                    class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-[#10b982] ring-1 ring-[#10b982]/50 text-sm font-semibold">1</span>
                                <div>
                                    <p class="font-medium text-neutral-900">Join the marketplace</p>
                                    <p class="text-neutral-600 text-sm md:text-base">Create your profile and verify your
                                        pharmacy to start receiving orders.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span
                                    class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-[#10b982] ring-1 ring-[#10b982]/50 text-sm font-semibold">2</span>
                                <div>
                                    <p class="font-medium text-neutral-900">List inventory easily</p>
                                    <p class="text-neutral-600 text-sm md:text-base">Upload products, set prices, and
                                        keep stock updated with simple tools.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span
                                    class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-full bg-white text-[#10b982] ring-1 ring-[#10b982]/50 text-sm font-semibold">3</span>
                                <div>
                                    <p class="font-medium text-neutral-900">Fulfill orders & grow</p>
                                    <p class="text-neutral-600 text-sm md:text-base">Prepare orders for delivery or
                                        pickup, reach more customers, and grow sales.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-14 text-center">
                    <a href="https://demo.tenamart.et" target="_blank"
                        class="relative cursor-pointer w-fit px-6 py-3 rounded-full font-semibold text-white bg-[#10b982] mx-auto inline-flex items-center gap-2 overflow-hidden transition-all duration-200 hover:bg-[#0fa972] hover:shadow-md hover:-translate-y-0.5">
                        <!-- White dotted pattern -->
                        <span
                            class="absolute inset-0 bg-[radial-gradient(white_1px,transparent_1px)] [background-size:10px_10px] opacity-20"></span>

                        <!-- Button content (above dots) -->
                        <span class="relative">View demo</span>
                        <i class="ri-arrow-right-up-line relative"></i>
                    </a>
                </div>
            </div>
        </section>

        <section id="why-us" class="bg-neutral-50 py-24 px-6 md:py-28">
            <div class="mx-auto max-w-6xl">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-4">
                        Why <span class="text-[#10b982]">TenaMart?</span>
                    </h2>
                    <p class="text-lg text-neutral-600">
                        A trusted platform designed for <span class="font-semibold">customers</span> and
                        <span class="font-semibold">pharmacies</span> in Ethiopia.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Customers -->
                    <div
                        class="bg-white rounded-2xl border border-neutral-200 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 overflow-hidden">
                        <div class="mb-10">
                            <img class="w-full" src="{{ asset('images/customer-snapshot-cropped.png') }}"
                                alt="">
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#10b982]/10 text-[#10b982]">
                                    <i class="ri-user-heart-line text-lg"></i>
                                </span>
                                <h3 class="text-xl font-semibold text-neutral-900">For Customers</h3>
                            </div>
                            <div class="grid gap-6">
                                <div class="flex items-start gap-4">
                                    <i class="ri-shield-check-line text-[#10b982] text-xl"></i>
                                    <div>
                                        <p class="font-medium text-neutral-900">Confidence in every order</p>
                                        <p class="text-sm text-neutral-600">We partner only with verified pharmacies.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <i class="ri-store-2-line text-[#10b982] text-xl"></i>
                                    <div>
                                        <p class="font-medium text-neutral-900">Real choice & real savings</p>
                                        <p class="text-sm text-neutral-600">Compare pharmacies, prices, and delivery
                                            options near you.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <i class="ri-upload-cloud-line text-[#10b982] text-xl"></i>
                                    <div>
                                        <p class="font-medium text-neutral-900">Fast, secure, trackable</p>
                                        <p class="text-sm text-neutral-600">Upload prescriptions, pay safely, and track
                                            orders in real time.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pharmacies -->
                    <div
                        class="bg-white rounded-2xl border border-neutral-200 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 overflow-hidden">
                        <div class="mb-6">
                            <img src="{{ asset('images/pharmacy-snapshot-cropped.png') }}" alt="">
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#10b982]/10 text-[#10b982]">
                                    <i class="ri-store-2-line text-lg"></i>
                                </span>
                                <h3 class="text-xl font-semibold text-neutral-900">For Pharmacies</h3>
                            </div>
                            <div class="grid gap-6">
                                <div class="flex items-start gap-4">
                                    <i class="ri-user-shared-line text-[#10b982] text-xl"></i>
                                    <div>
                                        <p class="font-medium text-neutral-900">Expand your reach</p>
                                        <p class="text-sm text-neutral-600">Get discovered citywide and serve more
                                            customers digitally.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <i class="ri-tools-line text-[#10b982] text-xl"></i>
                                    <div>
                                        <p class="font-medium text-neutral-900">Tools that work for you</p>
                                        <p class="text-sm text-neutral-600">Manage stock, branches, staff, and orders
                                            in one dashboard.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <i class="ri-bar-chart-2-line text-[#10b982] text-xl"></i>
                                    <div>
                                        <p class="font-medium text-neutral-900">Insights that grow revenue</p>
                                        <p class="text-sm text-neutral-600">Use promotions and analytics to maximize
                                            growth.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Proof Section -->
        <section class="py-24 md:py-28 px-6 bg-white">
            <div class="mx-auto max-w-6xl">
                <div class="text-center mb-12">
                    <h3 class="text-xl md:text-2xl font-semibold text-neutral-900">Proof we’re serious</h3>
                    <p class="text-neutral-600 text-sm md:text-base mt-2">Milestones that show we’re building for real
                        impact</p>
                </div>

                <!-- Achievement Badges -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div
                        class="relative overflow-hidden bg-white border border-neutral-200 rounded-xl p-6 shadow-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                        <div class="absolute inset-0 pointer-events-none"
                            style="background: radial-gradient(600px circle at 0 0, rgba(16,185,130,0.06), transparent 40%);">
                        </div>
                        <div class="flex gap-3 items-start">
                            <span
                                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#10b982]/10 text-[#10b982] flex-shrink-0">
                                <i class="ri-trophy-line text-2xl leading-none"></i>
                            </span>
                            <div class="space-y-1">
                                <p class="font-semibold text-neutral-900">2nd Place — Biruh Competition</p>
                                <p class="text-neutral-600 text-sm">Achieved city-wide recognition for our innovative
                                    business solution and team execution</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div
                        class="relative overflow-hidden bg-white border border-neutral-200 rounded-xl p-6 shadow-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                        <div class="absolute inset-0 pointer-events-none"
                            style="background: radial-gradient(600px circle at 100% 0, rgba(16,185,130,0.06), transparent 40%);">
                        </div>
                        <div class="flex gap-3 items-start">
                            <span
                                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#10b982]/10 text-[#10b982] flex-shrink-0">
                                <i class="ri-funds-line text-2xl leading-none"></i>
                            </span>
                            <div class="space-y-1">
                                <p class="font-semibold text-neutral-900">ETB 250,000 in funding</p>
                                <p class="text-neutral-600 text-sm">Successfully raised capital to accelerate
                                    development and prepare for a strong product launch</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div
                        class="relative overflow-hidden bg-white border border-neutral-200 rounded-xl p-6 shadow-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                        <div class="absolute inset-0 pointer-events-none"
                            style="background: radial-gradient(600px circle at 50% 0, rgba(16,185,130,0.06), transparent 40%);">
                        </div>
                        <div class="flex gap-3 items-start">
                            <span
                                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#10b982]/10 text-[#10b982] flex-shrink-0">
                                <i class="ri-focus-3-line text-2xl leading-none"></i>
                            </span>
                            <div class="space-y-1">
                                <p class="font-semibold text-neutral-900">Big vision</p>
                                <p class="text-neutral-600 text-sm">Becoming Ethiopia’s leading digital pharmacy
                                    platform connecting users and verified pharmacies seamlessly</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="py-24 md:py-28 px-6 bg-white">
            <div class="mx-auto max-w-6xl">
                <div class="text-center mb-10 md:mb-12">
                    <h2 class="text-2xl md:text-4xl font-bold text-neutral-900">Frequently asked questions</h2>
                    <p class="text-neutral-600 text-sm md:text-base mt-3">Everything you need to know about using
                        TenaMart</p>
                </div>

                <div>
                    <!-- Item 1 -->
                    <div class="faq-item border-b border-neutral-200 bg-white p-5 md:p-6 transition-all duration-200">
                        <button type="button"
                            class="faq-toggle cursor-pointer w-full flex items-center justify-between gap-6 text-left"
                            aria-expanded="false" aria-controls="faq-1">
                            <span class="font-semibold text-neutral-900">What is TenaMart?</span>
                            <i class="ri-add-line text-[#10b982] text-xl"></i>
                        </button>
                        <div id="faq-1" class="faq-answer hidden mt-3 text-neutral-600 text-sm md:text-base">
                            TenaMart is a platform that connects customers with verified pharmacies to order medicines
                            online for delivery or pickup.
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="faq-item border-b border-neutral-200 bg-white p-5 md:p-6 transition-all duration-200">
                        <button type="button"
                            class="faq-toggle cursor-pointer w-full flex items-center justify-between gap-6 text-left"
                            aria-expanded="false" aria-controls="faq-2">
                            <span class="font-semibold text-neutral-900">How do I place an order?</span>
                            <i class="ri-add-line text-[#10b982] text-xl"></i>
                        </button>
                        <div id="faq-2" class="faq-answer hidden mt-3 text-neutral-600 text-sm md:text-base">
                            Search for your medicines, choose a pharmacy, add items to your cart, and securely submit
                            your order. You can track progress in real time.
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="faq-item border-b border-neutral-200 bg-white p-5 md:p-6 transition-all duration-200">
                        <button type="button"
                            class="faq-toggle cursor-pointer w-full flex items-center justify-between gap-6 text-left"
                            aria-expanded="false" aria-controls="faq-3">
                            <span class="font-semibold text-neutral-900">Do I need a prescription?</span>
                            <i class="ri-add-line text-[#10b982] text-xl"></i>
                        </button>
                        <div id="faq-3" class="faq-answer hidden mt-3 text-neutral-600 text-sm md:text-base">
                            A valid prescription is required for prescription-only medicines. You can upload a photo
                            during checkout.
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="faq-item border-b border-neutral-200 bg-white p-5 md:p-6 transition-all duration-200">
                        <button type="button"
                            class="faq-toggle cursor-pointer w-full flex items-center justify-between gap-6 text-left"
                            aria-expanded="false" aria-controls="faq-4">
                            <span class="font-semibold text-neutral-900">How are pharmacies verified?</span>
                            <i class="ri-add-line text-[#10b982] text-xl"></i>
                        </button>
                        <div id="faq-4" class="faq-answer hidden mt-3 text-neutral-600 text-sm md:text-base">
                            We verify licenses and compliance before a pharmacy goes live, and we continuously monitor
                            quality and reliability.
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="faq-item border-b border-neutral-200 bg-white p-5 md:p-6 transition-all duration-200">
                        <button type="button"
                            class="faq-toggle cursor-pointer w-full flex items-center justify-between gap-6 text-left"
                            aria-expanded="false" aria-controls="faq-5">
                            <span class="font-semibold text-neutral-900">How much does delivery cost?</span>
                            <i class="ri-add-line text-[#10b982] text-xl"></i>
                        </button>
                        <div id="faq-5" class="faq-answer hidden mt-3 text-neutral-600 text-sm md:text-base">
                            Delivery fees vary by distance and pharmacy. You’ll see the exact cost before you confirm
                            your order.
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="faq-item bg-white p-5 md:p-6 transition-all duration-200">
                        <button type="button"
                            class="faq-toggle cursor-pointer w-full flex items-center justify-between gap-6 text-left"
                            aria-expanded="false" aria-controls="faq-6">
                            <span class="font-semibold text-neutral-900">How can my pharmacy join?</span>
                            <i class="ri-add-line text-[#10b982] text-xl"></i>
                        </button>
                        <div id="faq-6" class="faq-answer hidden mt-3 text-neutral-600 text-sm md:text-base">
                            Submit your details to join the waitlist <a
                                onclick="document.getElementById('nameInput').focus()"
                                class="cursor-pointer text-[#10b982] hover:underline">here</a>. We’ll reach out to
                            verify your information and help you get set up.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 md:py-28 px-6">
            <div class="mx-auto max-w-6xl">
                <div class="relative overflow-hidden rounded-2xl border border-neutral-200 bg-gradient-to-br from-[#10b982]/5 via-white to-white p-8 md:p-12 shadow-sm">
                    <!-- Decorative accents -->
                    <span class="pointer-events-none absolute -top-16 -left-16 h-64 w-64 rounded-full bg-[#10b982]/10 blur-3xl"></span>
                    <span class="pointer-events-none absolute -bottom-20 -right-20 h-64 w-64 rounded-full bg-[#10b982]/10 blur-3xl"></span>

                    <div class="relative text-center max-w-2xl mx-auto">
                        <h2 class="text-2xl md:text-4xl font-bold text-neutral-900">Be first to try TenaMart</h2>
                        <p class="text-neutral-600 text-sm md:text-base mt-3">Join the waiting list to get early
                            access, updates, and launch perks.</p>

                        <div class="mt-6 md:mt-8">
                            <a onclick="document.getElementById('nameInput').focus()"
                                class="relative cursor-pointer w-fit px-6 py-3 rounded-full font-semibold text-white bg-[#10b982] mx-auto inline-flex items-center gap-2 overflow-hidden transition-all duration-200 hover:bg-[#0fa972] hover:shadow-md hover:-translate-y-0.5">
                                <!-- White dotted pattern -->
                                <span
                                    class="absolute inset-0 bg-[radial-gradient(white_1px,transparent_1px)] [background-size:10px_10px] opacity-20"></span>

                                <!-- Button content (above dots) -->
                                <span class="relative">Join the waiting list</span>
                                <i class="ri-arrow-right-line relative"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="w-full bg-white">
            <div class="w-full relative max-w-[1600px] mx-auto">
                <div
                    class=" w-full mx-auto px-6 md:px-12 lg:px-16 xl:px-36 py-16 md:py-32 items-center flex justify-center">
                    <div class="flex flex-col max-w-[1200px]  items-center justify-center w-full gap-8">
                        <div
                            class="flex flex-col  md:flex-row items-center justify-center w-full gap-20 md:gap-8 md:justify-between md:items-stretch">
                            <div class="flex flex-col gap-8 items-center justify-center md:hidden ">
                                <a href="/" class="flex-shrink-0 group">
                                    <img class="h-8 w-auto transform transition-transform group-hover:scale-105"
                                        src="{{ asset('logo/logo-teal.svg') }}" alt="Logo">
                                </a>
                                <div class="flex gap-2 text-neutral-700">
                                    <a target="_blank" href="https://www.linkedin.com/company/tenamart">
                                        <i class="ri-linkedin-box-fill text-2xl"></i>
                                    </a>
                                    <a target="_blank" href="https://www.instagram.com/tenamart.et">
                                        <i class="ri-instagram-line text-2xl"></i>
                                    </a>
                                    <a target="_blank" href="https://www.t.me/tenamartet">
                                        <i class="ri-telegram-line text-2xl"></i>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="flex flex-col gap-8 items-center justify-center underline md:items-start md:flex-1">
                                <a class="active:text-neutral-700" href="#how-it-works">How it works</a>
                                <a class="active:text-neutral-700" href="#why-us">Why us</a>
                                <a class="active:text-neutral-700 col-span-2" href="#faq">FAQ</a>
                            </div>
                            <div class=" flex-col gap-8 items-center justify-between hidden md:flex md:flex-shrink-0">
                                <a href="/" class="flex-shrink-0 group">
                                    <img class="h-10 md:h-12 w-auto transform transition-transform group-hover:scale-105"
                                        src="{{ asset('logo/logo-teal.svg') }}" alt="Logo">
                                </a>
                                <div class="flex gap-2 text-neutral-700">
                                    <a target="_blank" href="https://www.linkedin.com/company/tenamart">
                                        <i class="ri-linkedin-box-fill text-2xl"></i>
                                    </a>
                                    <a target="_blank" href="https://www.instagram.com/tenamart.et">
                                        <i class="ri-instagram-line text-2xl"></i>
                                    </a>
                                    <a target="_blank" href="https://www.t.me/tenamartet">
                                        <i class="ri-telegram-line text-2xl"></i>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="flex flex-col gap-8 items-center justify-center underline md:items-end md:flex-1">
                                <a class="active:text-neutral-700" href="/terms">Terms of Service</a>
                                <a class="active:text-neutral-700" href="/data-processing">Data Processing
                                    Agreement</a>
                                <a class="active:text-neutral-700" href="/privacy-policy">Privacy Policy</a>
                            </div>
                        </div>
                        <span
                            class="text-neutral-600 text-base font-normal tracking-[normal] leading-[24px] text-center">©
                            2025 TenaMart, All rights reserved.</span>
                    </div>
                </div>
            </div>
        </footer>
    </body>

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
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

        // FAQ accordion (single open)
        (function() {
            const items = document.querySelectorAll('#faq .faq-item');
            let openItem = null;

            items.forEach((item) => {
                const toggle = item.querySelector('.faq-toggle');
                const answer = item.querySelector('.faq-answer');
                const icon = toggle.querySelector('i');

                toggle.addEventListener('click', () => {
                    const isOpen = !answer.classList.contains('hidden');

                    // Close currently open item if different
                    if (openItem && openItem !== item) {
                        const openAnswer = openItem.querySelector('.faq-answer');
                        const openToggle = openItem.querySelector('.faq-toggle');
                        const openIcon = openToggle.querySelector('i');
                        openAnswer.classList.add('hidden');
                        openToggle.setAttribute('aria-expanded', 'false');
                        openIcon.classList.remove('ri-subtract-line');
                        openIcon.classList.add('ri-add-line');
                        openItem = null;
                    }

                    // Toggle current item
                    if (isOpen) {
                        answer.classList.add('hidden');
                        toggle.setAttribute('aria-expanded', 'false');
                        icon.classList.remove('ri-subtract-line');
                        icon.classList.add('ri-add-line');
                        openItem = null;
                    } else {
                        answer.classList.remove('hidden');
                        toggle.setAttribute('aria-expanded', 'true');
                        icon.classList.remove('ri-add-line');
                        icon.classList.add('ri-subtract-line');
                        openItem = item;
                    }
                });
            });
        })();
    </script>
</x-layout>
