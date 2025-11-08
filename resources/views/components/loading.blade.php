<div id="global-loading"
    class="hidden fixed inset-0 bg-gradient-to-br from-green-100 via-white to-green-50 dark:from-gray-300 dark:via-gray-300 dark:to-gray-300 flex flex-col items-center justify-center z-[9999] transition-opacity duration-300">

    <!-- Spinner -->
    <div class="relative w-20 h-20 flex items-center justify-center">
        <!-- Lingkaran dasar -->
        <div class="absolute inset-0 border-4 border-green-200 rounded-full"></div>
        <!-- Lingkaran berputar -->
        <div class="absolute inset-0 border-4 border-green-600 border-t-transparent rounded-full animate-spin"></div>
    </div>

    <!-- Teks Loading -->
    <p id="loading-text" class="mt-6 text-xl font-semibold text-green-700 dark:text-green-400 animate-pulse">
        Memuat...
    </p>
</div>
