<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portal Administrativo: Resultados del Diagnóstico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Lista de Alumnos Evaluados</h3>
                    <p class="text-sm text-gray-600">Monitoreo en tiempo real del estado de la prueba diagnóstica.</p>
                </div>

                <div class="flex flex-col mt-4">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Alumno</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Progreso</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aciertos (Max 10)</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Matriz de Respuestas (P1 a P10)</th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($alumnos as $alumno)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $alumno['name'] }}</div>
                                                    <div class="text-sm text-gray-500">{{ $alumno['email'] }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $alumno['progreso'] }}
                                                    </span>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                    @if($alumno['nota'] !== '-')
                                                        <span class="{{ $alumno['nota'] >= 6 ? 'text-green-600' : 'text-orange-600' }}">
                                                            {{ $alumno['nota'] }} / 10
                                                        </span>
                                                    @else
                                                        <span class="text-gray-400">Sin iniciar</span>
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap.text-sm.text-gray-500">
                                                    <div class="flex space-x-1">
                                                        @for($i = 1; $i <= 10; $i++)
                                                            @if(isset($alumno['respuestas'][$i]))
                                                                @if($alumno['respuestas'][$i] == true)
                                                                    <span class="w-6 h-6 flex items-center justify-center text-xs font-bold rounded bg-green-500 text-white" title="Pregunta {{ $i }}: Correcta">
                                                                        {{ $i }}
                                                                    </span>
                                                                @else
                                                                    <span class="w-6 h-6 flex items-center justify-center text-xs font-bold rounded bg-red-500 text-white" title="Pregunta {{ $i }}: Incorrecta">
                                                                        {{ $i }}
                                                                    </span>
                                                                @endif
                                                            @else
                                                                <span class="w-6 h-6 flex items-center justify-center text-xs font-bold rounded bg-gray-200 text-gray-400" title="Pregunta {{ $i }}: No respondida">
                                                                    {{ $i }}
                                                                </span>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
