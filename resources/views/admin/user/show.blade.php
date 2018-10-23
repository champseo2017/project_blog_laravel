@extends('admin.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('main-content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <!-- @include('admin.layouts.pageheader') -->
      Manage User and Roles
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Manage Tag</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        @if ($message = Session::get('message'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif

        
        <div class="box-header with-border">
          <h3 class="box-title">Users</h3>
          <a class="col-lg-offset-5 btn btn-success" href="{{ route('user.create') }}">Add New</a>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Assigned Roles</th>
                   <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                 <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $user->name }}</td>
                  <td>
                  <?php
                  $obj_rtrim ='';
                  foreach($user->roles as $key => $role){
                    
                      $obj_rtrim .= $role->name.','; 
                   
                  }
                   echo rtrim($obj_rtrim, ',');
                  ?>
                   </td>
                   <td>{{ $user->status? 'Active': 'Not Active' }}</td>
                  <td><a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning">Edit</a></td>
                  <td>
                    <a class="btn btn-danger" href="#" onclick="
                    if(confirm('Are you sure, You Want to delete this?'))
                    {
                      event.preventDefault(); 
                      document.getElementById('delete-form-{{ $user->id }}').submit();
                    }else{
                      event.preventDefault();
                    }">
                    Delete
                  </a>
                      <form action="{{ route('user.destroy',$user->id) }}" method="POST" id="delete-form-{{ $user->id }}" style="display: none;">
                          @csrf
                          {{ method_field('DELETE') }}
                       </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Assigned Roles</th>
                <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box-body -->
      
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('footerSection')
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $('#example1').DataTable();
  });
</script>

@endsection
