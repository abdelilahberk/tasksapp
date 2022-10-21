@extends('admin.layout.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
      For more information about DataTables, please visit the <a target="_blank"
          href="https://datatables.net">official DataTables documentation</a>.</p> --}}
    {{-- <p class="mb-4">titre de task : {{$task->title}}</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="display: flex; justify-content: space-between">
                <h6 class="m-0 font-weight-bold text-primary">Task : {{ $task->title }} -> Tickets</h6>
                <a href="{{ route('tasks.tickets.create', ['task' => $task->id]) }}"
                    class="m-0 font-weight-bold text-white btn btn-primary">Nouveau Ticket</a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Titre</th>
                            <th>timing</th>
                            {{-- <th>Date Debut</th>
                          <th>Date Fin</th> --}}
                            {{-- <th>Type</th>
                          <th>Status</th> --}}
                            <th>Comments</th>
                            <th>create par </th>
                            <th>users affecte</th>
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
                        @if ($task->sub_tasks->count() > 0)
                            @foreach ($task->sub_tasks as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>
                                        @php
                                            $minuts = 0;
                                            $hours = 0;
                                            foreach ($ticket->comments as $comment) {
                                                $array = explode('.', $comment->timing);
                                                $hours += intval($array[0]);
                                                $minuts += intval($array[1]);
                                                // dump($array[0]);
                                            }
                                            $hours = intval($hours) + intval($minuts) / 60;
                                            $minuts = intval(intval($minuts) % 60);
                                        @endphp


                                        {{ intval($hours).":".intval($minuts)." H"}}


                                    </td>
                                    {{-- <td>{{ date('d-m-Y', strtotime($task->date_debut)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($task->date_fin)) }} </td> --}}
                                    {{-- <td>{{$task->task_type->name}}</td>
                        <td>{{$task->task_status->name}}</td> --}}


                                    <td class="align-middle">
                                        <a href="{{ route('tasks.tickets.comments.index', ['task' => $task->id, 'ticket' => $ticket->id]) }}"
                                            class="text-secondary font-weight-bold " data-toggle="tooltip"
                                            data-original-title="Edit user">
                                            ({{ $ticket->comments_count }})
                                            Comments
                                        </a>
                                    </td>
                                    <td>{{ $ticket->user->name }}</td>

                                    

                                    <td>
                                        @foreach ($ticket->users as $user)
                                            @if ($loop->last)
                                                <span> {{ $user->name }}</span>
                                            @else
                                                <span> {{ $user->name . ' -- ' }}</span>
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="align-middle">
                                        <a href="{{ route('tasks.tickets.edit', ['task' => $task->id, 'ticket' => $ticket->id]) }}"
                                            class="text-secondary font-weight-bold " data-toggle="tooltip"
                                            data-original-title="Edit user">
                                            Modifier la ticket
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
