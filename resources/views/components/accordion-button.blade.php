<button
        class="uppercase flex items-center justify-between w-full p-4 font-medium text-left text-black border border-b-0 border-gray-200 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700"
        data-accordion-target="#{{ $targetId }}"
        aria-expanded="false"
        aria-controls="{{ $targetId }}">
    <span>{{ $slot }}</span>
    <svg 
        data-accordion-icon 
        class="w-3 h-3 rotate-180 shrink-0" 
        aria-hidden="true" 
        xmlns="http://www.w3.org/2000/svg" 
        fill="none" 
        viewBox="0 0 10 6">
        <path 
            stroke="currentColor" 
            stroke-linecap="round" 
            stroke-linejoin="round" 
            stroke-width="2" 
            d="M9 5 5 1 1 5"></path>
    </svg>
</button>