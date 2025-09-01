<x-layout>
    <body class="min-h-screen font-['Raleway'] flex flex-col items-center justify-center px-4 py-6 md:py-8 relative overflow-hidden">
        <div class="relative z-10 w-full max-w-md">
            <div class="text-center mb-8">
                <img src="{{ asset('logo/logo-teal.svg') }}" alt="TenaMart" class="w-40 md:w-64 mx-auto mb-6 md:mb-8">
                
            </div>

            <div class="backdrop-blur-xl bg-white/80 rounded-3xl p-8 border border-teal-200 shadow-2xl">
                <h2 class="text-2xl font-semibold text-[#10b982] text-center mb-6">Sign In</h2>
                
                <form action="{{ route('login') }}" method="post" class="space-y-6">
                    @csrf
                    
                    <!-- Email field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ri-mail-line text-[#10b982]"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="Enter your email"
                            class="w-full pl-12 pr-4 py-4 bg-white/50 border border-teal-200 rounded-xl text-[#10b982] placeholder-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                            required
                        >
                        
                    </div>

                    <!-- Password field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ri-lock-line text-[#10b982]"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Enter your password"
                            class="w-full pl-12 pr-4 py-4 bg-white/50 border border-teal-200 rounded-xl text-[#10b982] placeholder-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    
                    <!-- Submit button -->
                    <button 
                        type="submit"
                        class="w-full py-4 bg-[#10b982] cursor-pointer text-white font-semibold rounded-xl hover:from-[#10b982] hover:to-[#10b982] focus:outline-none focus:ring-2 focus:ring-[#10b982] focus:ring-offset-2 focus:ring-offset-white transition-all duration-300 transform hover:scale-105 shadow-lg"
                    >
                        <span class="flex items-center justify-center">
                            <i class="ri-login-box-line mr-2"></i>
                            Sign In
                        </span>
                    </button>
                </form>

                <!-- Additional links -->
                <div class="mt-6 text-center">
                    <a href="/" class="text-teal-600 hover:text-teal-800 text-sm transition-colors duration-300">
                        ← Back to Home
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-teal-600 text-xs">
                    © 2025 TenaMart. The future of healthcare in Ethiopia.
                </p>
            </div>
        </div>
    </body>
</x-layout>