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

            <!-- idProduto -->
            <div class="form-row">
                <label for="tituloWebsite">IdCategoria</label>
                <input type="text" class="form-control" id="id_category_product" name="id_category_product" value="{{old('id_category_product', isset($category_product->id_category_product) ? $category_product->id_category_product : '') }}" readonly>
            </div>

            <br/>

            <!-- Descrição -->
            <div class="form-row">
                <label for="tituloWebsite">Nome*</label>
                <input type="text" class="form-control" id="description" name="description" value="{{old('description', isset($category_product->description) ? $category_product->description : '') }}" required>
            </div>

            <br/>

            <!-- Situação -->
            <div class="form-row">
                <label for="tituloWebsite">Situação</label>
                <select class="custom-select mr-sm-2" id="status" name="status">
                    <option value="false" @if(old('status', (isset($category_product->status) ? $category_product->status : 'false')) == 'false') selected="selected" @endif>Inativo</option>
                    <option value="true" @if(old('status', (isset($category_product->status) ? $category_product->status : 'true')) == 'true') selected="selected" @endif>Ativo</option>
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
