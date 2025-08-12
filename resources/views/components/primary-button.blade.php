<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2
                    bg-emerald-600 dark:bg-emerald-400
                    border border-transparent rounded-md
                    font-semibold text-xs text-white dark:text-gray-900
                    uppercase tracking-widest
                    hover:bg-emerald-700 dark:hover:bg-emerald-500
                    focus:bg-emerald-700 dark:focus:bg-emerald-500
                    active:bg-emerald-800 dark:active:bg-emerald-600
                    focus:outline-none focus:ring-2
                    focus:ring-yellow-500 focus:ring-offset-2
                    dark:focus:ring-offset-gray-900
                    transition ease-in-out duration-150',
    ]) }}>
    {{ $slot }}
</button>
