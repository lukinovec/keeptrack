<span x-on:click="editButton(item)"
    class="z-30 m-0 duration-300 transform bg-black cursor-pointer rounded-xxxl sm:hover:scale-125" style="width:30px; height:30px"
    :class="{ 'bg-blueGray-500': edit.apiID == item.apiID }">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="padding: 6px" width="30px" height="30px" class="icon-edit">
        <path class="primary" fill="rgba(226, 232, 240)"
            d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z" />
        <rect fill="rgba(226, 232, 240)" width="20" height="2" x="2" y="20" class="secondary" rx="1" /></svg>
</span>