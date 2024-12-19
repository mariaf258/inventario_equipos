<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { ModuloServicio } from '@/services/modulos/ModuloServicio'
import type { Modulos } from '@/utils/interfaces/InterfaceModulos'
import { useRouter } from 'vue-router';

const router  = useRouter()

const moduloServicio = new ModuloServicio()
const name = ref<string>('')
const shortName = ref<string>('')
  const modulos = ref<Modulos[]>([])

const crearModulo = async () => {
  if (!name.value || !shortName.value) {
    alert('Por favor, completa todos los campos.');
    return;
  }
  
  const nuevoModulo: Modulos = { name: name.value, shortName: shortName.value }
  await moduloServicio.crearModulos(nuevoModulo)
  console.log('Nuevo módulo creado:', nuevoModulo)
  name.value = ''
  shortName.value = ''
}


onMounted(async() => {
  await obtenerModulos()
  agregarRutasDinamicas()
})

const obtenerModulos = async () => {
  const modulos: Modulos[] = await moduloServicio.obtenerModulos()
  console.log(modulos)
}

// Función para agregar rutas dinámicas
const agregarRutasDinamicas = () => {
    modulos.value.forEach((modulo) => {
        const rutaExistente = router.options.routes.find(
            (route) => route.name?.toLowerCase() === modulo.name.toLowerCase()
        );

        if (!rutaExistente) {
            // Procesar el nombre para generar el path
            const processedPath = modulo.name
                .toLowerCase()
                .split(' ')
                .filter((word) => word !== 'de') // Elimina "de"
                .map((word, index) =>
                    index === 0
                        ? word // La primera palabra queda en minúscula
                        : word.charAt(0).toUpperCase() + word.slice(1) // La segunda palabra y siguientes inician con mayúscula
                )
                .join('');

            const nuevaRuta = {
                path: `/${processedPath}`, // Path procesado
                name: modulo.name,
                component: () =>
                    import(`@/views/${processedPath}.vue`) // Suponiendo que la vista sigue el mismo formato del path
            };

            router.addRoute(nuevaRuta); 
            console.log('Ruta agregada dinámicamente:', nuevaRuta);
        }
    });
};



</script>

<template>

  <div id="app2">

      <div class="button-btn">
        <a><router-link to="/" class="btn btn-primary">Volver</router-link></a>
        
      </div>    


      <div class="form2 justify-content-center">
        
        <div class="login">
          <h1>
            CREAR DEPARTAMENTO
            <hr />
          </h1>

          <h2>C.I. MINAS LA AURORA S.A.S.</h2>
          <br />
          <h3>DATOS</h3>

          <section class="form-2">
            <form class="form-2" @submit.prevent="crearModulo()">
            <div class="form-group">
              <input type="name" v-model="name" placeholder="" />
              <label class="form-label">Nombre departamento</label>
            </div>
            <div class="form-group">
              <input type="shortName" v-model="shortName" placeholder="" />
              <label class="form-label">Nombre corto</label>
            </div>

            <button class="btn btn-primary" type="submit">Agregar</button>

            </form>
          </section>
          
        </div>
      </div>
    
    <footer class="footer d-flex w-100 justify-content-center">
      <img src="../../public/img/logo-mla.png" alt="Logo MLA" />
    </footer> 
</div>
</template>

<style>
@import '/src/assets/crearModulo.css'
</style> 
