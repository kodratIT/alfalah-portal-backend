<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Header Section (dengan dark mode support) --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
            <div class="flex items-center">
                <div class="ml-5">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Selamat Datang di Dashboard</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Ponpes Jauharul Falah Al-Islamy — Data Terkini</p>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            {{-- Total Santri --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-emerald-100 dark:bg-emerald-900/30 p-2 rounded-full">
                        <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Total Santri</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalSantri }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Santri Aktif</p>
                    </div>
                </div>
            </div>

            {{-- Total Guru --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full">
                        <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.42a12.08 12.08 0 01.66 6.48A11.95 11.95 0 0012 20.05a11.95 11.95 0 00-6.82-3 12.08 12.08 0 01.66-6.48L12 14z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Total Guru</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalGuru }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Tenaga Pengajar</p>
                    </div>
                </div>
            </div>

            {{-- Total Siswa RA --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full">
                        <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.42a12.08 12.08 0 01.66 6.48A11.95 11.95 0 0012 20.05a11.95 11.95 0 00-6.82-3 12.08 12.08 0 01.66-6.48L12 14z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Total Siswa RA</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalSiswaRa }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Siswa RA</p>
                    </div>
                </div>
            </div>

            {{-- Total Berita --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-2 rounded-full">
                        <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Total Berita</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalBerita }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Artikel Published</p>
                    </div>
                </div>
            </div>

            {{-- Total Program --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-pink-100 dark:bg-pink-900/30 p-2 rounded-full">
                        <svg class="h-5 w-5 text-pink-600 dark:text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Program Aktif</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalProgram }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Program Berjalan</p>
                    </div>
                </div>
            </div>

            {{-- Total Donasi --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-yellow-100 dark:bg-yellow-900/30 p-2 rounded-full">
                        <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.9 1 3 1.9 3 3V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V9M12 8C13.1 8 14 8.9 14 10S13.1 12 12 12 10 11.1 10 10 10.9 8 12 8Z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Total Donasi</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Dana Terkumpul</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ringkasan Sistem --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Ringkasan Sistem</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                {{-- Sistem Aktif --}}
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full">
                            <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Sistem Aktif</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Semua modul berjalan normal</p>
                        </div>
                    </div>
                </div>

                {{-- Performance --}}
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Performance</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Response time optimal</p>
                        </div>
                    </div>
                </div>

                {{-- Backup --}}
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="bg-purple-100 dark:bg-purple-900/30 p-2 rounded-full">
                            <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Data Backup</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Tersinkronisasi hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-filament-panels::page>