@extends('admin.layout.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
      For more information about DataTables, please visit the <a target="_blank"
          href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="{{ route('tasks.update',["task"=>$task->id]) }}" method="POST">
            @method("PUT")
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between">
                    <h6 class="m-0 font-weight-bold text-primary">Task Modifier</h6>
                    <button type="submit" class="m-0 font-weight-bold text-white btn btn-success">Enregistre</button>
                </div>
            </div>
            @include('admin.tasks.form')
        </form>
    </div>
@endsection
