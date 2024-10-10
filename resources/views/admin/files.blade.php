<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        :root {
            --my-color: rgb(119, 49, 49); 
            --my-color: #2d629a;
          
        }
        .head1{
          text-align: center;
         
        }
      .list-group-item {
        transition: background-color 0.3s, transform 0.3s;
      }
      .list-group-item:hover {
        background-color: #2d629a; 
        transform: scale(1.02); 
      }
      .btn {
        margin-left: 10px; 
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h2 class="head1">All Uploaded Files</h2>
          <ul class="list-group mt-3">
            @foreach($files as $file)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <strong>{{ $file->filename }}</strong> - Uploaded by: {{ $file->user->name }}
                </div>
                <div>
                  <a href="{{ asset('storage/' . $file->file_path) }}" download class="btn btn-info">Download</a>
                  <form action="{{ route('admin.deleteFile', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file permanently?')">Delete</button>
                  </form>
                </div>
              </li>
            @endforeach
          </ul>
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
