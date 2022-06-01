@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nova Tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{route('tarefa.store')}}">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label">Tarefa</label>
                          <input type="text" value="{{old('tarefa')}}" class="form-control" name="tarefa">
                          @php
                            // Verifica se existe erro e retorna a mensagem de alerta   
                            if ($errors) {
                               echo $errors->first('tarefa');
                            }  
                          @endphp
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Data limite conclusão</label>
                          <input type="date" class="form-control" name="data_limite_conclusao">
                          @php
                            // Verifica se existe erro e retorna a mensagem de alerta   
                            if ($errors) {
                               echo $errors->first('data_limite_conclusao');
                            }  
                          @endphp
                        </div>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
