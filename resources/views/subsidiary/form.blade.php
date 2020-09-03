@extends('layouts.app')

@section('corpo')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>

    @include('layouts.alerts')

    <div class="card-body">
        <form action="{{ $action }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id_subsidiary" id="id_subsidiary" value="{{old('id_subsidiary', isset($subsidiary->id_subsidiary) ? $subsidiary->id_subsidiary : '') }}">

            <!-- Empresa -->
            <div class="form-row">
                <label for="tituloWebsite">Empresa</label>
                <select class="custom-select form-control" id="id_company" name="id_company">
                    <option value="" @if(old('id_company', (isset($subsidiary->id_company) ? $subsidiary->id_company : '')) == '') selected="selected" @endif>Selecione uma Empresa...</option>
                    @foreach ($companys as $company)
                        <option value="{{ $company->id_company }}" @if(old('id_company', (isset($subsidiary->id_company) ? $subsidiary->id_company : '')) == $company->id_company) selected="selected" @endif > {{ $company->name}}</option>
                    @endforeach
                </select>
            </div>

            <br/>

            <!-- Nome -->
            <div class="form-row">
                <label for="tituloWebsite">Nome Solicitação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', isset($subsidiary->name) ? $subsidiary->name : '') }}" required>
            </div>

            <br/>

            <!-- Descrição -->
            <div class="form-row">
                <label for="tituloWebsite">Descrição</label>
                <input type="text" class="form-control" id="description" name="description" value="{{old('description', isset($subsidiary->description) ? $subsidiary->description : '') }}">
            </div>

            <br/>

            <!-- Endereço -->
            <div class="form-row">
                <label for="tituloWebsite">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" value="{{old('address', isset($subsidiary->address) ? $subsidiary->address : '') }}">
            </div>

            <br/>

            <!-- Latitude -->
            <div class="form-row">
                <label for="tituloWebsite">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="{{old('latitude', isset($subsidiary->latitude) ? $subsidiary->latitude : '') }}">
            </div>

            <br/>

            <!-- Longitude -->
            <div class="form-row">
                <label for="tituloWebsite">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="{{old('longitude', isset($subsidiary->longitude) ? $subsidiary->longitude : '') }}">
            </div>

            <br/>

            <!-- Situação -->
            <div class="form-row">
                <label for="tituloWebsite">Situação</label>
                <select class="custom-select mr-sm-2" id="status" name="status">
                    <option value="false" @if(old('status', (isset($treatment->status) ? $treatment->status : 'false')) == 'false') selected="selected" @endif>Inativo</option>
                    <option value="true" @if(old('status', (isset($treatment->status) ? $treatment->status : 'true')) == 'true') selected="selected" @endif>Ativo</option>
                </select>
            </div>

            <br/>

            <!-- Salvar -->
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

        </form>
    </div> <!-- fim div card-body -->
</div> <!-- fim card shadow -->

@endsection
