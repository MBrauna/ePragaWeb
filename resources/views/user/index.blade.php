@extends('layouts.app')

@section('corpo')

@include('layouts.alerts')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Relação de Usuários</h6>
      <a href="http://" class="btn btn-success" style="float: right; margin-top: -15px;">Novo Usuário</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableUsers" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Cpf</th>
                        <th>Email</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $itemUser)
                        <tr>
                            <td>{{ $itemUser->id }}</td>
                            <td>{{ $itemUser->name }}</td>
                            <td id="cpf_cnpj">{{ $itemUser->cpf_cnpj }}</td>
                            <td>{{ $itemUser->email }}</td>
                            <td><center><a href="http://" class="btn btn-success"><i class="fas fa-edit"></i></a></center></td>
                            <td><center><a href="http://" class="btn btn-danger"><i class="fas fa-trash"></i></a></center></td>
                        </tr>
                    @empty
                        
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready( function () {
        $('#tableUsers').DataTable({
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