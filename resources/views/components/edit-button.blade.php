<span x-on:click="editButton(item)"
    class="absolute z-30 w-12 p-2 m-2 duration-300 transform bg-black cursor-pointer rounded-xxxl sm:w-8 sm:hover:scale-125"
    :class="{ 'sm:scale-125 bg-blueGray-100': edit.apiID == item.apiID }" style="bottom: -1.2rem; left: 1rem">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-full icon-edit">
        <path class="primary" fill="rgba(226, 232, 240)"
            d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z" />
        <rect fill="rgba(226, 232, 240)" width="20" height="2" x="2" y="20" class="secondary" rx="1" /></svg>
</span>