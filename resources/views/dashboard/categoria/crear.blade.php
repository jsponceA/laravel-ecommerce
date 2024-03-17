@extends("layouts.layout_dashboard")

<!-- TITULO PARA CADA VISTA -->
@section("titulo","NUEVA CATEGORIA")

@push("css")
    <!-- INICIO - CSS ADICIONALES SI ES NECESARIO -->
    <!-- FIN - CSS ADICIONALES SI ES NECESARIO -->
@endpush



@section("content")
    <Dashboard-Categoria-Crear :categorias-Padre="{{$categoriasPadre}}"/>
@endsection


@push("js")
    <!-- INICIO - JS ADICIONALES SI ES NECESARIO -->
    <!-- FIN - JS ADICIONALES SI ES NECESARIO -->
@endpush

