<div class="flex w-full h-full text-center transition duration-75 ease-in-out text-blueGray-300"
style="background: #0f172a" x-data="{ logIn: true }" @login-mode-change.window="logIn = !logIn">
    <section class="flex-1 hidden bg-transparent border-none primary md:flex justify-evenly left-pane">
        <article class="z-20 flex flex-col items-center justify-center flex-1 w-full p-2 m-2 text-left border-none">
            <h1 class="inline pb-3 text-6xl font-extrabold border-b-4 select-none primary">KeepTrack<span class="font-semibold primary">.</span> </h1>
            <p class="text-3xl leading-loose pt-7">Welcome!</p>
        </article>
        <svg class="z-0 block border-r-2 fill-current text-blueGray-800 primary" style="width: 150px" viewBox="0 0 56 100" preserveAspectRatio="none">
            <polygon points="0,0 56,0 56,100" class="fill-current primary" />
        </svg>
    </section>
    <section class="flex flex-col items-center flex-1 text-6xl font-extrabold justify-evenly bg-blueGray-800 right-pane">
        <span class="flex flex-col items-center justify-center m-5 text-4xl font-bold text-blueGray-300 md:hidden">
            Welcome to KeepTrack! <br>
            <span class="text-xl">
                Log in to continue
            </span>
         </span>
        <livewire:login  :key="'login'" />
    </section>
</div>