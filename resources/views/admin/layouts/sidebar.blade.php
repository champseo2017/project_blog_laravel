<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('admin/dist/img/admin_icon01.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="{{ route('post.index') }}"><i class="fa fa-circle-o"></i>Post</a></li>
            @can('posts.category',Auth::user())

             <li><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Categories</a></li>

            @endcan

             @can('posts.tag',Auth::user())

            <li><a href="{{ route('tag.index') }}"><i class="fa fa-circle-o"></i> Tags</a></li>

            @endcan
            <li><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
            <li><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> Permissions</a></li>
          </ul>
        </li>
       
    <!-- /.sidebar -->
  </aside>