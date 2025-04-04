<!-- <script setup lang="ts">
import EquipoDefault from '@/utils/interfaces/InterfaceEquipos';
import { EmpleadoServicio } from '@/services/empleados/EmpleadoServicio';

import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';

const router  = useRouter()


const empleadoServicio = new EmpleadoServicio();

const cards = ref<EquipoDefault[]>([]);
const selectedCard = ref<EquipoDefault | null>(null);



const filteredCards = () => {
    const empleadosFiltrados =  empleadoServicio.filtrarEmpleadoPorModulo(cards.value)
    cards.value = empleadosFiltrados;
    
    
};


onMounted(() => {
    obtenerEmpleados();

});


const obtenerEmpleados = async () => {
    const respuestaObtener = await empleadoServicio.obtenerEmpleados();
    if (respuestaObtener) {
        cards.value = respuestaObtener;
        console.log(cards.value);
    }
    filteredCards();
};

// Abre formulario con datos de una card
const openUpdateForm = (card: EquipoDefault) => {
    selectedCard.value = { ...card };
};

// Actualizar 
const actualizarCard = async () => {
    if (!selectedCard.value || !selectedCard.value.id) {
        console.error('No se puede actualizar: selectedCard está vacío o sin ID.');
        return;
    }

    console.log('Datos enviados a actualizadoEmpleado:', selectedCard.value);

    try {
        const respuestaActualizar = await empleadoServicio.actualizadoEmpleado(
            selectedCard.value.id,
            { ...selectedCard.value } 
        );

        if (respuestaActualizar) {

            const index = cards.value.findIndex(
                (card) => card.id === selectedCard.value!.id
            );

            if (index !== -1) {
                cards.value[index] = { ...selectedCard.value };
                alert('Empleado actualizado correctamente.');
            } else {
                alert('No se encontró la tarjeta para actualizar.');
            }

            selectedCard.value = null;
        } else {
            console.error('Error al actualizar en Firebase.');
        }
    } catch (error) {
        console.error('Error durante la actualización:', error);
    }
};


const cancelUpdate = () => {
    selectedCard.value = null;
};



</script>

<template>
    <section v-if="selectedCard" class="section-empleado">
                <div class="formulario">
                <form class="form-empleado" @submit.prevent="actualizarCard">
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.name" placeholder="" />
                    <label class="form-label">Nombre Empleado</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.post" placeholder="" />
                    <label class="form-label">Cargo del Empleado</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.etiqueta" placeholder="" />
                    <label class="form-label">Etiqueta del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.descripcion" placeholder="" />
                    <label class="form-label">Descripción del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.marca" placeholder="" />
                    <label class="form-label">Marca del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.serie" placeholder="" />
                    <label class="form-label">Serie del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.Nserial" placeholder="" />
                    <label class="form-label">Número serial del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.disco" placeholder="" />
                    <label class="form-label">Disco del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.ram" placeholder="" />
                    <label class="form-label">Ram del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.estado" placeholder="" />
                    <label class="form-label">Estado del Equipo</label>
                    </div>
    
                    <div class="form-group">
                    <input type="text" v-model="selectedCard.observacion" placeholder="" />
                    <label class="form-label">Observacion del Equipo</label>
                    </div>
    
                    <div class="buttons-update">
                    <button class="btn btn-success" type="submit">Guardar Cambios</button>
                    <button class="btn btn-primary" type="button" @click="cancelUpdate">Cancelar</button>
                    </div>
                </form>
                </div>
            </section>
</template>

<style>
@import '/src/assets/formularioActualizar.css'
</style> -->