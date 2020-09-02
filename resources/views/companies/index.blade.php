@extends('template.admin_layout')

@section('corpo')

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Empresas</h6>
    </div>

    @include('template.alerts')

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableClientes" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Sigla</th>
                        <th>Data Início</th>
                        <th>Data Término</th>
                        <th>Situação</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->id_company }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->initials }}</td>
                            <td>{{ $company->contract_start }}</td>
                            <td>{{ $company->contract_due }}</td>

                            <td><center><a href="" class="btn btn-success"><i class="fas fa-edit"></i></a></center></td>
                            <td>22</td>
                            <!--<td><center><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveCliente-{{ $cliente->id_cliente }}"><i class="fas fa-trash"></i></button></center></td>-->
                        </tr>

                        <div class="modal fade" id="modalRemoveCliente-{{ $company->id_company }}" tabindex="-1" role="dialog" aria-labelledby="modalRemoveClienteLabel-{{$company->id_company }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalRemoveClienteLabel-{{ $company->id_company }}">Aviso</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deseja confirmar a remoção do cliente: <strong>{{ $company->name }}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="" class="btn btn-primary">Confirmar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div> <!-- fim table-responsible -->
    </div> <!-- fim card-body -->
</div> <!-- fim card shadow -->

<script>
    $(document).ready( function () {
        $('#tableClientes').DataTable({
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
        $('td#telefone_contato').mask('(00) 00000-0000');
    });
</script>

@endsection
