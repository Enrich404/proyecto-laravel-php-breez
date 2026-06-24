<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prueba Diagnóstica - Programación Avanzada') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="cuestionarioApp()">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm text-gray-600">Alumno evaluado:</p>
                    <p class="font-bold text-md text-indigo-700">{{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
                </div>

                <div x-show="paso < preguntas.length">

                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200" 
                              x-text="'Pregunta ' + (paso + 1) + ' de ' + preguntas.length"></span>
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 mb-4" x-text="preguntas[paso].pregunta"></h3>

                    <div class="space-y-3">
                        <template x-for="(opcion, index) in preguntas[paso].opciones" :key="index">
                            <button @click="seleccionarOpcion(index)"
                                    :disabled="respondido"
                                    :class="{
                                        'border-indigo-500 bg-indigo-50': opcionSeleccionada === index,
                                        'border-gray-200 hover:bg-gray-50': opcionSeleccionada !== index
                                    }"
                                    class="w-full text-left p-4 border rounded-lg transition-all flex items-center justify-between">
                                <span x-text="opcion.texto"></span>
                            </button>
                        </template>
                    </div>

                    <div x-show="respondido" class="mt-4 p-4 rounded-lg" :class="feedbackCorrecto ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'">
                        <p class="font-bold" x-text="feedbackCorrecto ? '¡Excelente!' : 'Incorrecto'"></p>
                        <p class="text-sm mt-1" x-text="preguntas[paso].opciones[opcionSeleccionada]?.justificacion"></p>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button x-show="!respondido" @click="enviarRespuesta()" :disabled="opcionSeleccionada === null" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded shadow disabled:opacity-50">Enviar Respuesta</button>

                        <button x-show="respondido" @click="siguientePregunta()" 
                                class="px-4 py-2 bg-gray-800 text-white rounded shadow">Siguiente</button>
                    </div>

                </div>

                <div x-show="paso >= preguntas.length" class="text-center py-8">
                    <h3 class="text-2xl font-bold text-green-600 mb-2">¡Diagnóstico Completado!</h3>
                    <p class="text-gray-600">Tus respuestas han sido asociadas de forma segura a tu cuenta de estudiante.</p>
                    <p class="mt-4 text-sm text-gray-500">Puntaje final: <span class="font-bold text-lg text-gray-800" x-text="aciertos"></span> / 10</p>
                </div>

            </div>
        </div>
    </div>

    <script>
        function cuestionarioApp() {
            return {
                paso: 0,
                opcionSeleccionada: null,
                respondido: false,
                feedbackCorrecto: false,
                aciertos: 0,
                preguntas: [
                    {
                        numero: 1,
                        pregunta: "En la arquitectura MVC de Laravel que utiliza el proyecto, ¿cuál es la responsabilidad principal del archivo ubicado en app/Http/Controllers?",
                        opciones: [
                            { texto: "Definir la estructura de las tablas...", justificacion: "Esta es la responsabilidad de las migraciones.", correcta: false },
                            { texto: "Recibir las peticiones HTTP, procesar la lógica...", justificacion: "El controlador actúa como intermediario.", correcta: true },
                            { texto: "Renderizar el HTML final...", justificacion: "El renderizado es tarea de las vistas Blade.", correcta: false },
                            { texto: "Interceptar exclusivamente...", justificacion: "Esto lo hacen los Middlewares.", correcta: false }
                        ]
                    },
                    {
                        numero: 2,
                        pregunta: "Si deseas que la nueva ruta /panel sea accesible únicamente por usuarios logueados...",
                        opciones: [
                            { texto: "Asignarle un componente Alpine.js...", justificacion: "Alpine maneja el frontend.", correcta: false },
                            { texto: "Crear una nueva migración...", justificacion: "Las migraciones estructuran SQL.", correcta: false },
                            { texto: "Modificar el archivo composer.json...", justificacion: "Composer maneja librerías.", correcta: false },
                            { texto: "Agrupar la ruta usando los middlewares 'auth' y 'verified'.", justificacion: "Los middlewares filtran peticiones HTTP.", correcta: true }
                        ]
                    }
                ],

                seleccionarOpcion(index) {
                    this.opcionSeleccionada = index;
                },

                enviarRespuesta() {
                    let preguntaActual = this.preguntas[this.paso];
                    this.feedbackCorrecto = preguntaActual.opciones[this.opcionSeleccionada].correcta;
                    if(this.feedbackCorrecto) this.aciertos++;
                    this.respondido = true;

                    fetch("{{ route('diagnostico.guardar') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            pregunta_numero: preguntaActual.numero,
                            opcion_elegida: this.opcionSeleccionada
                        })
                    })
                    .then(res => res.json())
                    .then(data => console.log("Guardado en servidor:", data));
                },

                siguientePregunta() {
                    this.paso++;
                    this.opcionSeleccionada = null;
                    this.respondido = false;
                }
            }
        }
    </script>

</x-app-layout>
