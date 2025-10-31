@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => '
    border-gray-300             /* Borde discreto */
    bg-white                    /* Fondo blanco */
    text-gray-900               /* Texto oscuro */
    focus:border-indigo-500     /* Foco (Será sobrescrito por el Rojo) */
    focus:ring-indigo-500       /* Anillo de foco */
    rounded-md shadow-sm
']) }}>