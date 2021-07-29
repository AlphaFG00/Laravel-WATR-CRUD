@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar {{ $task->title }}</div>

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



                    <form method="POST" action="{{ route('task.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-form-label text-md-right">Nombre</label>

                            <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $task->title}}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-form-label text-md-right">Descripcion</label>

                            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('password') is-invalid @enderror" autocomplete="description" value="{{ $task->description}}">{{ $task->description}}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="form-check">
                                @if ($task->completed)
                                    <input class="form-check-input" type="checkbox" name="completed" id="completed" value="{{ $task->completed}} checked">
                                @else
                                    <input class="form-check-input" type="checkbox" name="completed" id="completed" value="{{ $task->completed}} ">
                                @endif

                                <label class="form-check-label" for="completed">
                                    Completada?
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
