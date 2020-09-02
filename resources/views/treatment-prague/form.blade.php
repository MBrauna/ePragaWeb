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
            <input type="hidden" name="id_treatment" id="id_treatment" value="{{old('id_treatment', isset($treatment->id_treatment) ? $treatment->id_treatment : '') }}">

            <!-- Tipo Praga -->
            <div class="form-row">
                <label for="tituloWebsite">Tipo Praga</label>
                <select class="custom-select form-control" id="id_prague" name="id_prague">
                    @foreach ($pragues as $prague)
                        <option value="{{ $prague['id_prague'] }}" @if(old('id_prague', (isset($prague->id_prague) ? $conta->id_prague : '')) == $prague['id_prague']) selected="selected" @endif > {{ $prague['id_prague'] }}</option>
                    @endforeach
                </select>
            </div>

            <br/>

            <!-- Nome -->
            <div class="form-row">
                <label for="tituloWebsite">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', isset($treatment->name) ? $prague->name : '') }}" required>
            </div>

            <br/>

            <!-- Descrição -->
            <div class="form-row">
                <label for="tituloWebsite">Descrição</label>
                <input type="text" class="form-control" id="description" name="description" value="{{old('description', isset($treatment->description) ? $treatment->description : '') }}">
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
