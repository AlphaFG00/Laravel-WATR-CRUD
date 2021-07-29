@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <h5 class="card-header">
                    <a href="{{ route('task.create') }}" class="btn btn-sm btn-outline-primary">
                        Agregar Tarea
                    </a>
                </h5>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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

                        <!--implementacion grafica del TO DO-->
                    <table class="table table-hover table-borderless">
                        <thead>
                            <th scope="col">
                                Item
                            </th>
                            <th scope="col">

                            </th>
                        </thead>
                        <tbody>

                            @forelse($tasks as $task)
                            <tr>
                                @if ($task->completed)
                                    <td>
                                        <a href="{{ route('task.edit', $task->id) }}" style="color: black" >
                                            <s>
                                                {{ $task->title }}
                                            </s>
                                        </a>
                                    </td>
                                @else
                                <td>
                                    <a href="{{ route('task.edit', $task->id) }}" style="color: black">
                                            {{ $task->title }}
                                    </a>
                                </td>
                                @endif
                                <td>
                                    <a href="{{ route('task.edit', $task->id )}}" class="btn btn-sm btn-outline-success">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="{{ route('task.show', $task->id) }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i>

                                    </a>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td>No hay tareas aun</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
