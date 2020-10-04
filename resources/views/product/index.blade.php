@extends('layouts.app')

@section('corpo')

@include('layouts.alerts')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Produtos</h6>
      <a href="{{ route('product.create') }}" class="btn btn-success" style="float: right; margin-top: -15px;">Novo Produto</a>
      <a href="{{ route('category_product.create') }}" class="btn btn-info" style="float: right; margin-top: -15px;margin-right:5px;">Nova Categoria</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableProducts" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Quantidade</th>
                        <th>Porção</th>
                        <th>Situação</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id_product }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->measure }}</td>
                            <td>{{ $product->status }}</td>
                            <td><center><a href="{{ route('user.view-update', ['id' => $product->id_product ]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a></center></td>
                            <td><center><a class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveProduct-{{ $product->id_product }}" ><i class="fas fa-trash" style="color: white;"></i></a></center></td>
                        </tr>
                        
                        <!-- Modal Remove User -->
                        <div class="modal fade" id="modalRemoveProduct-{{ $product->id_product }}" tabindex="-1" role="dialog" aria-labelledby="modalRemoveProductLabel-{{ $product->id_product }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalRemoveTreatmentLabel-{{ $product->id_product }}">Aviso</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deseja confirmar a remoção do produto: <strong>{{ $product->id_product }} - {{ $product->description }}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('user.destroy', ['id' => $product->id_product]) }}" class="btn btn-primary">Confirmar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready( function () {
        $('#tableProducts').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                
            },
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('td#cpf_cnpj').mask('000.000.000-00');
    });
</script>
    
@endsection