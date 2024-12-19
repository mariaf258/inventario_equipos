<script setup lang="ts">
import EquipoDefault from '@/utils/interfaces/InterfaceEquipos';
import UsuariosDefault from '@/utils/interfaces/interfaceUsuarios';
import {EmpleadoServicio} from '@/services/empleados/EmpleadoServicio';
import {alertaCamposEmpleado} from '@/utils/alertaCampos';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const router  = useRouter()

const empleadoServicio = new EmpleadoServicio();

const datos = new EquipoDefault();
const datosUsuario = new UsuariosDefault();


const crearEmpleado =async()=>{
  if (!alertaCamposEmpleado(datos)) {
    return;
  }  else {
        alert('Se agrego empleado exitosamente.');
    } 
  const respuestaCrear = await empleadoServicio.crearEmpleado(datos)
}

const obtenerEmpleados =async()=>{
  const respuestaObtener = await empleadoServicio.obtenerEmpleados()
}

const actualizadoEmpleado =async(id: string, empleadoActualizado: UsuariosDefault)=>{
  const respuestaActualizar = await empleadoServicio.actualizadoEmpleado(id, empleadoActualizado)
}

const eliminarEmpleado =async(id : string)=>{
  const respuestaEliminar = await empleadoServicio.eliminarEmpleado(id)
}



</script>


<template>
  <div id="app4">

        <div class="button-btn">
          <!-- <a><router-link to="/talentoHumano" class="btn btn-primary">Volver</router-link></a> -->
          <a class="btn btn-primary" @click="router.go(-1)">Volver</a>

        </div>  

      <div class="form4 justify-content-center">
        
        <div class="login">
          <h1>
            AGREGAR EMPLEADO
            <hr />
          </h1>

          <h2>C.I. MINAS LA AURORA S.A.S.</h2>
          <br />

          
          <section class="section-empleado">
            <div class="formulario">
            <form class="form-empleado" @submit.prevent="crearEmpleado()">
              <!-- <button class="btn btn-primary-volver" type="submit"> Volver </button> -->

              <div class="form-group">
                  <input type="name" v-model="datos.name" placeholder="" />
                  <label class="form-label">Nombre Empleado</label>
                </div>
                
                <div class="form-group">
                  <input type="post" v-model="datos.post" placeholder="" />
                  <label class="form-label">Cargo del Empleado</label>
                </div>
                
                <div class="form-group">
                  <input type="etiqueta" v-model="datos.etiqueta" placeholder="" />
                  <label class="form-label">Etiqueta del Equipo</label>
                </div>
                
                <div class="form-group">
                  <input type="descripcion" v-model="datos.descripcion" placeholder="" />
                  <label class="form-label">Descripción del Equipo</label>
                </div>
                
                <div class="form-group">
                  <input type="marca" v-model="datos.marca" placeholder="" />
                  <label class="form-label">Marca del Equipo</label>
                </div>
                
                <div class="form-group">
                  <input type="serie" v-model="datos.serie" placeholder="" />
                  <label class="form-label">Serie del Equipo</label>
                </div>
                
                <div class="form-group">
                  <input type="Nserial" v-model="datos.Nserial" placeholder="" />
                  <label class="form-label">Número serial del Equipo</label>
                </div>

                <div class="form-group">
                  <input type="disco" v-model="datos.disco" placeholder="" />
                  <label class="form-label">Disco del Equipo</label>
                </div>
                
                <div class="form-group">
                  <input type="ram" v-model="datos.ram" placeholder="" />
                  <label class="form-label">Ram del Equipo</label>
                </div>
                
                <div class="form-group">
                  <input type="estado" v-model="datos.estado" placeholder="" />
                  <label class="form-label">Estado del Equipo</label>
                </div>
                
                <div class="form-group">
                  <input type="observacion" v-model="datos.observacion" placeholder="" />
                  <label class="form-label">Observacion del Equipo</label>
                </div>
            </form>

                <div class="buttons">

                  <button class="btn btn-primary-add" type="submit" @click="crearEmpleado"> Agregar Empleado </button>

                </div>
              </div>
          </section>
        </div>
      </div>
    
    <footer class="footer4 d-flex w-100 justify-content-center">
      <img src="../../public/img/logo-mla.png" alt="Logo MLA" />
    </footer> 
</div>
</template>

<style>
@import '/src/assets/agregarEmpleado.css'
</style> 
