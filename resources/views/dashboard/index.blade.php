@extends('layouts.app')

@section('corpo')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Teste</h1>
    </div>

    @include('layouts.alerts')

    <br/>

    <div class="row">
        <!-- Card Name Rifas -->

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body margin-bottom-card-panel">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">1</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
              <br/>
              <div class="row">
                <a href="" class="btn btn-primary btn-block">1</a>
              </div>
            </div>
          </div>
        </div> <!-- fim col-xl-3 col-md-6 mb-4 -->


    </div> <!-- fim div row -->

@endsection