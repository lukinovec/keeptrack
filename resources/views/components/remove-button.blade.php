<button x-on:click="remove(item)" class="absolute right-0 z-50 w-10 h-10 p-2 m-2 duration-300 transform bg-black rounded-full sm:hover:scale-125"
        style="top: 1rem; right: 1rem" :class="{ 'bg-blueGray-700': Object.keys(removeConfirmation.item).length !== 0 }">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512 512" style="fill: rgb(203, 213, 225)" xml:space="preserve">
<g>
	<g>
		<rect x="236" y="222.93" width="40" height="209"/>
	</g>
</g>
<g>
	<g>
		<rect x="316" y="222.93" width="40" height="209"/>
	</g>
</g>
<g>
	<g>
		<rect x="156" y="222.93" width="40" height="209"/>
	</g>
</g>
<g>
	<g>
		<path d="M412,72.933h-61V60c0-33.084-26.916-60-60-60h-70c-33.084,0-60,26.916-60,60v12.933h-61c-33.084,0-60,26.916-60,60V183h40
			v269c0,33.084,26.916,60,60,60h232c33.084,0,60-26.916,60-60V183h40v-50.067C472,99.849,445.084,72.933,412,72.933z M201,60
			c0-11.028,8.972-20,20-20h70c11.028,0,20,8.972,20,20v12.933H201V60z M392,452c0,11.028-8.972,20-20,20H140
			c-11.028,0-20-8.972-20-20V183h272V452z M432,143H80v-10.067c0-11.028,8.972-20,20-20h312c11.028,0,20,8.972,20,20V143z"/>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>

</button>