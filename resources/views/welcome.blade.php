<x-layout>
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

            <form action="/waiting-list" method="post" id="waitlistForm" class="max-w-md mx-auto space-y-3 md:space-y-4 px-2 md:px-4">
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
</x-layout>