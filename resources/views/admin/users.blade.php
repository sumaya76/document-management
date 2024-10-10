<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
   
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
         
                <h2>Manage Users</h2>
            
                @if($users->isEmpty())
                    <p>No users found.</p>
                @else
                <ul class="list-group mt-3">
                  @foreach($users as $user)
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                          {{ $user->name }} {{ $user->phone }}  {{ $user->address }} ({{ $user->email }}) - Role: {{ ucfirst($user->usertype) }}
                          <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                                  {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                              </button>
                          </form>
                      </li>
                  @endforeach
              </ul>
                @endif
           
            </div>
          </div>
        </div>

 

    @include('admin.footer') 

    <!-- JavaScript files-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('/admin_css/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admin_css/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admin_css/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admin_css/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admin_css/js/front.js') }}"></script> 
  </body>
</html>
