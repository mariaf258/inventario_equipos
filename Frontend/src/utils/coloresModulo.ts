// export const generarColorEstatico = (input: string): string => {
//     let hash = 0;
//     for (let i = 0; i < input.length; i++) {
//       hash = input.charCodeAt(i) + ((hash << 5) - hash); // Genera un hash numérico
//     }
//     const color = `#${((hash >> 0) & 0xffffff).toString(16).padStart(6, '0')}`; // Convierte a un color HEX
//     return color;
//     };
    