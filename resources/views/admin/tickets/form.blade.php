@csrf
{{-- @method('PUT') --}}


<div class="card-body">

    <div class="row mb-3">
        <div class="row">
 
        
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Nom De ticket</label>
                @if ($errors->has('ticket_name'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('ticket_name') }}</span>
                @endif

                <input class="form-control" name="ticket_name" type="text" value="{{ old('ticket_name',$ticket->title ?? null) }}"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
    </div>
    <div class="row">

    
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Users</label>
                @if ($errors->has('user_id'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('user_id') }}</span>
                @endif

                <select name="user_id[]" multiple class="form-control" id="">
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <option {{ isset($ticket) ? ( $ticket->users->contains("id",$user->id)  ? 'selected' : '')  :(old("user_id") == $user->id ? "selected" : "") }}
                                value="{{ $user->id }}">{{ $user->name }}</option>
                            {{-- <option {{ old('user_id',) == $user->id ? 'selected' : '' }}
                                value="{{ $user->id }}">{{ $user->name }}</option> --}}
                        @endforeach
                    @else
                        <option value="">Vide</option>
                    @endif


                </select>
            </div>
        </div>
      
    </div>
    

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Description</label>
                @if ($errors->has('description'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('description') }}</span>
                @endif
                    <textarea class="form-control" name="description" name="" id="" cols="30" rows="10">{{ old('description',$ticket->description ?? null) }}</textarea>
            </div> 
        </div>
        

    </div>

</div>


