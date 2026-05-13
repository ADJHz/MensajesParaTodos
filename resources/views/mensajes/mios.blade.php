@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Mis Mensajes')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="font-app-heading text-3xl font-bold text-gray-900">Mis Mensajes 💌</h1>
            <p class="text-gray-500 mt-1">Todos los mensajes que has creado. Puedes editarlos sin costo extra.</p>
        </div>
        <a href="{{ route('mensajes.crear') }}"
           class="inline-flex items-center justify-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-medium px-5 py-2.5 rounded-2xl shadow-sm transition">
            + Crear nuevo mensaje
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-violet-50 border border-violet-100 rounded-2xl p-5 flex items-center gap-4">
            <div class="text-3xl">📬</div>
            <div>
                <p class="text-sm text-gray-500">Total creados</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            </div>
        </div>
        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5 flex items-center gap-4">
            <div class="text-3xl">✅</div>
            <div>
                <p class="text-sm text-gray-500">Pagados</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['pagados'] }}</p>
            </div>
        </div>
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 flex items-center gap-4">
            <div class="text-3xl">⏳</div>
            <div>
                <p class="text-sm text-gray-500">Pendientes</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['pendientes'] }}</p>
            </div>
        </div>
    </div>

    {{-- Tabs filtro --}}
    <div class="flex flex-wrap items-center gap-2 mb-6">
        @php
            $tabs = ['todos' => 'Todos', 'pagados' => 'Pagados', 'pendientes' => 'Pendientes'];
        @endphp
        @foreach($tabs as $key => $label)
            <a href="{{ route('mensajes.mios', ['filtro' => $key]) }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition
                      {{ $filtro === $key
                            ? 'bg-violet-600 text-white shadow-sm'
                            : 'bg-white text-violet-700 border border-violet-200 hover:bg-violet-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Grid de mensajes --}}
    @if($mensajes->isEmpty())
        <div class="bg-white border border-gray-100 rounded-3xl shadow-sm p-12 text-center max-w-lg mx-auto">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="font-app-heading text-2xl font-bold text-gray-900 mb-2">Aún no tienes mensajes</h3>
            <p class="text-gray-500 mb-6">Crea tu primer mensaje y compártelo con quien más quieras.</p>
            <a href="{{ route('mensajes.crear') }}"
               class="inline-flex items-center justify-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-medium px-6 py-3 rounded-2xl shadow-sm transition">
                Crear mi primer mensaje
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($mensajes as $m)
                @php $pagado = $m->isPagado(); @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col
                            border-t-4 {{ $pagado ? 'border-t-emerald-400' : 'border-t-amber-400' }}">

                    <div class="p-5 flex-1 flex flex-col">
                        {{-- Cabecera --}}
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="text-3xl shrink-0">{{ $m->ocasion->emoji ?? '💌' }}</div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $m->ocasion->nombre ?? 'Mensaje' }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ $m->ocasion->categoria->nombre ?? '' }}</p>
                                </div>
                            </div>
                            @if($pagado)
                                <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">Pagado</span>
                            @else
                                <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">Pendiente</span>
                            @endif
                        </div>

                        {{-- Destinatario --}}
                        <p class="text-sm text-gray-700 mb-2">
                            <span class="text-gray-400">Para:</span>
                            <span class="font-bold text-gray-900">{{ $m->destinatario }}</span>
                        </p>

                        {{-- Preview --}}
                        <p class="text-sm italic text-gray-500 line-clamp-3 mb-4">
                            "{{ Str::limit(strip_tags($m->mensaje), 100) }}"
                        </p>

                        {{-- Imagen + fecha --}}
                        <div class="mt-auto flex items-center justify-between gap-3">
                            @if($m->imagen_path)
                                <img src="{{ asset('storage/'.$m->imagen_path) }}"
                                     alt="Imagen"
                                     class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            @else
                                <div></div>
                            @endif
                            <p class="text-xs text-gray-400">Hace {{ $m->created_at->diffForHumans(null, true) }}</p>
                        </div>
                    </div>

                    {{-- Footer acciones --}}
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
                        @if($pagado)
                            <div class="flex items-center gap-2">
                                <a href="{{ route('mensajes.show', $m->code) }}" target="_blank"
                                   class="flex-1 text-center text-sm font-medium bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded-xl transition">
                                    Ver
                                </a>
                                <a href="{{ route('mensajes.editar', $m->code) }}"
                                   class="flex-1 text-center text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-800 px-3 py-2 rounded-xl transition">
                                    Editar
                                </a>

                                <div class="relative">
                                    <button id="ddBtn-{{ $m->code }}"
                                            data-dropdown-toggle="dd-{{ $m->code }}"
                                            type="button"
                                            class="text-gray-600 hover:bg-gray-200 px-3 py-2 rounded-xl text-lg leading-none transition"
                                            aria-label="Más opciones">
                                        ⋯
                                    </button>
                                    <div id="dd-{{ $m->code }}"
                                         class="z-10 hidden bg-white border border-gray-200 rounded-xl shadow-lg w-52">
                                        <ul class="p-2 text-sm text-gray-700">
                                            <li>
                                                <button type="button"
                                                        x-data
                                                        @click="navigator.clipboard.writeText('{{ route('mensajes.show', $m->code) }}'); $el.textContent='✓ Copiado'; setTimeout(()=>{ $el.innerHTML='📋 Copiar link' }, 2000)"
                                                        class="w-full text-left px-3 py-2 rounded-lg hover:bg-violet-50">
                                                    📋 Copiar link
                                                </button>
                                            </li>
                                            <li>
                                                <a target="_blank" rel="noopener"
                                                   href="https://wa.me/?text={{ urlencode('Te dejé un mensaje especial 💌 '.route('mensajes.show', $m->code)) }}"
                                                   class="block px-3 py-2 rounded-lg hover:bg-violet-50">
                                                    💚 Compartir en WhatsApp
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" rel="noopener"
                                                   href="https://twitter.com/intent/tweet?text={{ urlencode('Te dejé un mensaje especial 💌') }}&url={{ urlencode(route('mensajes.show', $m->code)) }}"
                                                   class="block px-3 py-2 rounded-lg hover:bg-violet-50">
                                                    🐦 Compartir en Twitter
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('mensajes.destroy', $m->code) }}"
                                                      x-data
                                                      @submit.prevent="if(confirm('¿Estás seguro? Esta acción no se puede deshacer.')) $el.submit()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-full text-left px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">
                                                        🗑️ Eliminar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-2">
                                <a href="{{ route('pago.checkout', $m->code) }}"
                                   class="block w-full text-center text-sm font-semibold bg-amber-500 hover:bg-amber-600 text-white px-3 py-2.5 rounded-xl transition">
                                    Completar pago
                                </a>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('mensajes.editar', $m->code) }}"
                                       class="flex-1 text-center text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-800 px-3 py-2 rounded-xl transition">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('mensajes.destroy', $m->code) }}"
                                          x-data
                                          @submit.prevent="if(confirm('¿Estás seguro? Esta acción no se puede deshacer.')) $el.submit()"
                                          class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-sm font-medium bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-xl transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        <div class="mt-10">
            {{ $mensajes->links() }}
        </div>
    @endif

</div>
@endsection
