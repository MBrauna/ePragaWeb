@extends('layouts.app')

@section('corpo')

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tratamentos de Pragas</h6>
      <div class="float-right btn-new-form">
          <a href="{{ route('treatment.create') }}" class="btn btn-success">Novo Tratamento</a>
      </div>
    </div>

    @include('layouts.alerts')

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableTreatment" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Tipo Praga</th>
                        <th>Descrição</th>
                        <th>Situação</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($treatments as $treatment)
                        <tr>
                            <td>{{ $treatment->id_treatment }}</td>
                            <td>{{ $treatment->name }}</td>
                            <td>{{ $treatment->type_prague }}</td>
                            <td>{{ $treatment->description }}</td>
                            <td> @if($treatment->status == true) Ativo @elseif($treatment->status == false) Inativo @else  @endif </td>
                            <td><center><a href="{{ route('treatment.view-update', ['id' => $treatment->id_prague ]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a></center></td>
                            <td><center><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveTreatment-{{ $treatment->id_prague }}"><i class="fas fa-trash"></i></button></center></td>
                        </tr>

                        <div class="modal fade" id="modalRemoveTreatment-{{ $treatment->id_treatment }}" tabindex="-1" role="dialog" aria-labelledby="modalRemoveTreatmentLabel-{{ $treatment->id_treatment }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalRemoveTreatmentLabel-{{ $prague->id_prague }}">Aviso</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deseja confirmar a remoção da praga: <strong>{{ $treatment->id_treatment }} - {{ $treatment->name }}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('treatment.destroy', ['id' => $treatment->id_treatment]) }}" class="btn btn-primary">Confirmar</a>
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
