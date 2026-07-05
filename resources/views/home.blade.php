<x-layouts.landing>
    <!-- Navbar -->
    <header class="sticky top-0 z-50 w-full border-b border-slate-200/80 bg-slate-50/80 backdrop-blur-md dark:border-slate-800/80 dark:bg-slate-950/80 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="rounded-xl bg-blue-600 p-2 text-white shadow-lg shadow-blue-500/30">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2".
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-white dark:to-slate-300">BillPro</span>
                    </a>
                </div>

                <!-- Desktop Nav Navigation -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors">How It Works</a>
                    <a href="#benefits" class="text-sm font-medium text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors">Why Choose Us</a>
                    <a href="#faqs" class="text-sm font-medium text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors">FAQs</a>
                </nav>

                <!-- Action CTAs / Theme Switcher -->
                <div class="flex items-center gap-4">
                    <!-- Light / Dark Mode Toggle Button -->
                    <button id="theme-toggle" type="button" class="text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-slate-200 dark:text-slate-400 dark:hover:bg-slate-900 dark:focus:ring-slate-800 rounded-lg text-sm p-2.5 transition-colors">
                        <!-- Sun Icon (shows when dark mode is enabled) -->
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 14.142l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zm2.12-10.607a1 1 0 010-1.414l.706-.707a1 1 0 111.414 1.414l-.707.707a1 1 0 01-1.414 0zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                        <!-- Moon Icon (shows when light mode is enabled) -->
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>

                    <!-- Authentication Buttons -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-700 hover:shadow-blue-500/30 transition-all duration-300">
                            Go to Dashboard
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 dark:text-slate-300 dark:hover:text-blue-400 transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-700 hover:shadow-blue-500/30 transition-all duration-300">
                            Get Started
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex items-center p-2 text-sm text-slate-500 rounded-lg md:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:text-slate-400 dark:hover:bg-slate-900 dark:focus:ring-slate-800">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div class="hidden md:hidden pb-4" id="mobile-menu">
                <ul class="flex flex-col gap-2 mt-2 font-medium">
                    <li>
                        <a href="#features" class="block py-2 px-3 text-slate-700 rounded hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Features</a>
                    </li>
                    <li>
                        <a href="#how-it-works" class="block py-2 px-3 text-slate-700 rounded hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">How It Works</a>
                    </li>
                    <li>
                        <a href="#benefits" class="block py-2 px-3 text-slate-700 rounded hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Why Choose Us</a>
                    </li>
                    <li>
                        <a href="#faqs" class="block py-2 px-3 text-slate-700 rounded hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">FAQs</a>
                    </li>
                    @auth
                        <li class="mt-2 pt-2 border-t border-slate-200 dark:border-slate-800">
                            <a href="{{ route('dashboard') }}" class="block py-2.5 px-3 text-center text-white bg-blue-600 rounded-xl font-semibold shadow-md">Dashboard</a>
                        </li>
                    @else
                        <li class="mt-2 pt-2 border-t border-slate-200 dark:border-slate-800 flex flex-col gap-2">
                            <a href="{{ route('login') }}" class="block py-2 text-center text-slate-700 dark:text-slate-300 font-semibold rounded hover:bg-slate-100 dark:hover:bg-slate-800">Sign In</a>
                            <a href="{{ route('register') }}" class="block py-2.5 text-center text-white bg-blue-600 rounded-xl font-semibold shadow-md">Get Started</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden py-20 lg:py-32 bg-slate-50 dark:bg-slate-950 transition-colors duration-300">
        <!-- Background Grid and Blobs -->
        <div class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:24px_24px] dark:bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)]"></div>
        <div class="absolute top-1/4 left-1/2 -z-10 h-[400px] w-[600px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-400/10 blur-[100px] dark:bg-blue-600/5"></div>
        <div class="absolute bottom-10 left-10 -z-10 h-[250px] w-[250px] rounded-full bg-indigo-500/10 blur-[80px] dark:bg-indigo-600/5"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12 lg:items-center">
                <!-- Hero Text -->
                <div class="lg:col-span-7 text-left space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50/50 px-4 py-1.5 text-sm font-semibold text-blue-700 dark:border-blue-900/30 dark:bg-blue-950/30 dark:text-blue-400">
                        <span class="flex h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                        100% Free & Private Invoicing
                    </div>

                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-6xl dark:text-white leading-[1.1]">
                        Manage, Invoice, and Share <br />
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-500 bg-clip-text text-transparent dark:from-blue-400 dark:to-indigo-300">Without Subscriptions</span>
                    </h1>

                    <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl leading-relaxed">
                        BillPro is a sleek, easy-to-use billing system designed for business owners, shopkeepers, and freelancers. Effortlessly manage your items and prices, create custom invoice numbers, print bills in local languages (like Gujarati and Hindi), and share professional invoices instantly on WhatsApp.
                    </p>

                    <div class="flex flex-wrap gap-4 pt-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-700 hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                                Go to Dashboard
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-700 hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                                Get Started Free
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                            <a href="#features" class="inline-flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white px-6 py-3.5 text-base font-semibold text-slate-700 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800/80 transition-all duration-300 transform hover:-translate-y-0.5">
                                Explore Features
                            </a>
                        @endauth
                    </div>

                    <!-- Trust indicators -->
                    <div class="flex items-center gap-6 pt-4 border-t border-slate-200/50 dark:border-slate-800/50">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">100% Private Data</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Super Fast & Reliable</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Completely Free</span>
                        </div>
                    </div>
                </div>

                <!-- CSS-Only Interactive Mockup (Dashboard & Invoice Preview) -->
                <div class="lg:col-span-5 relative flex justify-center items-center">
                    <div class="relative w-full max-w-md">
                        <!-- Invoice Card Mockup (Float Left) -->
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl p-6 relative z-20 transform hover:-rotate-2 transition-transform duration-500 select-none">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h4 class="text-lg font-bold text-slate-900 dark:text-white">Tax Invoice</h4>
                                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 dark:bg-blue-950/50 dark:text-blue-400 px-2 py-0.5 rounded-full">INV-2026-0042</span>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs font-bold text-slate-400 dark:text-slate-500">BillPro Corp</div>
                                    <div class="text-[10px] text-slate-500">support@billpro.com</div>
                                </div>
                            </div>

                            <!-- Bill details -->
                            <div class="grid grid-cols-2 gap-4 pb-4 border-b border-slate-100 dark:border-slate-800 mb-4">
                                <div>
                                    <span class="block text-[10px] uppercase font-bold text-slate-400">Billed To</span>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Acme Industries</span>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10px] uppercase font-bold text-slate-400">Invoice Date</span>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">July 04, 2026</span>
                                </div>
                            </div>

                            <!-- Invoice Items -->
                            <div class="space-y-2.5 mb-6">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-slate-600 dark:text-slate-400 font-medium">Enterprise Development Setup</span>
                                    <span class="font-bold text-slate-900 dark:text-white">₹18,500.00</span>
                                </div>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-slate-600 dark:text-slate-400 font-medium">Cloud Hosting Setup & Config (10 Pcs)</span>
                                    <span class="font-bold text-slate-900 dark:text-white">₹3,200.00</span>
                                </div>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-slate-600 dark:text-slate-400 font-medium">Premium PDF Script Support</span>
                                    <span class="font-bold text-slate-900 dark:text-white">₹1,500.00</span>
                                </div>
                            </div>

                            <!-- Totals -->
                            <div class="bg-slate-50 dark:bg-slate-950 p-3.5 rounded-xl border border-slate-100 dark:border-slate-800/50 flex justify-between items-center">
                                <span class="text-xs font-bold text-slate-500 uppercase">Total Amount</span>
                                <span class="text-lg font-extrabold text-blue-600 dark:text-blue-400">₹23,200.00</span>
                            </div>

                            <div class="mt-4 flex justify-between items-center text-[10px] text-slate-400 dark:text-slate-500">
                                <span>Professional PDF Format</span>
                                <span class="flex items-center gap-1 text-green-500 font-semibold">
                                    <span class="h-1.5 w-1.5 bg-green-500 rounded-full"></span> Secure PDF
                                </span>
                            </div>
                        </div>

                        <!-- Mini Dashboard Graph/Stats Mockup (Float Behind/Right) -->
                        <div class="absolute -right-8 -bottom-8 bg-slate-900 dark:bg-slate-800 text-white rounded-2xl p-4 shadow-xl border border-slate-800/80 w-52 z-10 transform rotate-6 hover:rotate-0 transition-transform duration-500 select-none hidden sm:block">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="p-1 bg-green-500/20 text-green-400 rounded-md">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Monthly Sales</span>
                            </div>
                            <div class="text-lg font-black tracking-tight mb-2">₹1,84,500</div>
                            <!-- Mini Sparkline Graph -->
                            <div class="flex items-end gap-1 h-10 pt-2">
                                <div class="bg-blue-600 h-2 w-full rounded-sm"></div>
                                <div class="bg-indigo-600 h-4 w-full rounded-sm"></div>
                                <div class="bg-blue-600 h-3 w-full rounded-sm"></div>
                                <div class="bg-indigo-500 h-6 w-full rounded-sm"></div>
                                <div class="bg-blue-500 h-8 w-full rounded-sm"></div>
                                <div class="bg-emerald-500 h-10 w-full rounded-sm"></div>
                            </div>
                        </div>

                        <!-- Decorative glow -->
                        <div class="absolute -top-10 -left-10 h-32 w-32 rounded-full bg-blue-500/20 blur-2xl -z-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Metrics Highlight Section -->
    <section class="bg-white py-12 dark:bg-slate-900 border-y border-slate-200/60 dark:border-slate-800/60 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 text-center">
                <div class="space-y-2">
                    <div class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">100%</div>
                    <div class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Safe & Private</div>
                    <p class="text-xs text-slate-400 max-w-xs mx-auto">Your business data is stored securely. No one else has access to your invoices or customer lists.</p>
                </div>
                <div class="space-y-2 border-slate-200 dark:border-slate-800 sm:border-x">
                    <div class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">₹0 / $0</div>
                    <div class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">No Monthly Fees</div>
                    <p class="text-xs text-slate-400 max-w-xs mx-auto">Enjoy all invoicing and customer management tools completely free. No credit card required.</p>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">Instant</div>
                    <div class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">PDF Generation</div>
                    <p class="text-xs text-slate-400 max-w-xs mx-auto">Generate clear, professional PDF bills with a single click. Download and share instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-slate-50 dark:bg-slate-950 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="mx-auto max-w-3xl text-center space-y-4 mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-blue-600 dark:text-blue-400">Robust Features</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Everything you need to invoice clients
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-lg">
                    Discover the power of customized billing tools tailored to streamline invoices, inventory, and communications.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Card 1 -->
                <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-8 hover:shadow-xl hover:border-blue-500/30 dark:hover:border-blue-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 rounded-xl text-blue-600 dark:text-blue-400 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Sales Dashboard</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Track your total earnings, invoice counts, and top-selling products in real time from a simple sales overview.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-8 hover:shadow-xl hover:border-blue-500/30 dark:hover:border-blue-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 rounded-xl text-blue-600 dark:text-blue-400 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Item & Price List</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Save your product details and rates with custom units (like kg, Pcs, or meter) to add them to your bills instantly without retyping.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-8 hover:shadow-xl hover:border-blue-500/30 dark:hover:border-blue-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 rounded-xl text-blue-600 dark:text-blue-400 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Custom Bill Numbers</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Choose how your bills are numbered. Easily customize your billing prefixes and serial numbers to match your business requirements.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-8 hover:shadow-xl hover:border-blue-500/30 dark:hover:border-blue-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 rounded-xl text-blue-600 dark:text-blue-400 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5c-.313 1.565-.927 3.054-1.814 4.385m1.814-4.385a19.07 19.07 0 013.268 4.385m-3.268-4.385V3m-2.4 13.5H3.6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Local Language Support</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Create invoices in your local language (such as Gujarati, Hindi, and others) by uploading your business's preferred local language font.
                    </p>
                </div>

                <!-- Card 5 -->
                <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-8 hover:shadow-xl hover:border-blue-500/30 dark:hover:border-blue-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 rounded-xl text-blue-600 dark:text-blue-400 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.742L19.885 5.142A.5.5 0 0120.6 5.6v12.8a.5.5 0 01-.715.458L8.684 13.258a1 1 0 010-1.776z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 13h.01M6 17h.01M6 9h.01M3 9a2 2 0 012-2h1a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Easy WhatsApp Sharing</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Share direct links with customers via WhatsApp, allowing them to view invoices on mobile devices and download PDF receipts instantly.
                    </p>
                </div>

                <!-- Card 6 -->
                <div class="group bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-8 hover:shadow-xl hover:border-blue-500/30 dark:hover:border-blue-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 rounded-xl text-blue-600 dark:text-blue-400 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Quick Google Login</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Sign up or log in instantly using your Google account in one tap, with no complex passwords to set up or remember.
                    </p>
                </div>
            </div>
        </div>
        <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-white dark:bg-slate-900 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center space-y-4 mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-blue-600 dark:text-blue-400">Process Flow</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Get started in 4 simple steps
                </h2>
            </div>

            <!-- Steps Container -->
            <div class="relative">
                <!-- Vertical timeline line on desktop -->
                <div class="absolute left-1/2 top-0 bottom-0 w-0.5 bg-slate-100 dark:bg-slate-800 -translate-x-1/2 hidden lg:block"></div>

                <div class="space-y-12 lg:space-y-20">
                    <!-- Step 1 -->
                    <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
                        <div class="lg:w-1/2 lg:text-right order-2 lg:order-1">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">1. Enter Business Details</h3>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed max-w-md lg:ml-auto">
                                Register your account, add your business name, corporate logo, contact details, and bank details for invoice printouts.
                            </p>
                        </div>
                        <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white font-bold ring-8 ring-blue-50 dark:ring-blue-950/50 order-1 lg:order-2">
                            1
                        </div>
                        <div class="lg:w-1/2 order-3">
                            <!-- Visual box -->
                            <div class="bg-slate-50 dark:bg-slate-950 border border-slate-200/60 dark:border-slate-800/60 rounded-xl p-5 w-fit">
                                <span class="text-xs font-bold text-blue-600 dark:text-blue-400">Settings Form</span>
                                <div class="mt-2 text-xs font-semibold text-slate-500">Business Name: <span class="text-slate-700 dark:text-slate-300">My Agency LLC</span></div>
                                <div class="mt-1 text-xs font-semibold text-slate-500">Currency: <span class="text-slate-700 dark:text-slate-300">INR (₹)</span></div>
                                <div class="mt-1 text-xs font-semibold text-slate-500">Local Language: <span class="text-green-500">Gujarati</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
                        <div class="lg:w-1/2 order-3 lg:order-1 lg:text-right">
                            <!-- Visual box -->
                            <div class="bg-slate-50 dark:bg-slate-950 border border-slate-200/60 dark:border-slate-800/60 rounded-xl p-5 w-fit lg:ml-auto">
                                <span class="text-xs font-bold text-blue-600 dark:text-blue-400">Product Entry</span>
                                <div class="mt-2 text-xs font-semibold text-slate-700 dark:text-slate-300">Web Design Package</div>
                                <div class="text-[10px] text-slate-400">Rate: ₹25,000 / Pcs</div>
                            </div>
                        </div>
                        <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white font-bold ring-8 ring-blue-50 dark:ring-blue-950/50 order-1">
                            2
                        </div>
                        <div class="lg:w-1/2 order-2">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">2. Add Your Items</h3>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed max-w-md">
                                Create a reusable list of your products or services with their rates. This saves time and avoids mistakes when making new bills.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
                        <div class="lg:w-1/2 lg:text-right order-2 lg:order-1">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">3. Create Invoice</h3>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed max-w-md lg:ml-auto">
                                Create bills easily using our simple form, select clients, automatically calculate taxes/totals, and set custom bill numbers.
                            </p>
                        </div>
                        <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white font-bold ring-8 ring-blue-50 dark:ring-blue-950/50 order-1 lg:order-2">
                            3
                        </div>
                        <div class="lg:w-1/2 order-3">
                            <!-- Visual box -->
                            <div class="bg-slate-50 dark:bg-slate-950 border border-slate-200/60 dark:border-slate-800/60 rounded-xl p-5 w-fit">
                                <span class="text-xs font-bold text-blue-600 dark:text-blue-400">Bill Live Preview</span>
                                <div class="mt-2 h-1.5 w-24 bg-slate-300 dark:bg-slate-700 rounded"></div>
                                <div class="mt-1.5 h-1.5 w-16 bg-slate-300 dark:bg-slate-700 rounded"></div>
                                <div class="mt-3 flex gap-2">
                                     <div class="h-4 w-12 bg-blue-500/20 rounded"></div>
                                     <div class="h-4 w-8 bg-green-500/20 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
                        <div class="lg:w-1/2 order-3 lg:order-1 lg:text-right">
                            <!-- Visual box -->
                            <div class="bg-slate-50 dark:bg-slate-950 border border-slate-200/60 dark:border-slate-800/60 rounded-xl p-5 w-fit lg:ml-auto">
                                <span class="text-xs font-bold text-green-600">WhatsApp Link Generated</span>
                                <div class="mt-2 text-xs text-blue-500 underline truncate max-w-xs">/invoice/preview...</div>
                            </div>
                        </div>
                        <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white font-bold ring-8 ring-blue-50 dark:ring-blue-950/50 order-1">
                            4
                        </div>
                        <div class="lg:w-1/2 order-2">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">4. Share with Clients</h3>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed max-w-md">
                                Send the secure bill link directly to your customer. They can open it on their mobile phone and download the PDF easily without logging in.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits / Why Choose Us Section -->
    <section id="benefits" class="py-20 bg-slate-50 dark:bg-slate-950 transition-colors duration-300">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-4 mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-blue-600 dark:text-blue-400">Why Choose Us</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                    Invoicing Made Simple for Everyone
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-lg max-w-2xl mx-auto">
                    No complex setups, no jargon, and no monthly fees. Just a clean tool to help you run your business smoothly.
                </p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Benefit 1 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-950/50 text-green-600 dark:text-green-400 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-2">100% Private & Safe</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Your bills, products, and customer details belong to you alone. We do not store or sell your data.
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-2">Lightning Fast</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Create and download bills in seconds. The simple interface works perfectly on mobile phones, tablets, and computers.
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-2">No Subscriptions</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Use every single feature with zero monthly charges. No hidden costs, limit upgrades, or locked features.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    <section id="faqs" class="py-20 bg-white dark:bg-slate-900 transition-colors duration-300">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="text-center space-y-4 mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-blue-600 dark:text-blue-400">Questions & Answers</span>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                    Frequently Asked Questions
                </h2>
            </div>

            <div class="grid gap-8 sm:grid-cols-2">
                <div class="space-y-2">
                    <h3 class="font-bold text-slate-900 dark:text-white">Is this platform completely free?</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Yes! BillPro is completely free to use. There are no hidden monthly charges, card limits, or upgrade screens. Use every invoicing feature free forever.
                    </p>
                </div>
                <div class="space-y-2">
                    <h3 class="font-bold text-slate-900 dark:text-white">Does it support regional scripts?</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Yes. You can upload your preferred local font (like Gujarati or Hindi) directly in the Settings, and the system will automatically print your invoices in that language.
                    </p>
                </div>
                <div class="space-y-2">
                    <h3 class="font-bold text-slate-900 dark:text-white">Can clients view bills without logging in?</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Absolutely. When you share a bill link, your client can open it on their mobile phone or computer to view and download the PDF immediately, without needing to sign up.
                    </p>
                </div>
                <div class="space-y-2">
                    <h3 class="font-bold text-slate-900 dark:text-white">Do I need special training to use it?</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Not at all. BillPro is designed to be extremely simple and straightforward. If you know how to fill out a basic form, you can start billing in less than two minutes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Section -->
    <section class="relative py-20 bg-slate-950 overflow-hidden text-center text-white">
        <!-- Radial gradient background -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(37,99,235,0.15)_0,transparent_100%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff02_1px,transparent_1px),linear-gradient(to_bottom,#ffffff02_1px,transparent_1px)] bg-[size:32px_32px]"></div>

        <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6">
            <h2 class="text-4xl font-extrabold tracking-tight sm:text-5xl mb-6">
                Take control of your billing today.
            </h2>
            <p class="text-lg text-slate-400 max-w-xl mx-auto mb-10 leading-relaxed">
                Start generating invoice PDFs, managing products, and sharing secure client links with no subscription fees.
            </p>

            <div class="flex flex-wrap justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-blue-500/25 hover:bg-blue-700 hover:shadow-blue-500/35 transition-all duration-300 transform hover:-translate-y-0.5">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3.5 text-base font-semibold text-white shadow-lg shadow-blue-500/25 hover:bg-blue-700 hover:shadow-blue-500/35 transition-all duration-300 transform hover:-translate-y-0.5">
                        Create Account
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-800 bg-slate-900 px-6 py-3.5 text-base font-semibold text-slate-300 hover:bg-slate-800 transition-all duration-300 transform hover:-translate-y-0.5">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-100 py-12 dark:bg-slate-950 border-t border-slate-200 dark:border-slate-900 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                <!-- Branding logo -->
                <div class="flex items-center gap-2">
                    <div class="rounded-lg bg-blue-600 p-1.5 text-white">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">BillPro</span>
                </div>

                <!-- Copyright -->
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    &copy; 2026 BillPro. Completely free to use.
                </p>

                <!-- Footer links -->
                <div class="flex gap-4 text-xs text-slate-500 dark:text-slate-400">
                    <a href="#features" class="hover:underline hover:text-blue-500">Features</a>
                    <a href="#how-it-works" class="hover:underline hover:text-blue-500">Process</a>
                    <a href="#benefits" class="hover:underline hover:text-blue-500">Why Us</a>
                </div>
            </div>
        </div>
    </footer>
</x-layouts.landing>
