@extends('admin.layout.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
      For more information about DataTables, please visit the <a target="_blank"
          href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="{{ route('tasks.tickets.comments.update',["task"=>$comment->task->parent_task->id,"ticket"=>$comment->task->id,"comment"=>$comment->id]) }}" method="POST" enctype="multipart/form-data">
            @method("PUT")
            @include('admin.comments.form')
        </form>
    </div>
@endsection
