<script setup lang="ts">
import ModuloDefault from '@/utils/interfaces/InterfaceModulos';
import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { ModuloServicio } from '@/services/modulos/ModuloServicio';

const router  = useRouter()


const moduloServicio = new ModuloServicio();

const cards = ref<ModuloDefault[]>([]);
const selectedCard = ref<ModuloDefault | null>(null);

const filteredCards = () => {
    const modulosFiltrados =  moduloServicio.obtenerModulos(cards.value)
    cards.value = modulosFiltrados;
    
    
};


onMounted(() => {
    obtenerModulos();

});



const obtenerModulos = async () => {
    const respuestaObtener = await ModuloServicio.obtenerModulos();
    if (respuestaObtener) {
        cards.value = respuestaObtener;
        console.log(cards.value);
    }
    filteredCards();
};

// Abre formulario con datos de una card
const openUpdateForm = (card: ModuloDefault) => {
    console.log(card);
    
};

// Eliminar 
const eliminarCard = async (etiqueta: string | undefined) => {
    if (!etiqueta) {
        alert('No se puede eliminar: etiqueta no válida.');
        return;
    }

    const confirmacion = confirm('¿Estás seguro de que deseas eliminar este modulo?');
    if (!confirmacion) return;

    console.log('Etiqueta a eliminar:', etiqueta); 
    const respuestaEliminar = await ModuloServicio.eliminarModulos(etiqueta);

    if (!respuestaEliminar) {
        const index = cards.value.findIndex((card) => card.etiqueta === etiqueta);
        if (index !== -1) {
            cards.value.splice(index, 1);
        }
        alert('Error al eliminar el modulo.');
    } else {
        alert('Modulo eliminado correctamente.');
    }
};


const cancelUpdate = () => {
    selectedCard.value = null;
};


</script>

<template>
    <div id="app4">

        <div class="button-btn">
            <a class="btn btn-primary" @click="router.go(-1)">Volver</a>

        </div>  

        <div class="form4 justify-content-center">
        <div class="login">
            <h1>ELIMINAR MODULO</h1>
            <hr />
            <h2>C.I. MINAS LA AURORA S.A.S.</h2>
            <br />
            <!-- <h6>SELECCIONAR MODULO</h6> -->
            

            <select class="form-select" 
            v-model="selectedCard"
            aria-label="Default select example">
                <option disabled value="">Seleccione modulo</option>
                <option
                class="card-delete"

                v-for="card in cards"
                :key="card.id"
                :value="card"
                @click="openUpdateForm(card)"
            >
                <h4>{{ card.name }} - </h4>
                <p>{{ card.descripcion }}</p>
            </option>
            </select>


            <section v-if="selectedCard" class="section-delete">
                <div class="formulario">
                
                    <div class="buttons-delete">
                        <button 
                        class="btn btn-danger" 
                        type="submit" 
                        :disabled="!selectedCard"
                        @click="eliminarCard(selectedCard?.id)"
                    >
                        Eliminar Cambios
                    </button>

                        <button class="btn btn-primary" type="button" @click="cancelUpdate">Cancelar</button>
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
@import '/src/assets/eliminarModulo.css';
</style>
