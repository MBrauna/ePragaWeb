@extends('layouts.app')

@section('corpo')

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Solicitações - Atendimento</h6>
      <div class="float-right btn-new-form">
          <a href="{{ route('subsidiary.create') }}" class="btn btn-success">Nova Solicitação</a>
      </div>
    </div>

    @include('layouts.alerts')

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableTreatment" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Endereço</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Situação</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subsidiarys as $subsidiary)
                        <tr>
                            <td>{{ $subsidiary->id_subsidiary }}</td>
                            <td>{{ $subsidiary->company_name }}</td>
                            <td>{{ $subsidiary->name }}</td>
                            <td>{{ $subsidiary->description }}</td>
                            <td>{{ $subsidiary->address }}</td>
                            <td>{{ $subsidiary->latitude }}</td>
                            <td>{{ $subsidiary->longitude }}</td>
                            <td> @if($subsidiary->status == true) Ativo @elseif($subsidiary->status == false) Inativo @else  @endif </td>
                            <td><center><a href="{{ route('subsidiary.view-update', ['id' => $subsidiary->id_subsidiary ]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a></center></td>
                            <td><center><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveSubsidiary-{{ $subsidiary->id_subsidiary }}"><i class="fas fa-trash"></i></button></center></td>
                        </tr>

                        <div class="modal fade" id="modalRemoveSubsidiary-{{ $subsidiary->id_subsidiary }}" tabindex="-1" role="dialog" aria-labelledby="modalRemoveSubsidiaryLabel-{{ $subsidiary->id_subsidiary }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalRemoveSubsidiaryLabel-{{ $subsidiary->id_subsidiary }}">Aviso</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deseja confirmar a remoção da subsidiária: <strong>{{ $subsidiary->id_subsidiary }} - {{ $subsidiary->name }}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('subsidiary.destroy', ['id' => $subsidiary->id_subsidiary]) }}" class="btn btn-primary">Confirmar</a>
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
        $('#tableTreatment').DataTable({
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
