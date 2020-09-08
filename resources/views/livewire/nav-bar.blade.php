<div>
    <router-link to="/" class="text-6xl text-blue-400">KeepTrack</router-link>
    <router-link to="/login" class="m-5">Login</router-link>
    <button type="button" @click="logout()" v-if="isLogged">Logout</button>
</div>