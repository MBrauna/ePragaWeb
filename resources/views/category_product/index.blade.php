@extends('layouts.app')

@section('corpo')

@include('layouts.alerts')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Categorias</h6>
      <a href="{{ route('category_product.create') }}" class="btn btn-success" style="float: right; margin-top: -15px;">Nova Categoria</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableCategory" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Situação</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id_category_product }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->status }}</td>
                            <td><center><a href="{{ route('user.view-update', ['id' => $category->id_category_product ]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a></center></td>
                            <td><center><a class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveProduct-{{ $category->id_category_product }}" ><i class="fas fa-trash" style="color: white;"></i></a></center></td>
                        </tr>
                        
                        <!-- Modal Remove User -->
                        <div class="modal fade" id="modalRemoveProduct-{{ $category->id_category_product }}" tabindex="-1" role="dialog" aria-labelledby="modalRemoveProductLabel-{{ $category->id_category_product }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalRemoveTreatmentLabel-{{ $category->id_category_product }}">Aviso</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deseja confirmar a remoção do produto: <strong>{{ $category->id_category_product }} - {{ $category->description }}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('user.destroy', ['id' => $category->id_category_product]) }}" class="btn btn-primary">Confirmar</a>
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
        $('#tableCategory').DataTable({
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