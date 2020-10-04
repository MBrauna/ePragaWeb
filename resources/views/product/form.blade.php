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
                <label for="tituloWebsite">IdProduto</label>
                <input type="text" class="form-control" id="id_product" name="id_product" value="{{old('id_product', isset($product->id_product) ? $product->id_product : '') }}" readonly>
            </div>

            <br/>

            <!-- Descrição -->
            <div class="form-row">
                <label for="tituloWebsite">Nome*</label>
                <input type="text" class="form-control" id="description" name="description" value="{{old('description', isset($product->description) ? $product->description : '') }}" required>
            </div>

            <br/>

            <!-- Categoria Produto -->
            <div class="form-row">
                <label for="tituloWebsite">Categoria*</label>
                <select class="custom-select form-control" id="id_category_product" name="id_category_product">
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id_category_product }}" @if(old('id_category_product', (isset($product->id_category_product) ? $product->id_category_product : '')) == $categorie->id_category_product) selected="selected" @endif > {{ $categorie->description_category}}</option>
                    @endforeach
                </select>
            </div>

            <br/>

            <!-- Quantidade -->
            <div class="form-row">
                <label for="tituloWebsite">Quantidade*</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{old('quantity', isset($product->quantity) ? $product->quantity : '') }}" required>
            </div>

            <br/>

            <!-- Medida -->
            <div class="form-row">
                <label for="tituloWebsite">Unidade de Medida*</label>
                <input type="text" class="form-control" id="measure" name="measure" value="{{old('measure', isset($product->measure) ? $product->measure : '') }}" required>
            </div>

        

            <br/>

            <!-- Situação -->
            <div class="form-row">
                <label for="tituloWebsite">Situação</label>
                <select class="custom-select mr-sm-2" id="status" name="status">
                    <option value="false" @if(old('status', (isset($product->status) ? $product->status : 'false')) == 'false') selected="selected" @endif>Inativo</option>
                    <option value="true" @if(old('status', (isset($product->status) ? $product->status : 'true')) == 'true') selected="selected" @endif>Ativo</option>
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
