<script lang="ts">
import { defineComponent } from 'vue'
import { cerrarSesion, iniciarSesion } from '@/router'
function togglePassword() {
  const passwordField = document.getElementById('password')
  if (passwordField.type === 'password') {
    passwordField.type = 'text'
  } else {
    passwordField.type = 'password'
  }
}

const validCredentials: Record<string, string> = {
  'sistemas': '123',
};

export default defineComponent({
  name: 'LoginView',
  data() {
    return {
      username: '',
      password: '',
      rememberCredentials: false,
      showPassword: false,
    };
  },

  mounted() {
    if (localStorage.getItem('rememberCredentials') === 'true') {
      this.username = localStorage.getItem('savedUsername') || '';
      this.password = localStorage.getItem('savedPassword') || '';
      this.rememberCredentials = true;
    }
  },
  methods: {
    login() {
      // const { username, password, rememberCredentials } = this;
      const username = this.username;
      const password = this.password;

      console.log('Username:', username);
      console.log('Password:', password);

      if (validCredentials[username] === password) {
        if (this.rememberCredentials) {
          localStorage.setItem('savedUsername', this.username);
          localStorage.setItem('savedPassword', this.password);
          localStorage.setItem('rememberCredentials', 'true');
        } else {
          localStorage.removeItem('savedUsername');
          localStorage.removeItem('savedPassword');
          localStorage.removeItem('rememberCredentials');
        }
        iniciarSesion();
        this.$router.replace('/');
      } else {
        alert('Usuario o contraseña incorrectos');
      }
    },

  },
});
</script>

<template>

  <div id="app3">
    <div class="form3 justify-content-center">
      <div class="d-flex w-100 justify-content-center">
        <img src="../../public/img/user.png" alt="user" />
      </div>
      <div class="login">
        <h1>
          INVENTARIO DE EQUIPOS
          <hr />
        </h1>

        <h2>C.I. MINAS LA AURORA S.A.S.</h2>
        <br />
        <h3>Iniciar Sesión</h3>

        <section class="section-3">
          <form class="form-3" @submit.prevent="login()">
            <div class="form-group">
              <input type="username" v-model="username" placeholder="" />
              <label class="form-label3">Usuario</label>
            </div>

            <div class="form-group">
              <input :type="showPassword ? 'text' : 'password'" v-model="password" placeholder="" />
              <label class="form-label3">Contraseña</label>
              <span class="toggle-password" @click="showPassword = !showPassword">
                <i :class="showPassword ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
              </span>
            </div>

            <div class="forget">
              <label for="rememberCredentials"><input type="checkbox" v-model="rememberCredentials"/>Recordar</label>
            </div>

              <button type="submit" class="btn btn-primary">INICIAR SESIÓN</button>

          </form>
  </section>

        <!-- <button class="btn btn-primary">INICIAR SESIÓN</button> -->
      </div>
    </div>
  </div>
  <footer class="footer d-flex w-100 justify-content-center">
    <img src="../../public/img/logo-mla.png" alt="Logo MLA" />
  </footer>
</template>

<style>
@import '/src/assets/inventarioEquipos_login.css'
</style>
