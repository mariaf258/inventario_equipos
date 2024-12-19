<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { cerrarSesion } from '../router/index'

const isDropdownVisible = ref(false)
const router = useRouter();

const toggleDropdown = () => {
    isDropdownVisible.value = !isDropdownVisible.value
}

const logout = () => {
    console.log('Cerrando sesión...')
    localStorage.removeItem('savedUsername')
    localStorage.removeItem('savedPassword')
    localStorage.removeItem('rememberCredentials')
    cerrarSesion()
    router.replace('/inventarioEquipos_login')
}
</script>

<template>
    <div>
    <img
        src="../../public/img/user.png"
        alt="user"
        @click="toggleDropdown"
        class="userIcon"
    />
    <ul v-show="isDropdownVisible" class="dropdown-menu">
        <img
        src="../../public/img/user-white.png"
        alt="user"
        @click="toggleDropdown"
        class="userIcon-white"
        />
        <a class="dropdown-item" @click="logout">Cerrar Sesión</a>
    </ul>
    </div>
</template>


