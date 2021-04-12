@extends('principal')
@section('contenido')

@if(Auth::check())
    @if (Auth::user()->id == 1)
      <template v-if="menu==0">
        <example-component></example-component>
      </template>

      <template v-if="menu==1">
      <categoria></categoria>
      </template>

      <template v-if="menu==2">
      <articulo></articulo>
      </template>

      <template v-if="menu==3">
      <rol></rol>
      </template>

      <template v-if="menu==4">
      <plantilla-componente></plantilla-componente>
      </template>
    @elseif (Auth::user()->id == 2)
        <template v-if="menu==0">
          <example-component></example-component>
        </template>

        <template v-if="menu==1">
        <categoria></categoria>
        </template>

        <template v-if="menu==2">
        <articulo></articulo>
        </template>
    @elseif (Auth::user()->id == 3)
        <template v-if="menu==2">
            <articulo></articulo>
        </template>   
        <template v-if="menu==4">
          <plantilla-componente></plantilla-componente>
        </template>
    @else

    @endif
@endif

@endsection
