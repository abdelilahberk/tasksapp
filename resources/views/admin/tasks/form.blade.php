@csrf
{{-- @method('PUT') --}}


<div class="card-body">

    <div class="row mb-3">
        <div class="row">

        
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Nom De Task</label>
                @if ($errors->has('name'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('name') }}</span>
                @endif

                <input class="form-control" name="name" type="text" value="{{ old('name',$task->title ?? null) }}"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div>
    </div>
    <div class="row">

    
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Status</label>
                @if ($errors->has('task_status_id'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('task_status_id') }}</span>
                @endif

                <select name="task_status_id" class="form-control" id="">
                    @if ($task_status->count() > 0)
                        @foreach ($task_status as $task_statu)
                            <option {{ old('task_status_id',$task->task_status_id ?? null) == $task_statu->id ? 'selected' : '' }}
                                value="{{ $task_statu->id }}">{{ $task_statu->name }}</option>
                        @endforeach
                    @else
                        <option value="">Vide</option>
                    @endif


                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Type</label>
                @if ($errors->has('task_type_id'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('task_type_id') }}</span>
                @endif

                <select name="task_type_id" class="form-control" id="">
                    @if ($task_types->count() > 0)
                        @foreach ($task_types as $task_type)
                            <option {{ old('task_type_id',$task->task_type_id ?? null) == $task_type->id ? 'selected' : '' }}
                                value="{{ $task_type->id }}">{{ $task_type->name }}</option>
                        @endforeach
                    @else
                        <option value="">Vide</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
        {{-- <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Date Debut</label>
                @if ($errors->has('date_debut'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('date_debut') }}</span>
                @endif

                <input class="form-control" name="date_debut" type="date" value="{{ old('date_debut') }}"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div> --}}
        {{-- <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Date Fin</label>
                @if ($errors->has('date_fin'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('date_fin') }}</span>
                @endif

                <input class="form-control" name="date_fin" type="date" value="{{ old('date_fin') }}"
                    onfocus="focused(this)" onfocusout="defocused(this)">
            </div>
        </div> --}}
 
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <span style="color: red; font-weight: 500;">*</span>
                <label for="example-text-input" class="form-control-label">Description</label>
                @if ($errors->has('description'))
                    <span style="color: red; font-weight: 300;">{{ $errors->first('description') }}</span>
                @endif


                    <textarea class="form-control" name="description" name="" id="" cols="30" rows="10">{{ old('description',$task->description ?? null) }}</textarea>
            </div>
        </div>
        

    </div>

</div>
