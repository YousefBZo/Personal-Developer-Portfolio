<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile?->name ?? 'Portfolio' }} - Developer Portfolio</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white text-slate-900 font-['Plus_Jakarta_Sans']">
<!-- Navigation -->
<nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <a href="#" class="text-2xl font-bold tracking-tight text-slate-900">
                {{ $profile?->name ?? 'Portfolio' }}<span class="text-indigo-600">.</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#about" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">About</a>
                <a href="#skills" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Skills</a>
                <a href="#projects" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Projects</a>
                <a href="#experience"
                   class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Experience</a>
                <a href="#contact"
                   class="px-5 py-2.5 bg-slate-900 text-white text-sm font-medium rounded-full hover:bg-indigo-600 transition-all duration-300 shadow-lg shadow-indigo-500/20">
                    Let's Talk
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-slate-400 hover:text-slate-900 transition-colors">
                        <i class="fas fa-cog"></i>
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-600 hover:text-slate-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="#about"
               class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">About</a>
            <a href="#skills"
               class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Skills</a>
            <a href="#projects"
               class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Projects</a>
            <a href="#experience"
               class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Experience</a>
            <a href="#contact" class="block px-3 py-2 text-base font-medium text-indigo-600 font-semibold">Contact
                Me</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="about" class="pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <div class="flex-1 text-center lg:text-left">
                <div
                    class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-sm font-medium mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 mr-2"></span>
                    Available for new projects
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
                    Building digital <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">experiences</span>
                    that matter.
                </h1>
                <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    {{ $profile?->bio ?? 'I am a passionate developer focused on creating intuitive and performant web applications.' }}
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="#projects"
                       class="w-full sm:w-auto px-8 py-3.5 bg-slate-900 text-white font-medium rounded-full hover:bg-indigo-600 transition-all duration-300 shadow-lg shadow-indigo-500/20 text-center">
                        View My Work
                    </a>
                    <a href="#contact"
                       class="w-full sm:w-auto px-8 py-3.5 bg-white text-slate-900 border border-slate-200 font-medium rounded-full hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300 text-center">
                        Contact Me
                    </a>
                </div>

                @if($contacts->count() > 0)
                    <div class="mt-10 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                        @foreach($contacts as $contact)
                            @php
                                $link = $contact->link;
                                $lowerTitle = strtolower($contact->title ?? '');
                                $isWhatsApp = str_contains($lowerTitle, 'whatsapp');

                                if (!$isWhatsApp && !str_starts_with($link, 'http') && !str_starts_with($link, 'mailto:')) {
                                    $link = str_contains($link, '@') ? 'mailto:' . $link : 'https://' . $link;
                                }
                            @endphp

                            @if($isWhatsApp)
                                <div
                                    class="flex items-center gap-2 px-4 py-2 bg-green-50 rounded-full border border-green-100">
                                    <i class="{{ $contact->icon ?? 'fab fa-whatsapp' }} text-xl text-green-500"></i>
                                    <span class="font-medium text-slate-700">{{ $contact->link }}</span>
                                </div>
                            @else
                                <a href="{{ $link }}" target="_blank"
                                   class="text-slate-400 hover:text-indigo-600 transition-colors text-2xl">
                                    @if($contact->icon)
                                        <i class="{{ $contact->icon }}"></i>
                                    @else
                                        <i class="fas fa-link"></i>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="flex-1 relative">
                <div class="relative w-72 h-72 sm:w-96 sm:h-96 mx-auto">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-violet-600 rounded-[2rem] rotate-6 opacity-20 blur-2xl"></div>
                    @if($profile?->image)
                        <img src="{{ Storage::url($profile->image) }}"
                             alt="{{ $profile->name }}"
                             class="relative w-full h-full object-cover rounded-[2rem] shadow-2xl rotate-3 hover:rotate-0 transition-all duration-500">
                    @else
                        <div
                            class="relative w-full h-full bg-slate-100 rounded-[2rem] flex items-center justify-center shadow-2xl rotate-3 hover:rotate-0 transition-all duration-500">
                            <span
                                class="text-6xl font-bold text-slate-300">{{ substr($profile?->name ?? 'P', 0, 1) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
@if($skills->count() > 0)
    <section id="skills" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Technical Expertise</h2>
                <p class="text-slate-600">A collection of technologies and tools I've mastered throughout my
                    journey.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6">
                @foreach($skills as $skill)
                    <div
                        class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 hover:border-indigo-200 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group flex flex-col items-center text-center h-full">
                        <div
                            class="w-12 h-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xl mb-3 group-hover:bg-indigo-600 group-hover:text-black transition-colors shadow-sm">
                            {{ substr($skill->name, 0, 1) }}
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2 text-sm sm:text-base line-clamp-2">{{ $skill->name }}</h3>
                        @if($skill->level)
                            <span class="mt-auto text-[10px] sm:text-xs font-medium px-2.5 py-1 rounded-full border
                                {{ $skill->level === 'Expert' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' :
                                  ($skill->level === 'Advanced' ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-slate-50 text-slate-600 border-slate-100') }}">
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
    <section id="projects" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Featured Projects</h2>
                    <p class="text-slate-600">Here are some of the projects I've worked on. Each one presented unique
                        challenges and learning opportunities.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div
                        class="group bg-white rounded-2xl overflow-hidden border border-slate-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col h-full">
                        <div class="relative h-52 overflow-hidden bg-slate-100">
                            @if($project->image)
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->name }}"
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-50">
                                    <i class="fas fa-code text-4xl text-slate-300"></i>
                                </div>
                            @endif

                            <!-- Overlay with button -->
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                @if($project->link)
                                    <a href="{{ $project->link }}" target="_blank"
                                       class="px-6 py-2.5 bg-white text-slate-900 rounded-full text-sm font-semibold hover:bg-indigo-50 transition-colors transform translate-y-4 group-hover:translate-y-0 duration-300 shadow-lg">
                                        View Project <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $project->name }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-4 flex-1">{{ $project->description }}</p>

                            <div class="pt-4 border-t border-slate-50 flex items-center justify-between mt-auto">
                                <span class="text-xs font-medium text-slate-400">Web Development</span>
                                @if($project->link)
                                    <a href="{{ $project->link }}" target="_blank"
                                       class="text-indigo-600 hover:text-indigo-700 text-sm font-medium flex items-center gap-1">
                                        Details <i class="fas fa-chevron-right text-[10px]"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Experience Section -->
@if($experiences->count() > 0)
    <section id="experience" class="py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Work Experience</h2>
                <p class="text-slate-600">My professional journey and career milestones.</p>
            </div>

            <div class="space-y-8 relative">
                <!-- Mobile Timeline Line -->
                <div class="absolute left-[19px] top-4 bottom-4 w-0.5 bg-slate-200 md:hidden"></div>

                @foreach($experiences as $experience)
                    <div class="relative pl-12 md:pl-0">
                        <!-- Desktop Timeline Line -->
                        <div
                            class="hidden md:block absolute left-[50%] top-0 bottom-0 w-px bg-slate-200 -translate-x-1/2"></div>

                        <div class="md:flex items-center justify-between group">
                            <!-- Left Side (Date) -->
                            <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0">
                                <span
                                    class="inline-block px-4 py-1.5 rounded-full bg-white border border-slate-200 text-sm font-medium text-indigo-600 shadow-sm group-hover:border-indigo-200 transition-colors">
                                    {{ $experience->start_date->format('M Y') }} -
                                    {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                                </span>
                            </div>

                            <!-- Center Dot -->
                            <div
                                class="absolute left-[13px] md:left-[50%] w-3.5 h-3.5 rounded-full bg-indigo-600 border-[3px] border-white shadow-md md:-translate-x-1/2 mt-2 md:mt-0 z-10 ring-1 ring-slate-200"></div>

                            <!-- Right Side (Content) -->
                            <div class="md:w-1/2 md:pl-12">
                                <div
                                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-indigo-100 transition-all duration-300 relative">
                                    <!-- Arrow for desktop -->
                                    <div
                                        class="hidden md:block absolute top-1/2 -left-2 w-4 h-4 bg-white border-l border-b border-slate-100 transform rotate-45 -translate-y-1/2"></div>

                                    <h3 class="text-lg font-bold text-slate-900">{{ $experience->title }}</h3>
                                    <div class="text-indigo-600 font-medium mb-3 flex items-center gap-2">
                                        <i class="fas fa-building text-xs opacity-70"></i>
                                        {{ $experience->company }}
                                    </div>
                                    <p class="text-slate-600 text-sm leading-relaxed">{{ $experience->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Contact Section -->
<section id="contact" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900 rounded-[2.5rem] p-8 md:p-16 overflow-hidden relative">
            <!-- Decorative Elements -->
            <div
                class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-indigo-600 rounded-full blur-3xl opacity-20"></div>
            <div
                class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-violet-600 rounded-full blur-3xl opacity-20"></div>

            <div class="relative z-10 text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold hover:text-gray-50 text-white mb-6">Ready to start your next
                    project?</h2>
                <p class="text-slate-300 text-lg mb-10">
                    I'm currently available for freelance work and open to new opportunities.
                    Let's discuss how we can work together to achieve your goals.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 flex-wrap">
                    @foreach($contacts as $contact)
                        @php
                            $link = $contact->link;
                            $lowerTitle = strtolower($contact->title ?? '');
                            $isWhatsApp = str_contains($lowerTitle, 'whatsapp');

                            if (!$isWhatsApp && !str_starts_with($link, 'http') && !str_starts_with($link, 'mailto:')) {
                                $link = str_contains($link, '@') ? 'mailto:' . $link : 'https://' . $link;
                            }
                        @endphp

                        @if($isWhatsApp)
                            <div
                                class="px-8 py-4 bg-white text-slate-900 font-medium rounded-full shadow-lg flex items-center gap-3">
                                <i class="fab fa-whatsapp text-xl text-green-500"></i>
                                <span>{{ $contact->link }}</span>
                            </div>
                        @else
                            <a href="{{ $link }}" target="_blank"
                               class="px-8 py-4 bg-white text-slate-900 font-medium rounded-full hover:bg-indigo-50 transition-colors w-full sm:w-auto shadow-lg text-center">
                                {{ $contact->title }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white border-t border-slate-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-center md:text-left">
            <span class="text-xl font-bold text-slate-900">{{ $profile?->name ?? 'Portfolio' }}<span
                    class="text-indigo-600">.</span></span>
            <p class="text-slate-500 text-sm mt-1">&copy; {{ date('Y') }} All rights reserved.</p>
        </div>

        <div class="flex items-center gap-6 flex-wrap justify-center md:justify-end">
            @foreach($contacts as $contact)
                @php
                    $link = $contact->link;
                    $lowerTitle = strtolower($contact->title ?? '');
                    $isWhatsApp = str_contains($lowerTitle, 'whatsapp');

                    if (!$isWhatsApp && !str_starts_with($link, 'http') && !str_starts_with($link, 'mailto:')) {
                        $link = str_contains($link, '@') ? 'mailto:' . $link : 'https://' . $link;
                    }
                @endphp

                @if($isWhatsApp)
                    <div class="flex items-center gap-2 text-slate-500">
                        <i class="fab fa-whatsapp text-xl text-green-500"></i>
                        <span class="text-sm">{{ $contact->link }}</span>
                    </div>
                @else
                    <a href="{{ $link }}" target="_blank"
                       class="text-slate-400 hover:text-indigo-600 transition-colors">
                        @if($contact->icon)
                            <i class="{{ $contact->icon }} text-xl"></i>
                        @else
                            <i class="fas fa-link text-xl"></i>
                        @endif
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
            // Close mobile menu if open
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
</body>
</html>
