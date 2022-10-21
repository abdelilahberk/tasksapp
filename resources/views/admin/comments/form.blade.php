@csrf
{{-- @method('PUT') --}}
<div class="card-header py-3">
    <div style="display: flex; justify-content: space-between">
        <h6 class="m-0 font-weight-bold text-primary">Comment</h6>
        <button type="submit" class="m-0 font-weight-bold text-white btn btn-success">Enregistre</button>
    </div>
</div>
<div class="card-body">

    <div class="row">
        <div class="row mb-4">


            <div class="col-md-6">
                <div class="form-group">
                    <span style="color: red; font-weight: 500;">*</span>
                    <label for="example-text-input" class="form-control-label">Titre</label>
                    @if ($errors->has('name'))
                        <span style="color: red; font-weight: 300;">{{ $errors->first('name') }}</span>
                    @endif

                    <input class="form-control" name="name" type="text"
                        value="{{ old('name', $comment->title ?? null) }}" onfocus="focused(this)"
                        onfocusout="defocused(this)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <span style="color: red; font-weight: 500;">*</span>
                    <label for="example-text-input" class="form-control-label">Timing</label>
                    @if ($errors->has('timing'))
                        <span style="color: red; font-weight: 300;">{{ $errors->first('timing') }}</span>
                    @endif
                    <input class="form-control" type="text" name="timing"
                        value="{{ old('timing', $comment->timing ?? null) }}">

                </div>
            </div>
        </div>
        <div class="row mb-4">


            <div class="col-md-6">
                <div class="form-group">
                    <span style="color: red; font-weight: 500;">*</span>
                    <label for="example-text-input" class="form-control-label">Description</label>
                    @if ($errors->has('description'))
                        <span style="color: red; font-weight: 300;">{{ $errors->first('description') }}</span>
                    @endif

                    <textarea class="form-control" name="description" name="" id="" cols="30" rows="10">{{ old('description', $comment->description ?? null) }}</textarea>

                </div>
            </div>

        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <span style="color: red; font-weight: 500;">*</span>
                    <label for="example-text-input" class="form-control-label">Image</label>
                    @if ($errors->has('images'))
                        <span style="color: red; font-weight: 300;">{{ $errors->first('images') }}</span>
                    @endif

                    <input class="form-control" multiple name="images[]" type="file" value="{{ old('images') }}"
                        onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
            </div>
        </div>



    </div>

</div>


@if (isset($comment))
    
 
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
              @if ($comment->images->count()>0)
              @foreach ($comment->images as $image)
                  
              <tr>
                  <td>{{$image->id}}</td>
                  <td>{{$image->created_at}}</td>
                  <td> <a  href="{{ $image->url()}}" target="_blank" > <img width="200px" class="img-fluid" src="{{ $image->url()}}" alt=""> </a></td>

                
                  <td class="align-middle">
                      <a href="{{ route('tasks.tickets.comments.destroy', ['task' => $comment->task->parent_task->id,"ticket"=>$comment->task->id,"comment"=>$comment->id]) }}"
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
@endif
