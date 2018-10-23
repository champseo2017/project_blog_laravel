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
           
              <h3 class="box-title">Add Admin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('user.store') }}" method="post" name="tag-admin" onsubmit="return validateFormtag()">
            @csrf
              <div class="box-body">
                <div class="col-lg-offset-3 col-lg-6">
                <div class="form-group">
                  <label for="name">User Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="User Name">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Confirm Password</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                </div>
                 <div class="form-group">
                  <label for="status">Status</label>
                   <div class="checkbox">
                 <label><input type="checkbox" name="status" value="1" @if (old('status') == 1)

                 checked
                 
                 
                 @endif >Status</label>
                </div>
                </div>
                <div class="form-group">
                <label>Assign Role</label>
                <div class="row">
                 @foreach($roles as $role)
                   <div class="col-lg-3">
                 <div class="checkbox">
                 <label><input type="checkbox" name="role[]" value="{{ $role->id }}">{{  $role->name }}</label>
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