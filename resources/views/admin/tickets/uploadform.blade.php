
<div class="card-body">
    {{-- <form action="{{ route('tasks.tickets.update',["task"=>$ticket->parent_task->id,"ticket"=>$ticket->id]) }}" method="POST">
        @csrf
        @method("PUT") --}}
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Image(s)</label>
                @if ($errors->has('images'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('images') }}</span>
                @endif

                <input class="form-control" name="images[]" multiple type="file" 
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
    {{-- </form> --}}
</div>

<div class="card-header py-3">
    <div style="display: flex; justify-content: space-between">
        <h6 class="m-0 font-weight-bold text-primary">Les Images</h6>
        {{-- <button type="submit" class="m-0 font-weight-bold text-white btn btn-success">Enregistre</button> --}}
    </div>
 
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>date Uploade</th>
                    <th>image </th>
                    {{-- <th>Date Debut</th> --}}
                  
                    <th>supprimer</th>
                    
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
              @if ($ticket->images->count()>0)
              @foreach ($ticket->images as $image)
                  
              <tr>
                  <td>{{$image->id}}</td>
                  <td>{{$image->created_at}}</td>
                  <td> <a  href="{{ $image->url()}}" target="_blank" > <img width="200px" class="img-fluid" src="{{ $image->url()}}" alt=""> </a></td>

                
                  <td class="align-middle">
                      <a href="{{ route('tasks.tickets.destroy', ['task' => $ticket->parent_task->id,"ticket"=>$ticket->id,"image"=>$image->id]) }}"
                          class="text-secondary font-weight-bold " data-toggle="tooltip"
                          data-original-title="Edit user">
                          supprimer
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