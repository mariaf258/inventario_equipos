<script setup lang="ts">
import TheWelcome from '../components/TheWelcome.vue'
import EquipoDefault from '@/utils/interfaces/InterfaceEquipos';
import {EmpleadoServicio} from '@/services/empleados/EmpleadoServicio';
import { ref, onMounted } from 'vue'
import type { Equipo } from '@/utils/interfaces/InterfaceEquipos';
import { cerrarSesion } from '../router/index'
import { useRouter } from 'vue-router'
import LogoutButton from '@/components/LogoutButton.vue'


const empleadoServicio = new EmpleadoServicio()
const mensajeVisible = ref(false);
const deleteMode = ref(false);

const router = useRouter();


let empleadosModuloSagrilaft =ref<Equipo[]>([]);
const obtenerDatos = async () => {
  const empleados:Equipo[] = await empleadoServicio.obtenerEmpleados()
  console.log(empleados);
  

  const empleadosSagrilaft: Equipo[] = empleados.filter((empleado) => /^mla-sag-\d+$/i
  .test(empleado.etiqueta.toLowerCase()))
  .sort((a, b) => { 
      const numA = parseInt(a.etiqueta.split('-')[2], 10);
      const numB = parseInt(b.etiqueta.split('-')[2], 10);
      return numA - numB;
    })
.map((empleado) => ({
      ...empleado,
      etiqueta: empleado.etiqueta.toUpperCase(),
    }));
  console.log(empleadosSagrilaft);
  empleadosModuloSagrilaft.value = empleadosSagrilaft;
  console.log({empleadosModuloSagrilaft})
  
}



onMounted(() => {
  obtenerDatos().then(() => {
    filteredEmpleado.value = [...empleadosModuloSagrilaft.value];
  });
});


  const userIcon = document.getElementById('userIcon')
  const userDropdown = document.getElementById('userDropdown')

  userIcon?.addEventListener('click', () => {
    userDropdown?.classList.toggle('show')
  })


// Buscador
let filteredEmpleado = ref<any[]>([]);

const filtrarEmpleados = (event: Event) => {
  const input = (event.target as HTMLInputElement).value.toLowerCase();
  console.log('Buscando empleados con:', input);

  if (!input) {
    filteredEmpleado.value = [...empleadosModuloSagrilaft.value];
    return;
  }

  filteredEmpleado.value = empleadosModuloSagrilaft.value.filter((empleado) =>
    (empleado.name && empleado.name.toLowerCase().includes(input)) ||
    (empleado.etiqueta && empleado.etiqueta.toLowerCase().includes(input))
  );

  console.log('Resultados del filtro:', filteredEmpleado.value);
};


const guardarModulo =()=>{
  localStorage.setItem('modulo', "sag")
}



</script>

<template>
  <div id="app1">
    <div class="sidebar">
      <ul>
        <li>
          <a><router-link  to="/">Inicio</router-link></a>
        </li>
        <hr class="separador-1" />
      </ul>

      <div class="logo">
        <img src="../../public/img/logo-mla.png" alt="Logo" class="logo-img" />
      </div>
    </div>

    <div class="main-content-group">
      <div class="main-content">
        <div class="header-right">
          <nav class="navbar bg-body-tertiary fixed-top">
            <LogoutButton />
          </nav>

          <hr class="separador1" />
          <header>
            <div class="header-container">
              <div class="header-left">
                <h1>
                  INVENTARIO DE EQUIPOS<br />
                  C.I. MINAS LA AURORA S.A.S.
                </h1>
                <h2>SEDE - ADMINISTRACION</h2>
              </div>

              <div class="header-right">
                <input @input="filtrarEmpleados" type="text" id="searchInput" placeholder="Buscar Empleado" />
                <div id="results" class="results"></div>
              </div>
            </div>
          </header>
        </div>

        <div class="departamento"><h1>SAGRILAFT</h1></div>

        <div class="container-er">
          <div v-for="(item, index) in filteredEmpleado" :key="index" class="card1" 
          :class="{ selected: item.selected }" @click="selectCard(index)" v-bind:item="item as Equipo">
            
            <div class="face face1">
              <img
                src="../../public/img/user-solid.png"
                alt="User"
                style="width: 50px; margin-right: 10px"
              />
              <div>
                <h2>{{ item.name || 'No name provided' }}</h2>
                <p>{{ item.post || 'No post provided' }}</p>
              </div>
              <div class="icony">
                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
              </div>
            </div>
            <div class="face face2">
              <b>ETIQUETA:</b> {{ item.etiqueta }}<br />
              <b>DESCRIPCION:</b> {{ item.descripcion }}<br />
              <b>MARCA:</b> {{ item.marca }}<br />
              <b>LINEA/SERIE:</b> {{ item.serie }}<br />
              <b>No. SERIAL:</b> {{ item.Nserial }}<br />
              <b>DISCO DURO:</b> {{ item.disco }}<br />
              <b>RAM:</b> {{ item.ram }}<br />
              <b>ESTADO:</b> {{ item.estado || 'No state provided' }}<br />
              <b>OBSERVACIONES:</b> {{ item.observacion || 'No observations' }}
            </div>
          </div>
        </div>

        <div class="button-add">
          <router-link to="/agregarEmpleado" class="btn btn-primary">Agregar</router-link>
          <router-link to="/actualizarEmpleado" @click="guardarModulo" class="btn btn-success">Actualizar</router-link>
          <div v-show="mensajeVisible" class="tooltip">
            Selecciona una tarjeta para actualizar.
          </div>

          <router-link to="/eliminarEmpleado" @click="eliminarCard" class="btn btn-danger">Eliminar</router-link>


        </div>
      </div>
    </div>
  </div>
</template>

<style>
@import '/src/assets/datosDepartamentos.css'
</style>
