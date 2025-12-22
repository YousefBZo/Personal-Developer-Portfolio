{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="description" content="{{ $profile?->bio ?? 'Personal Developer Portfolio' }}">--}}

{{--    <title>{{ $profile?->name ?? 'Portfolio' }} - Developer Portfolio</title>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />--}}

{{--    <!-- Scripts -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--</head>--}}
{{--<body class="font-sans antialiased bg-gray-50">--}}
{{--    <!-- Navigation -->--}}
{{--    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md shadow-sm">--}}
{{--        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--            <div class="flex justify-between items-center h-16">--}}
{{--                <a href="#" class="text-xl font-bold text-gray-900">--}}
{{--                    {{ $profile?->name ?? 'Portfolio' }}--}}
{{--                </a>--}}
{{--                <div class="hidden md:flex space-x-8">--}}
{{--                    <a href="#about" class="text-gray-600 hover:text-gray-900 transition">About</a>--}}
{{--                    <a href="#skills" class="text-gray-600 hover:text-gray-900 transition">Skills</a>--}}
{{--                    <a href="#projects" class="text-gray-600 hover:text-gray-900 transition">Projects</a>--}}
{{--                    <a href="#experience" class="text-gray-600 hover:text-gray-900 transition">Experience</a>--}}
{{--                    <a href="#contact" class="text-gray-600 hover:text-gray-900 transition">Contact</a>--}}
{{--                </div>--}}
{{--                @auth--}}
{{--                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">--}}
{{--                        Admin Panel--}}
{{--                    </a>--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--    <!-- Hero Section -->--}}
{{--    <section id="about" class="pt-32 pb-20 px-4">--}}
{{--        <div class="max-w-6xl mx-auto">--}}
{{--            <div class="flex flex-col md:flex-row items-center gap-12">--}}
{{--                <div class="flex-shrink-0">--}}
{{--                    @if($profile?->image)--}}
{{--                        <img src="{{ Storage::url($profile->image) }}"--}}
{{--                             alt="{{ $profile->name }}"--}}
{{--                             class="w-48 h-48 rounded-full object-cover shadow-xl ring-4 ring-white">--}}
{{--                    @else--}}
{{--                        <div class="w-48 h-48 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-xl">--}}
{{--                            <span class="text-6xl font-bold text-white">--}}
{{--                                {{ substr($profile?->name ?? 'P', 0, 1) }}--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="text-center md:text-left">--}}
{{--                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">--}}
{{--                        Hi, I'm {{ $profile?->name ?? 'Developer' }}--}}
{{--                    </h1>--}}
{{--                    @if($profile?->major)--}}
{{--                        <p class="text-xl text-blue-600 font-medium mb-4">{{ $profile->major }}</p>--}}
{{--                    @endif--}}
{{--                    @if($profile?->bio)--}}
{{--                        <p class="text-lg text-gray-600 max-w-2xl">{{ $profile->bio }}</p>--}}
{{--                    @endif--}}
{{--                    <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">--}}
{{--                        <a href="#contact" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">--}}
{{--                            Get in Touch--}}
{{--                        </a>--}}
{{--                        <a href="#projects" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">--}}
{{--                            View Projects--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- Skills Section -->--}}
{{--    @if($skills->count() > 0)--}}
{{--    <section id="skills" class="py-20 bg-white">--}}
{{--        <div class="max-w-6xl mx-auto px-4">--}}
{{--            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Skills & Technologies</h2>--}}
{{--            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">--}}
{{--                @foreach($skills as $skill)--}}
{{--                    <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition transform hover:-translate-y-1">--}}
{{--                        <h3 class="font-semibold text-gray-900 mb-2">{{ $skill->name }}</h3>--}}
{{--                        @if($skill->level)--}}
{{--                            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full--}}
{{--                                @if($skill->level === 'Expert') bg-green-100 text-green-800--}}
{{--                                @elseif($skill->level === 'Advanced') bg-blue-100 text-blue-800--}}
{{--                                @elseif($skill->level === 'Intermediate') bg-yellow-100 text-yellow-800--}}
{{--                                @else bg-gray-100 text-gray-800--}}
{{--                                @endif">--}}
{{--                                {{ $skill->level }}--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    @endif--}}

{{--    <!-- Projects Section -->--}}
{{--    @if($projects->count() > 0)--}}
{{--    <section id="projects" class="py-20 bg-gray-50">--}}
{{--        <div class="max-w-6xl mx-auto px-4">--}}
{{--            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Featured Projects</h2>--}}
{{--            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">--}}
{{--                @foreach($projects as $project)--}}
{{--                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition transform hover:-translate-y-1">--}}
{{--                        @if($project->image)--}}
{{--                            <img src="{{ Storage::url($project->image) }}"--}}
{{--                                 alt="{{ $project->name }}"--}}
{{--                                 class="w-full h-48 object-cover">--}}
{{--                        @else--}}
{{--                            <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">--}}
{{--                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <div class="p-6">--}}
{{--                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $project->name }}</h3>--}}
{{--                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $project->description }}</p>--}}
{{--                            @if($project->link)--}}
{{--                                <a href="{{ $project->link }}"--}}
{{--                                   target="_blank"--}}
{{--                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">--}}
{{--                                    View Project--}}
{{--                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    @endif--}}

{{--    <!-- Experience Section -->--}}
{{--    @if($experiences->count() > 0)--}}
{{--    <section id="experience" class="py-20 bg-white">--}}
{{--        <div class="max-w-4xl mx-auto px-4">--}}
{{--            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Work Experience</h2>--}}
{{--            <div class="space-y-8">--}}
{{--                @foreach($experiences as $experience)--}}
{{--                    <div class="relative pl-8 pb-8 border-l-2 border-blue-200 last:pb-0">--}}
{{--                        <div class="absolute -left-2 top-0 w-4 h-4 rounded-full bg-blue-600"></div>--}}
{{--                        <div class="bg-gray-50 rounded-xl p-6">--}}
{{--                            <h3 class="text-xl font-semibold text-gray-900">{{ $experience->title }}</h3>--}}
{{--                            <p class="text-blue-600 font-medium">{{ $experience->company }}</p>--}}
{{--                            <p class="text-sm text-gray-500 mt-1">--}}
{{--                                {{ $experience->start_date->format('M Y') }} ---}}
{{--                                {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}--}}
{{--                            </p>--}}
{{--                            <p class="text-gray-600 mt-3">{{ $experience->description }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    @endif--}}

{{--    <!-- Contact Section -->--}}
{{--    <section id="contact" class="py-20 bg-gray-900 text-white">--}}
{{--        <div class="max-w-4xl mx-auto px-4 text-center">--}}
{{--            <h2 class="text-3xl font-bold mb-4">Let's Connect</h2>--}}
{{--            <p class="text-gray-400 mb-8">Feel free to reach out through any of these platforms</p>--}}

{{--            @if($contacts->count() > 0)--}}
{{--                <div class="flex flex-wrap justify-center gap-4">--}}
{{--                    @foreach($contacts as $contact)--}}
{{--                        <a href="{{ $contact->link }}"--}}
{{--                           target="_blank"--}}
{{--                           class="flex items-center px-6 py-3 bg-gray-800 rounded-lg hover:bg-gray-700 transition">--}}
{{--                            @switch($contact->icon)--}}
{{--                                @case('github')--}}
{{--                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>--}}
{{--                                    </svg>--}}
{{--                                    @break--}}
{{--                                @case('linkedin')--}}
{{--                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>--}}
{{--                                    </svg>--}}
{{--                                    @break--}}
{{--                                @case('whatsapp')--}}
{{--                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>--}}
{{--                                    </svg>--}}
{{--                                    @break--}}
{{--                                @case('twitter')--}}
{{--                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>--}}
{{--                                    </svg>--}}
{{--                                    @break--}}
{{--                                @case('email')--}}
{{--                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>--}}
{{--                                    </svg>--}}
{{--                                    @break--}}
{{--                                @default--}}
{{--                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>--}}
{{--                                    </svg>--}}
{{--                            @endswitch--}}
{{--                            {{ $contact->title }}--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <p class="text-gray-400">No contact information available yet.</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- Footer -->--}}
{{--    <footer class="py-6 bg-gray-900 border-t border-gray-800">--}}
{{--        <div class="max-w-6xl mx-auto px-4 text-center text-gray-400 text-sm">--}}
{{--            <p>&copy; {{ date('Y') }} {{ $profile?->name ?? 'Portfolio' }}. All rights reserved.</p>--}}
{{--        </div>--}}
{{--    </footer>--}}
{{--</body>--}}
{{--</html>--}}

