@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Eliminar {{ $task->title }}</div>

                <h5 class="card-header">
                    <a href="{{ route('task.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-arrow-left"></i>Regresar
                    </a>
                </h5>

                <div class="card-body">
                    <!--Manejo de error o confirmacion -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('task.destroy', $task->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <h4 class="text-center">
                                    Eliminar {{$task->title}} ?
                                </h4>
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Si
                                </button>
                                <a href="{{ route('task.index') }}" class="btn btn-info">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
