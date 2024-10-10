<div class="d-flex align-items-stretch">
  <!-- Sidebar Navigation-->
    <nav id="sidebar">
     <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
     <div class="title">
        <br>
        <h1 class="h5">
          {{ Auth::user()->name }} 
      </h1>
      
      <p >{{ Auth::user()->email }}</p> 
      <p>{{ Auth::user()->phone }}</p> 
      <p>{{ Auth::user()->address }}</p>
    </div>
</div>
        <!-- Sidebar Navidation Menus-->
        <ul class="list-unstyled">
                <li><a href="{{url('/user/dashboard')}}"> <i class="fas fa-home"></i>Home </a></li>
                <li ><a href="{{url('file_manage')}}"> <i class="fas fa-file"></i>File Manage</a></li>
      </nav>