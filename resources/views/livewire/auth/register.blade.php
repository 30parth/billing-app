<div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row dark:bg-gray-800">
    <!-- Left Section: Branding & Visuals -->
    <div
        class="md:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-800 p-10 text-white flex flex-col justify-between relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-blue-300 opacity-20 blur-xl"></div>
        <div class="absolute bottom-1/4 right-10 w-24 h-24 rounded-full bg-indigo-300 opacity-20 blur-md"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-wider uppercase">BillPro</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-8">
                Join BillPro<br />Today.
            </h1>
            <p class="text-blue-100 text-lg md:text-xl max-w-sm leading-relaxed">
                Start your journey with the most powerful billing application. Designed for your success.
            </p>
        </div>

    </div>

    <!-- Right Section: Register Form -->
    <div class="md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white dark:bg-gray-800">
        <div class="w-full max-w-md mx-auto">
            <div class="text-left mb-6">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Create an Account</h2>
                <p class="text-gray-500 dark:text-gray-400">Please enter your details to register.</p>
            </div>

            @error('register')
                <div class="p-4 mb-6 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800/30 flex items-center gap-3 animate-pulse"
                    role="alert">
                    <svg class="shrink-0 w-5 h-5 text-red-600 dark:text-red-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                    </svg>
                    <div>
                        <span class="font-bold text-red-600 dark:text-red-400">Error:</span> <span
                            class="text-red-700 dark:text-red-300">{{ $message }}</span>
                    </div>
                </div>
            @enderror

            <form class="space-y-4" wire:submit="register">
                <div>
                    <x-ui.form.input-with-label type="text" label="Full Name" name="name" id="name"
                        placeholder="John Doe" />
                </div>

                <div>
                    <x-ui.form.input-with-label type="email" label="Email Address" name="email" id="email"
                        placeholder="name@company.com" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-ui.form.input-with-label type="password" label="Password" name="password" id="password"
                            placeholder="••••••••" />
                    </div>
                    <div>
                        <x-ui.form.input-with-label type="password" label="Confirm Password"
                            name="password_confirmation" id="password_confirmation" placeholder="••••••••" />
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-xl text-sm px-5 py-3 mt-2 text-center transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex justify-center items-center gap-2">
                    Create Account
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>

                <div class="relative flex items-center justify-center w-full py-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-b border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center w-full text-sm">
                        <span class="px-4 text-gray-500 bg-white dark:bg-gray-800 dark:text-gray-400">Or sign up
                            with</span>
                    </div>
                </div>

                <a href="{{ route('google.login') }}" wire:navigate
                    class="flex items-center justify-center w-full text-gray-700 bg-white border-2 border-gray-200 hover:bg-gray-50 hover:border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-xl text-sm px-5 py-3 text-center transition-all duration-300 ease-in-out hover:shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800 group">
                    <div class="bg-white p-1 rounded-full mr-2 group-hover:scale-110 transition-transform duration-300">
                        <x-ui.icon.google class="w-5 h-5" />
                    </div>
                    Sign up with Google
                </a>
            </form>

            <p class="mt-8 text-sm text-center text-gray-600 dark:text-gray-400">
                Already have an account? <a href="/login"
                    class="font-semibold text-blue-600 hover:text-blue-700 hover:underline dark:text-blue-400 transition-colors">Sign
                    in here</a>
            </p>
        </div>
    </div>
</div>
