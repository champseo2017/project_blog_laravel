@extends('admin.app')
@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
         <!-- general form elements -->
@if(Session::has('message'))
<div class="alert {{ Session::get('alert-class') }} alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
{{ Session::get('message') }}
</div>
@endif
@if(Session::has('message_unique'))
<div class="alert {{ Session::get('alert-class') }} alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
{{ Session::get('message_unique') }}
</div>
@endif

      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Roles</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('role.store') }}" method="post">
            @csrf
              <div class="box-body">
                <div class="col-lg-offset-3 col-lg-6">
                <div class="form-group">
                <div id="validation-1"></div>
                  <label for="name">Role Title</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Role Title">
                </div>
                <div class="row">
                <div class="col-lg-4">
                <label for="name">Post Permissions</label>
                @foreach($permissions as $permission)
                @if($permission->for == 'post')
                 <div class="checkbox">
                <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                </div>

                @endif

                @endforeach
               

                </div>
                <div class="col-lg-4">
                <label for="name">User Permissions</label>

                @foreach($permissions as $permission)
                @if($permission->for == 'user')
                 <div class="checkbox">
                <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                </div>

                @endif

                @endforeach
              

                </div>
                 <div class="col-lg-4">
                <label for="name">Other Permissions</label>

                 @foreach($permissions as $permission)
                @if($permission->for == 'other')
                 <div class="checkbox">
                <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                </div>

                @endif

                @endforeach
              

                </div>
                </div>
                <div class="form-group">
                <button  type="submit" class="btn btn-primary">Submit</button>
                <a href='{{ route('role.index') }}' class="btn btn-warning">Back</a>
                </div>
                </div>
              </div>
              
            </form>
          </div>
          <!-- /.box -->
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection