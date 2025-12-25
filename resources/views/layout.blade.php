<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Inventaris</title>
    
    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Tailwind Config --}}
    <script>
        tailwind.config = {
          theme: {
            extend: {
              fontFamily: {
                sans: ['Inter', 'sans-serif'],
              },
              colors: {
                brand: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    900: '#1e3a8a',
                }
              }
            }
          }
        }
    </script>

    <style>
       
        nav[role="navigation"] svg {
            width: 20px;
            height: 20px;
            display: inline-block;
        }
       
        nav[role="navigation"] > div.flex.justify-between.flex-1 {
            display: none; 
        }
        @media (min-width: 640px) {
            nav[role="navigation"] > div.flex.justify-between.flex-1 {
                display: flex; 
            }
        }
        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #3b82f6;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <div class="bg-brand-600 text-white p-1.5 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-gray-900">Gu<span class="text-brand-600">dang</span></span>
                    </div>
                    <div class="hidden sm:ml-8 sm:flex sm:items-center sm:space-x-4">
                        <a href="{{ route('products.index') }}"
                           class="{{ request()->routeIs('products.index') ? 'bg-brand-50 text-brand-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Inventaris
                        </a>
                        <a href="{{ route('reports.index') }}"
                           class="{{ request()->routeIs('reports.index') ? 'bg-brand-50 text-brand-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Laporan
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-3 relative flex items-center gap-3">
                        <div class="text-right hidden md:block">
                            <div class="text-sm font-medium text-gray-900">Admin Gudang</div>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 border border-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-start justify-between animate-fade-in-down">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                Berhasil!
                            </p>
                            <p class="text-sm text-green-700 mt-1">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700 hover:bg-green-100 p-1 rounded transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <button id="chat-launcher" onclick="toggleChat()" class="fixed bottom-6 right-6 bg-brand-600 hover:bg-brand-700 text-white p-4 rounded-full shadow-xl transition-transform transform hover:scale-110 z-50 flex items-center justify-center group">
        <svg id="icon-chat" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <svg id="icon-close" class="w-8 h-8 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        <span class="absolute right-full mr-3 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Tanya AI Gudang</span>
    </button>

    <div id="chat-window" class="fixed bottom-24 right-6 w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 z-50 hidden flex-col overflow-hidden transition-all duration-300 origin-bottom-right transform scale-95 opacity-0">
        <div class="bg-brand-600 p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-lg"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                <div><h3 class="font-bold text-white text-sm">Gudang AI Assistant</h3><p class="text-brand-100 text-xs flex items-center gap-1"><span class="w-2 h-2 bg-green-400 rounded-full inline-block animate-pulse"></span> Powered by Gemini</p></div>
            </div>
        </div>
        <div id="chat-messages" class="flex-1 p-4 h-80 overflow-y-auto bg-gray-50 space-y-4">
            <div class="flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg></div>
                <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-3 border-gray-200 bg-white rounded-e-xl rounded-es-xl shadow-sm"><p class="text-sm font-normal text-gray-900">Halo! Saya asisten pintar gudang ini. Ada yang bisa saya bantu cek stok atau buat laporan?</p></div>
            </div>
        </div>
        <div class="p-3 bg-white border-t border-gray-100">
            <form id="chat-form" onsubmit="handleChatSubmit(event)" class="relative">
                <input type="text" id="chat-input" class="block w-full p-3 pr-12 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-brand-500 focus:border-brand-500 shadow-sm" placeholder="Tulis pesan..." autocomplete="off">
                <button type="submit" class="absolute right-2 bottom-2 bg-brand-600 hover:bg-brand-700 text-white p-1.5 rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg></button>
            </form>
            <p class="text-center text-[10px] text-gray-400 mt-2">AI dapat membuat kesalahan. Cek kembali info stok.</p>
        </div>
    </div>

    {{-- Script Chat --}}
    <script>
        const chatWindow = document.getElementById('chat-window');
        const chatLauncher = document.getElementById('chat-launcher');
        const iconChat = document.getElementById('icon-chat');
        const iconClose = document.getElementById('icon-close');
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');
        let isChatOpen = false;

        function toggleChat() {
            isChatOpen = !isChatOpen;
            if (isChatOpen) {
                chatWindow.classList.remove('hidden');
                setTimeout(() => { chatWindow.classList.remove('scale-95', 'opacity-0'); chatWindow.classList.add('scale-100', 'opacity-100'); }, 10);
                iconChat.classList.add('hidden'); iconClose.classList.remove('hidden'); chatInput.focus();
            } else {
                chatWindow.classList.remove('scale-100', 'opacity-100'); chatWindow.classList.add('scale-95', 'opacity-0');
                setTimeout(() => { chatWindow.classList.add('hidden'); }, 300);
                iconChat.classList.remove('hidden'); iconClose.classList.add('hidden');
            }
        }
        async function handleChatSubmit(e) {
            e.preventDefault(); const message = chatInput.value.trim(); if (!message) return;
            appendMessage('user', message); chatInput.value = ''; const loadingId = appendLoading();
            setTimeout(() => { removeLoading(loadingId); appendMessage('ai', 'Maaf, backend API Gemini belum terhubung. Tapi UI chat ini sudah siap digunakan! Anda bertanya: "' + message + '"'); }, 1500);
        }
        function appendMessage(sender, text) {
            const div = document.createElement('div'); div.className = `flex items-start gap-2.5 ${sender === 'user' ? 'flex-row-reverse' : ''}`;
            const avatar = sender === 'user' ? `<div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>` : `<div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>`;
            const bubbleColor = sender === 'user' ? 'bg-brand-600 text-white rounded-s-xl rounded-ee-xl' : 'bg-white text-gray-900 border border-gray-200 rounded-e-xl rounded-es-xl shadow-sm';
            div.innerHTML = `${avatar}<div class="flex flex-col w-full max-w-[320px] leading-1.5 p-3 ${bubbleColor}"><p class="text-sm font-normal">${text}</p></div>`;
            chatMessages.appendChild(div); chatMessages.scrollTop = chatMessages.scrollHeight;
        }
        function appendLoading() {
            const id = 'loading-' + Date.now(); const div = document.createElement('div'); div.id = id; div.className = 'flex items-start gap-2.5';
            div.innerHTML = `<div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg></div><div class="flex flex-col w-full max-w-[100px] leading-1.5 p-3 border-gray-200 bg-white rounded-e-xl rounded-es-xl shadow-sm"><div class="flex space-x-1"><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div></div></div>`;
            chatMessages.appendChild(div); chatMessages.scrollTop = chatMessages.scrollHeight; return id;
        }
        function removeLoading(id) { const el = document.getElementById(id); if (el) el.remove(); }
    </script>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Sainzlab.my.id</p>
                <div class="flex space-x-6">
                    <a href="https://github.com/SainzLab" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>