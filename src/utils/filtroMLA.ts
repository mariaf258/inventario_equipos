
export const crearFiltroPorShortName = (shortName: string): RegExp => {
    return new RegExp(`^${shortName}-\\w+-\\d+$`, 'i');
    };
    