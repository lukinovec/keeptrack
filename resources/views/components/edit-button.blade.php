<span x-on:click="editButton(item)"
    class="absolute right-0 m-2 p-2 bg-black rounded-lg sm:w-8 w-12 transform duration-300 sm:hover:scale-125"
    :class="{ 'sm:scale-125 bg-blueGray-100': edit.apiID == item.apiID }" style="top: 2.5rem">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-edit w-full">
        <path class="primary" fill="#718096"
            d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z" />
        <rect fill="#718096" width="20" height="2" x="2" y="20" class="secondary" rx="1" /></svg>
</span>