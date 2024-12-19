const rutasDinamicas = new Set<string>();

const agregarRutasDinamicas = () => {
    modulos.value.forEach((modulo) => {
        const processedPath = modulo.name
            .toLowerCase()
            .split(' ')
            .filter((word) => word !== 'de') 
            .map((word, index) =>
                index === 0
                    ? word 
                    : word.charAt(0).toUpperCase() + word.slice(1) 
            )
            .join('');

        if (!rutasDinamicas.has(processedPath)) {
            const nuevaRuta = {
                path: `/${processedPath}`,
                name: modulo.name,
                component: () =>
                    import(`@/views/${processedPath}.vue`)
            };

            router.addRoute(nuevaRuta);
            rutasDinamicas.add(processedPath); // Marca esta ruta como agregada
            console.log('Ruta agregada dinámicamente:', nuevaRuta);
        }
    });
};

component: async () => {
    try {
        return await import(`@/views/${processedPath}.vue`);
    } catch (error) {
        console.error(`No se pudo cargar la vista para: ${processedPath}`, error);
        throw error; // Opcionalmente, lanza el error
    }
}

const processedPath = modulo.name
    .normalize('NFD') // Normaliza acentos
    .replace(/[\u0300-\u036f]/g, '') // Elimina marcas diacríticas
    .toLowerCase()
    .split(' ')
    .filter((word) => word !== 'de')
    .map((word, index) =>
        index === 0
            ? word
            : word.charAt(0).toUpperCase() + word.slice(1)
    )
    .join('');
