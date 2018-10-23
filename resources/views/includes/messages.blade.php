 @if ($errors->has('email'))
    <div class="alert alert-danger text-center animated fadeIn">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {{ $errors->first('email') }}
            
        </strong>
    </div>
@endif