@extends('admin.app')
@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
         <!-- general form elements -->
      <div class="box box-primary">
            <div class="box-header with-border">
            @if(Session::has('error'))
            <div class="alert {{ Session::get('alert-class') }} alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ Session::get('error') }}
            </div>
            @endif
           
              <h3 class="box-title">Update Admin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('user.update',$user->id) }}" method="post" name="tag-admin" onsubmit="return validateFormtag()">
            @csrf
            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="col-lg-offset-3 col-lg-6">
                <div class="form-group">
                  <label for="name">User Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="@if (old('name')){{ old('name') }}@else{{ $user->name }}@endif" placeholder="User Name">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="@if (old('email')){{ old('email') }}@else{{ $user->email }}@endif" placeholder="Email">
                
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" value="@if (old('phone')){{ old('phone') }}@else{{ $user->phone }}@endif" placeholder="Phone">
                
                </div>
                 <div class="form-group">
                  <label for="status">Status</label>
                   <div class="checkbox">
                 <label ><input type="checkbox" name="status" 
                    @if (old('status')==1 || $user->status == 1)
                      checked
                    @endif value="1">Status</label>
                </div>
                </div>
                <div class="form-group">
                <label>Assign Role</label>
                <div class="row">
                 @foreach($roles as $role)
                   <div class="col-lg-3">
                  <div class="checkbox">
                          <label ><input type="checkbox" name="role[]" value="{{ $role->id }}"
                          @foreach ($user->roles as $user_role)
                            @if ($user_role->id == $role->id)
                              checked
                            @endif
                          @endforeach> {{ $role->name }}</label>
                  </div>
                </div>
                @endforeach
                </div>
                </div>
                <div class="form-group">
                <button  type="submit" class="btn btn-primary">Submit</button>
                <a href='{{ route('user.index') }}' class="btn btn-warning">Back</a>
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