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
            <input type="hidden" name="id_company" id="id_company" value="{{old('id_company', isset($company->id_company) ? $company->id_company : '') }}">

            <!-- Razão Social -->
            <div class="form-row">
                <label for="tituloWebsite">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', isset($company->name) ? $company->name : '') }}" required>
            </div>

            <br/>

            <!-- Sigla -->
            <div class="form-row">
                <label for="tituloWebsite">Sigla</label>
                <input type="text" class="form-control" id="initials" name="initials" value="{{old('initials', isset($company->initials) ? $company->initials : '') }}" maxlength="3" required>
            </div>

            <br/>


            <!-- Início Contrato -->
            <div class="form-row">
                <label for="tituloWebsite">Início Contrato</label>
                <input type="date" class="form-control" id="contract_start" name="contract_start" value="{{old('contract_start', isset($company->contract_start) ? $company->contract_start : '') }}" required>
            </div>

            <br/>

            <!-- Término Contrato -->
            <div class="form-row">
                <label for="tituloWebsite">Término Contrato</label>
                <input type="date" class="form-control" id="contract_due" name="contract_due" value="{{old('contract_due', isset($company->contract_due) ? $company->contract_due : '') }}">
            </div>

            <br/>

            <!-- Situação -->
            <div class="form-row">
                <label for="tituloWebsite">Situação</label>
                <select class="custom-select mr-sm-2" id="status" name="status">
                    <option value="false" @if(old('status', (isset($company->status) ? $company->status : 'false')) == 'false') selected="selected" @endif>Inativo</option>
                    <option value="true" @if(old('status', (isset($company->status) ? $company->status : 'true')) == 'true') selected="selected" @endif>Ativo</option>
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
