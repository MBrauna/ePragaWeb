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

            <!-- Id Usuário -->
            <div class="form-row">
                <label for="tituloWebsite">idUsuário</label>
                <input type="text" class="form-control" id="id_user" name="id_user" value="{{old('id_user', isset($user->id) ? $user->id : '') }}" readonly>
            </div>

            <br/>
    
            <!-- Nome -->
            <div class="form-row">
                <label for="tituloWebsite">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', isset($user->name) ? $user->name : '') }}" required>
            </div>

            <br/>

            <!-- Cpf_cnpj -->
            <div class="form-row">
                <label for="tituloWebsite">CNPJ/CPF</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="{{old('cpf_cnpj', isset($user->cpf_cnpj) ? $user->cpf_cnpj : '') }}" required>
            </div>

            <br/>

            <!-- Email -->
            <div class="form-row">
                <label for="tituloWebsite">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email', isset($user->email) ? $user->email : '') }}">
            </div>

            <br/>

    
            <!-- Senha -->
            <div class="form-row">
                <label for="tituloWebsite">Senha</label>
                <input type="password" class="form-control" id="password" name="password" value="{{old('password', isset($user->password) ? $user->password : '') }}">
            </div>

            <br/>



            <!-- Situação -->
            <!--
            <div class="form-row">
                <label for="tituloWebsite">Situação</label>
                <select class="custom-select mr-sm-2" id="status" name="status">
                    <option value="false" @if(old('status', (isset($user->status) ? $user->status : 'false')) == 'false') selected="selected" @endif>Inativo</option>
                    <option value="true" @if(old('status', (isset($user->status) ? $user->status : 'true')) == 'true') selected="selected" @endif>Ativo</option>
                </select>
            </div>
        -->

            <br/>

            <!-- Salvar -->
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

        </form>
    </div> <!-- fim div card-body -->
</div> <!-- fim card shadow -->

@endsection
