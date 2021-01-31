<button x-on:click="favorite(item)" class="absolute right-0 z-50 m-2 duration-300 transform bg-black rounded-xxxl sm:hover:scale-125"
        :class="{ 'bg-yellow-600': item.is_favorite }" style="top: 6rem; right: 1rem">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px" class="m-auto icon-star">
            <path class="secondary" fill="rgba(226, 232, 240)"
                d="M9.53 16.93a1 1 0 0 1-1.45-1.05l.47-2.76-2-1.95a1 1 0 0 1 .55-1.7l2.77-.4 1.23-2.51a1 1 0 0 1 1.8 0l1.23 2.5 2.77.4a1 1 0 0 1 .55 1.71l-2 1.95.47 2.76a1 1 0 0 1-1.45 1.05L12 15.63l-2.47 1.3z" />
        </svg>
</button>