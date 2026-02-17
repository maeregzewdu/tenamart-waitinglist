<x-layout>
    <body class="bg-neutral-50">
        <!-- Minimal Nav -->
        <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-neutral-200">
            <div class="px-6 py-4 flex justify-between items-center">
                <a href="/" class="group">
                    <img class="h-6 w-auto"
                        src="{{ asset('logo/logo-teal.svg') }}" alt="Logo">
                </a>
                <a href="/" class="text-xs font-medium text-neutral-500">
                    <i class="ri-home-4-line mr-1"></i> Back Home
                </a>
            </div>
        </nav>

        <!-- Brochure Content -->
        <main class="max-w-md mx-auto px-4 pt-6 pb-32">
            <div class="space-y-6">
                <div class="space-y-2 text-center mb-8">
                    <h1 class="text-xl font-bold text-neutral-900">TenaBrochure</h1>
                    <p class="text-sm text-neutral-600">The future of pharmacies in Ethiopia</p>
                </div>

                <!-- Page 1 -->
                <div class="relative group">
                    <img src="/tenamart_brochure_1.webp"
                         alt="Brochure Page 1"
                         class="w-full h-auto rounded-xl shadow-md border border-neutral-200">
                    <div class="mt-3 flex justify-end">
                        <button onclick="downloadBrochure('tenamart_brochure_1.png')"
                                class="text-xs flex w-full justify-center items-center gap-1.5 bg-[#19b380] border border-neutral-200 text-white px-3 py-2 rounded-lg">
                            <i class="ri-download-line font-normal"></i>
                            Save Image
                        </button>
                    </div>
                </div>

                <!-- Page 2 -->
                <div class="relative group">
                    <img src="/tenamart_brochure_2.webp"
                         alt="Brochure Page 2"
                         class="w-full h-auto rounded-xl shadow-md border border-neutral-200">
                    <div class="mt-3 flex justify-end">
                        <button onclick="downloadBrochure('tenamart_brochure_2.png')"
                                class="text-xs flex w-full justify-center items-center gap-1.5 bg-[#19b380] border border-neutral-200 text-white px-3 py-2 rounded-lg">
                            <i class="ri-download-line font-normal"></i>
                            Save Image
                        </button>
                    </div>
                </div>
            </div>
        </main>

        <script>
            function downloadBrochure(file) {
                const btn = event.currentTarget;
                const originalText = btn.innerHTML;

                // Visual feedback
                btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i>';
                btn.disabled = true;

                // Create a hidden link and click it to trigger the Laravel download response
                const link = document.createElement('a');
                link.href = `/brochure/download/${file}`;
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                setTimeout(() => {
                    btn.innerHTML = '<i class="ri-checkbox-line"></i> Saved';
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }, 2000);
                }, 1000);
            }
        </script>
    </body>
</x-layout>
