<script setup lang="ts">
import { ref, watch, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import app from '../utils/firebase.js'
import { getFirestore, getDocs, addDoc, collection } from 'firebase/firestore'
import { cerrarSesion } from '../router/index'
import type { Modulos } from '@/utils/interfaces/InterfaceModulos';
import { ModuloServicio } from '@/services/modulos/ModuloServicio';
import { sections } from '@/utils/sesionesDepartamentos.js'
import LogoutButton from '@/components/LogoutButton.vue'



const moduloServicio = new ModuloServicio();
const db = getFirestore(app)
const router = useRouter();



const crearRegistro = async (idModulo: number, idUsuario: number, name: string, shortName: string) => {
  try {
    const color = generarColorEstatico();
    await addDoc(collection(db, 'Modulos'), { idModulo, idUsuario, name, shortName, color });
    sections.value.push({
      id: idModulo,
      name,
      shortName,
      iconClass: 'nuevo-icono',
      path: shortName.toLowerCase(),
      color,
    });
  } catch (error) {
    console.error('Error al agregar registro: ', error);
  }
};



let ModuloInventario = ref<Modulos[]>([]);


const obtenerDatos = async () => {
  const modulos: Modulos[] = await moduloServicio.obtenerModulos()
  console.log(modulos);
  console.log(filteredSections.value.length);

  

  function generatePath(name: string): string {
  return name
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9\s]/g, '') // Elimina caracteres especiales
    .replace(/\s+/g, '');// Eliminar espacios entre nombres
}


modulos.forEach((modulo, index) => {
    const path = generatePath(modulo.name);
    const color = generarColorEstatico(modulo.shortName, 'pastel');
    
    filteredSections.value.push({
      id: 16+ index,
      name: modulo.name,
      shortName: modulo.shortName,
      iconClass: 'nuevo-icono',
      path,
      color,
      ...modulo
    })
  })

}


document.addEventListener('DOMContentLoaded', () => {
  const userIcon = document.getElementById('userIcon')
  const userDropdown = document.getElementById('userDropdown')

  userIcon?.addEventListener('click', () => {
    userDropdown?.classList.toggle('show')
  })
})


onMounted(async () => {
  
  filteredSections.value.push(...sections.value);
  console.log(filteredSections.value)
  await obtenerDatos()
  console.log(sections.value);

  console.log(filteredSections);

})



let filteredSections = ref<any[]>([]);



const filtrarModulos = (event: Event) => {
  const input = (event.target as HTMLInputElement).value.toLowerCase(); 
  console.log('Buscando módulos con:', input);

  if (!input) {
    filteredSections.value = [
      ...sections.value,
      ...ModuloInventario.value.map((modulo) => ({
        id: modulo.idModulo,
        name: modulo.name,
        shortName: modulo.shortName,
        iconClass: 'nuevo-icono',
        path: modulo.shortName.toLowerCase(),
        color: modulo.color || generarColorEstatico(modulo.shortName),
      }))
    ];
    return;
  }

  filteredSections.value = sections.value.filter(
    (section) =>
      section.name.toLowerCase().includes(input) ||
      section.shortName.toLowerCase().includes(input)
  );

  console.log('Resultados del filtro:', filteredSections.value);
};




// color de shortName
const generarColorEstatico = (input: string, tipo: 'pastel' | 'vivo' = 'pastel'): string => {
  let hash = 0;
  for (let i = 0; i < input.length; i++) {
    hash = input.charCodeAt(i) + ((hash << 5) - hash);
  }

  let r = (hash >> 16) & 0xff;
  let g = (hash >> 8) & 0xff;
  let b = hash & 0xff;

  if (tipo === 'pastel') {
    r = Math.floor((r + 255) / 2);
    g = Math.floor((g + 255) / 2);
    b = Math.floor((b + 255) / 2);
  } else if (tipo === 'vivo') {
    r = Math.min(255, r + 50);
    g = Math.min(255, g + 50);
    b = Math.min(255, b + 50);
  }

  const color = `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase()}`;
  return color;
};



</script>

<template>
  <div id="app">
    <sidebar></sidebar>
    <div class="sidebar">
      <ul>
        <li class="nav2">
          <router-link to="/">Inicio</router-link>
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

          <hr class="separador" />
          <header>
            <div class="header-container">
              <div class="header-left">
                <h1>
                  INVENTARIO DE EQUIPOS<br />
                  C.I. MINAS LA AURORA S.A.S
                </h1>
                <h2>SEDE - ADMINISTRACION</h2>
              </div>

              <div class="header-right">
                <input @input="filtrarModulos" type="text" id="searchInput" placeholder="Buscar" />
                <div id="results" class="results">
                  <ul>

                  </ul>
                </div>
              </div>
            </div>
          </header>
        </div>

        <div class="card-grid">
          <div class="card" v-for="section in filteredSections" :key="section.id">
            <router-link :to="`/${section.path.toLowerCase()}`">
              <div :class="`card-icon ${section.iconClass}`" :style="{ backgroundColor: section.color }">{{
                section.shortName.toUpperCase() }}</div>
              <p><b>{{ section.name.toUpperCase() }}</b></p>
            </router-link>
          </div>
  
  
        </div>
        <div class="button-add">
          
          <!-- <router-link to="/eliminarModulo" @click="eliminarCard" class="btn btn-danger">Eliminar</router-link> -->

      </div>
    </div>
  </div>
  </div>
  <!-- </div> -->
</template>




<style>
@import '/src/assets/inventarioEquipos.css'
</style>
