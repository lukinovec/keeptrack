{{-- <span x-on:click="favorite(item)" class="absolute z-30 flex items-center justify-center w-12 p-2 m-2 duration-300 transform bg-black cursor-pointer rounded-xxxl sm:w-8 sm:hover:scale-125"
        :class="{ 'bg-yellow-600': item.is_favorite }" style="bottom: -1.2rem; right: 1rem">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24px" height="24px" class="w-full icon-star">
            <path class="w-full secondary" fill="rgba(226, 232, 240)"
                d="M9.53 16.93a1 1 0 0 1-1.45-1.05l.47-2.76-2-1.95a1 1 0 0 1 .55-1.7l2.77-.4 1.23-2.51a1 1 0 0 1 1.8 0l1.23 2.5 2.77.4a1 1 0 0 1 .55 1.71l-2 1.95.47 2.76a1 1 0 0 1-1.45 1.05L12 15.63l-2.47 1.3z" />
        </svg>
</span> --}}

<span x-on:click="favorite(item)"
    class="absolute z-30 w-12 h-12 p-1 m-2 duration-300 transform bg-black cursor-pointer rounded-xxxl sm:w-8 sm:h-8 sm:hover:scale-125"
    :class="{ 'bg-yellow-600': item.is_favorite }" style="bottom: -1.2rem; right: 1rem">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  class="w-full h-full icon-star">
            <path class="w-full h-full secondary" fill="rgba(226, 232, 240)"
                d="M9.53 16.93a1 1 0 0 1-1.45-1.05l.47-2.76-2-1.95a1 1 0 0 1 .55-1.7l2.77-.4 1.23-2.51a1 1 0 0 1 1.8 0l1.23 2.5 2.77.4a1 1 0 0 1 .55 1.71l-2 1.95.47 2.76a1 1 0 0 1-1.45 1.05L12 15.63l-2.47 1.3z" />
        </svg>
</span>