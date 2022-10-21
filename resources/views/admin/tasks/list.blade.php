@extends('admin.layout.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"></h1>
  {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
      For more information about DataTables, please visit the <a target="_blank"
          href="https://datatables.net">official DataTables documentation</a>.</p> --}}

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div style="display: flex; justify-content: space-between">
            <h6 class="m-0 font-weight-bold text-primary">Tasks</h6>
            <a href="{{route("tasks.create")}}" class="m-0 font-weight-bold text-white btn btn-primary">Nouveau Task</a>
        </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>id</th>
                          <th>Titre</th>
                          {{-- <th>Date Debut</th>
                          <th>Date Fin</th> --}}
                          <th>Type</th>
                          <th>Status</th>
                          <th>Tickets</th>
                          <th>action</th>
                          <th>action</th>
                      </tr>
                  </thead>
                  {{-- <tfoot>
                      <tr>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                      </tr>
                  </tfoot> --}}
                  <tbody>
                    @if ($tasks->count()>0)
                    @foreach ($tasks as $task)
                        
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        {{-- <td>{{ date('d-m-Y', strtotime($task->date_debut)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($task->date_fin)) }} </td> --}}
                        <td>{{$task->task_type->name}}</td>
                        <td>{{$task->task_status->name}}</td>
                        <td class="align-middle">
                            <a href="{{ route('tasks.tickets.index', ['task' => $task->id]) }}"
                                class="text-secondary font-weight-bold " data-toggle="tooltip"
                                data-original-title="Edit user">
                                ({{$task->sub_tasks_count}}) Tickets 
                            </a>
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
                                class="btn btn-info text-secondary font-weight-bold text-white" data-toggle="tooltip"
                                data-original-title="Edit user">
                                Modifier
                            </a>
                        </td>
                        <td class="align-middle">
                            <form action="{{route("tasks.destroy",["task"=>$task->id])}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                       
                        </td>
                    
                    </tr>
                    @endforeach

                    @else
                    <tr style="text-align: center;">
                        <td colspan="7">La list est vide</td>
                      
                    </tr>
                        
                    @endif
                
                      
                  </tbody>
              </table>
          </div>
      </div>
  </div>
    
@endsection