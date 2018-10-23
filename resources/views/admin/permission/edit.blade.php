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
              <h3 class="box-title">Permissions</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('permission.update',$permission->id) }}" method="post">
            @csrf
            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="col-lg-offset-3 col-lg-6">
                <div class="form-group">
                  <label for="name">Permissions</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Permissions" value="{{ $permission->name }}">
                </div>
                <div class="form-group">
                <label for="for">Permission for</label>
                <select name="for" id="for" class="form-control">
                <option @if(old('for',$permission->for) == 'post') selected @endif >
                  post
                </option>
                <option @if(old('for',$permission->for) == 'user') selected @endif >
                  user
                </option>
                <option @if(old('for',$permission->for) == 'other') selected @endif >
                  other
                </option>
                </select>
                </div>
                <div class="form-group">
                <button  type="submit" class="btn btn-primary">Submit</button>
                <a href='{{ route('permission.index') }}' class="btn btn-warning">Back</a>
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