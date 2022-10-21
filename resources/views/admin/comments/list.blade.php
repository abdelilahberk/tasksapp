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
            {{-- <a href="{{route("tasks.tichets")}}"></a> --}}
            <h6 class="m-0 font-weight-bold text-primary">Task :{{$taskWithTichetsWithComments->parent_task->title}} -> Ticket : {{$taskWithTichetsWithComments->title}} -> Comments :</h6>
            <a href="{{route("tasks.tickets.comments.create",["task"=>$taskWithTichetsWithComments->parent_task->id,"ticket"=>$taskWithTichetsWithComments->id])}}" class="m-0 font-weight-bold text-white btn btn-primary">Nouveau Comments</a>
        </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>id</th>
                          <th>title</th>
                          <th>temps</th>
                          {{-- <th>Date Debut</th> --}}
                          <th>user</th>
                          <th>Images</th>
                          <th>Modifier</th>
                          
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
                    @if ($taskWithTichetsWithComments->comments->count()>0)
                    @foreach ($taskWithTichetsWithComments->comments as $comment)
                        
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->title}}</td>
                        <td>   {{number_format($comment->timing,2,".","")." H"}}</td>
                        <td>{{$comment->user->name}}</td>

                       <td> {{$comment->images_count ." (Images)"}} </td>
                       {{-- <td> <img class="img-fluid" src="{{ Storage::disk("public")->url($comment->images[0]->url) }}" alt="{{ Storage::url($comment->image->url) }}"> </td> --}}
                            
                        {{-- <td> <img class="img-fluid" src="{{$comment->image->url() }}" alt="{{ Storage::url($comment->image->url) }}"> </td> --}}
                        {{-- <td>{{ $comment->comment_status->name }} </td> --}}
                      
                        <td class="align-middle">
                            <a href="{{ route('tasks.tickets.comments.edit', ['task' => $taskWithTichetsWithComments->parent_task->id,"ticket"=>$taskWithTichetsWithComments->id,"comment"=>$comment->id]) }}"
                                class="text-secondary font-weight-bold " data-toggle="tooltip"
                                data-original-title="Edit user">
                                Modifier 
                            </a>
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