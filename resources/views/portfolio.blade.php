<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $profile?->bio ?? 'Personal Developer Portfolio' }}">

    <title>{{ $profile?->name ?? 'Portfolio' }} - Developer Portfolio</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-lg shadow-sm border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="text-xl font-bold gradient-text">
                    {{ $profile?->name ?? 'Portfolio' }}
                </a>

                <!-- Mobile menu button -->
                <button type="button" id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#about" class="text-slate-600 hover:text-slate-900 transition font-medium text-sm">About</a>
                    <a href="#skills" class="text-slate-600 hover:text-slate-900 transition font-medium text-sm">Skills</a>
                    <a href="#projects" class="text-slate-600 hover:text-slate-900 transition font-medium text-sm">Projects</a>
                    <a href="#experience" class="text-slate-600 hover:text-slate-900 transition font-medium text-sm">Experience</a>
                    <a href="#contact" class="px-4 py-2 bg-indigo-600 text-black rounded-full text-sm font-medium hover:bg-indigo-700 hover:shadow-lg transition">
                        Contact
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            <i class="fas fa-cog mr-1"></i> Admin
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="#about" class="text-slate-600 hover:text-slate-900 py-2">About</a>
                    <a href="#skills" class="text-slate-600 hover:text-slate-900 py-2">Skills</a>
                    <a href="#projects" class="text-slate-600 hover:text-slate-900 py-2">Projects</a>
                    <a href="#experience" class="text-slate-600 hover:text-slate-900 py-2">Experience</a>
                    <a href="#contact" class="text-slate-600 hover:text-slate-900 py-2">Contact</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 py-2">Admin Panel</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="about" class="relative min-h-screen flex items-center pt-16 overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 blob"></div>
            <div class="absolute top-40 -left-40 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 blob" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 right-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 blob" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left order-2 lg:order-1">
                    <div class="inline-flex items-center px-4 py-2 bg-indigo-50 rounded-full text-indigo-700 text-sm font-medium mb-6">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Available for opportunities
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 mb-6 leading-tight">
                        Hi, I'm <span class="gradient-text">{{ $profile?->name ?? 'Developer' }}</span>
                    </h1>

                    @if($profile?->major)
                        <p class="text-xl sm:text-2xl text-indigo-600 font-semibold mb-6">{{ $profile->major }}</p>
                    @endif

                    @if($profile?->bio)
                        <p class="text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 mb-8 leading-relaxed">{{ $profile->bio }}</p>
                    @endif

                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="#contact" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-black rounded-full font-semibold hover:shadow-xl hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            <span>Get in Touch</span>
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="#projects" class="inline-flex items-center px-8 py-4 border-2 border-slate-200 text-slate-700 rounded-full font-semibold hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300">
                            View Projects
                        </a>
                    </div>

                    <!-- Social Links from Contacts -->
                    @if($contacts->count() > 0)
                        <div class="mt-10 flex items-center gap-4 justify-center lg:justify-start">
                            <span class="text-sm text-slate-500">Find me on:</span>
                            <div class="flex gap-3">
                                @foreach($contacts as $contact)
                                    <a href="{{ $contact->link }}" target="_blank" rel="noopener noreferrer"
                                       class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 text-slate-600 hover:bg-indigo-600 hover:text-black transition-all duration-300"
                                       title="{{ $contact->title }}">
                                        @if($contact->icon)
                                            <i class="{{ $contact->icon }}"></i>
                                        @else
                                            <i class="fas fa-link"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Profile Image -->
                <div class="flex justify-center order-1 lg:order-2">
                    <div class="relative">
                        <!-- Decorative rings -->
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full blur-2xl opacity-20 scale-110"></div>
                        <div class="relative floating">
                            @if($profile?->image)
                                <img src="{{ Storage::url($profile->image) }}"
                                     alt="{{ $profile->name }}"
                                     class="w-64 h-64 sm:w-80 sm:h-80 rounded-full object-cover shadow-2xl ring-8 ring-white">
                            @else
                                <div class="w-64 h-64 sm:w-80 sm:h-80 rounded-full hero-gradient flex items-center justify-center shadow-2xl ring-8 ring-white">
                                    <span class="text-7xl sm:text-8xl font-bold text-black">
                                        {{ substr($profile?->name ?? 'P', 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <!-- Skills Section -->
    @if($skills->count() > 0)
    <section id="skills" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">What I Know</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mt-2">Skills & Technologies</h2>
                <div class="mt-4 w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($skills as $skill)
                    <div class="skill-card rounded-2xl p-6 text-center card-hover border border-slate-100 shadow-sm">
                        <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <span class="text-2xl font-bold text-black">{{ substr($skill->name, 0, 1) }}</span>
                        </div>
                        <h3 class="font-semibold text-slate-800 mb-2">{{ $skill->name }}</h3>
                        @if($skill->level)
                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full
                                @if($skill->level === 'Expert') bg-emerald-100 text-emerald-700
                                @elseif($skill->level === 'Advanced') bg-indigo-100 text-indigo-700
                                @elseif($skill->level === 'Intermediate') bg-amber-100 text-amber-700
                                @else bg-slate-100 text-slate-700
                                @endif">
                                @if($skill->level === 'Expert')
                                    <i class="fas fa-star mr-1 text-xs"></i>
                                @elseif($skill->level === 'Advanced')
                                    <i class="fas fa-fire mr-1 text-xs"></i>
                                @elseif($skill->level === 'Intermediate')
                                    <i class="fas fa-chart-line mr-1 text-xs"></i>
                                @else
                                    <i class="fas fa-seedling mr-1 text-xs"></i>
                                @endif
                                {{ $skill->level }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Projects Section -->
    @if($projects->count() > 0)
    <section id="projects" class="py-24 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">My Work</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mt-2">Featured Projects</h2>
                <div class="mt-4 w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-sm card-hover border border-slate-100">
                        <!-- Project Image -->
                        <div class="relative h-56 overflow-hidden bg-gradient-to-br from-indigo-100 to-purple-100">
                            @if($project->image)
                                <img src="{{ Storage::url($project->image) }}"
                                     alt="{{ $project->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 h-12 w-20">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-code text-6xl text-indigo-300"></i>
                                </div>
                            @endif
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                @if($project->link)
                                    <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                                       class="px-6 py-2 bg-white text-slate-900 rounded-full text-sm font-medium hover:bg-indigo-600 hover:text-black transition">
                                        <i class="fas fa-external-link-alt mr-2"></i>View Project
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Project Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition">
                                {{ $project->name }}
                            </h3>
                            @if($project->description)
                                <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
                                    {{ $project->description }}
                                </p>
                            @endif

                            @if($project->link)
                                <div class="mt-4 pt-4 border-t border-slate-100">
                                    <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center text-indigo-600 font-medium text-sm hover:text-indigo-800 transition group/link">
                                        <span>View Project</span>
                                        <svg class="ml-2 w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Experience Section -->
    @if($experiences->count() > 0)
    <section id="experience" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">My Journey</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mt-2">Work Experience</h2>
                <div class="mt-4 w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 mx-auto rounded-full"></div>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="relative">
                    <!-- Timeline line -->
                    <div class="absolute left-0 md:left-1/2 transform md:-translate-x-px h-full w-0.5 timeline-line"></div>

                    @foreach($experiences as $index => $experience)
                        <div class="relative mb-12 last:mb-0">
                            <div class="flex items-center md:justify-center mb-4 md:mb-0">
                                <div class="absolute left-0 md:left-1/2 transform -translate-x-1/2 w-4 h-4 bg-white border-4 border-indigo-600 rounded-full z-10"></div>
                            </div>

                            <div class="ml-8 md:ml-0 {{ $index % 2 === 0 ? 'md:pr-8 md:text-right md:mr-1/2' : 'md:pl-8 md:ml-1/2' }}">
                                <div class="bg-slate-50 p-6 rounded-2xl shadow-sm card-hover border border-slate-100 {{ $index % 2 === 0 ? 'md:mr-8' : 'md:ml-8' }}">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 mb-3">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $experience->start_date->format('M Y') }} -
                                        {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                                    </span>
                                    <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $experience->title }}</h3>
                                    <p class="text-indigo-600 font-semibold mb-3">{{ $experience->company }}</p>
                                    @if($experience->description)
                                        <p class="text-slate-600 text-sm leading-relaxed">{{ $experience->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-slate-100 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 hero-gradient opacity-5"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">Get In Touch</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mt-2">Let's Work Together</h2>
                <div class="mt-4 w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 mx-auto rounded-full"></div>
                <p class="mt-6 text-slate-600 max-w-2xl mx-auto text-lg">
                    Have a project in mind or just want to say hello? Feel free to reach out through any of the platforms below.
                </p>
            </div>

            @if($contacts->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-{{ min($contacts->count(), 4) }} gap-6 max-w-4xl mx-auto">
                    @foreach($contacts as $contact)
                        <a href="{{ $contact->link }}" target="_blank" rel="noopener noreferrer"
                           class="group bg-white p-6 rounded-2xl shadow-sm card-hover border border-slate-100 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                @if($contact->icon)
                                    <i class="{{ $contact->icon }} text-2xl text-black"></i>
                                @else
                                    <i class="fas fa-link text-2xl text-black"></i>
                                @endif
                            </div>
                            <h3 class="font-semibold text-slate-900 group-hover:text-indigo-600 transition">{{ $contact->title }}</h3>
                            <p class="text-sm text-slate-500 mt-1 truncate">{{ str_replace(['https://', 'http://', 'mailto:', 'tel:'], '', $contact->link) }}</p>
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- CTA Card -->
            <div class="mt-16 max-w-3xl mx-auto">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-8 sm:p-12 text-center text-black shadow-2xl shadow-indigo-500/30">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-black">Ready to start a project?</h3>
                    <p class="text-black/90 mb-8 max-w-xl mx-auto">
                        I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.
                    </p>
                    @if($contacts->where('title', 'Email')->first() || $contacts->first())
                        <a href="{{ $contacts->where('title', 'Email')->first()?->link ?? $contacts->first()?->link ?? '#' }}"
                           class="inline-flex items-center px-8 py-4 bg-white text-indigo-600 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Send Me a Message
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-black py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <a href="#" class="text-2xl font-bold text-indigo-400 hover:text-indigo-300 transition">
                        {{ $profile?->name ?? 'Portfolio' }}
                    </a>
                    <p class="text-slate-400 mt-2 text-sm">Building digital experiences with passion.</p>
                </div>

                @if($contacts->count() > 0)
                    <div class="flex gap-4">
                        @foreach($contacts as $contact)
                            <a href="{{ $contact->link }}" target="_blank" rel="noopener noreferrer"
                               class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-800 text-slate-400 hover:bg-indigo-600 hover:text-black transition-all duration-300"
                               title="{{ $contact->title }}">
                                @if($contact->icon)
                                    <i class="{{ $contact->icon }}"></i>
                                @else
                                    <i class="fas fa-link"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="border-t border-slate-800 mt-8 pt-8 text-center text-slate-400 text-sm">
                <p>&copy; {{ date('Y') }} {{ $profile?->name ?? 'Portfolio' }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });

        // Smooth scrolling for all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-md');
            } else {
                nav.classList.remove('shadow-md');
            }
        });
    </script>
</body>
</html>

