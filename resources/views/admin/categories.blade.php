<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
         :root {
            --my-color: rgb(119, 49, 49); 
            --my-color: #2d629a;
          
        }
        @media (max-width: 768px) {
            .page-header h2 {
                font-size: 1.5rem;
            }
            .list-group-item {
                flex-direction: column;
                align-items: flex-start;
            }
            .list-group-item .btn {
                width: 100%;
                margin-top: 0.5rem;
            }
        }

        .page-content {
            padding: 20px;
        }
       .head1{
        text-align: center;
       }
        .list-group-item {
            transition: all 0.3s ease;
            background-color: rgb(119, 49, 49);
        }

        .list-group-item:hover {
            background-color: #2d629a;
            color: white;
            transform: scale(1.05);
        }

       
        .list-group-item:hover .btn-warning, 
        .list-group-item:hover .btn-danger {
            background-color: #ffcc00;
            color: black;
        }
        
        .list-group-item:hover .btn-danger {
            background-color: #ff4c4c;
            color: black;
        }

        .list-group-item:hover .btn {
            color: black;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="head1">Manage Categories</h2>

                @if(session('success'))
                    <script>
                        swal("Success", "{{ session('success') }}", "success");
                    </script>
                @endif

                <form action="{{ url('/admin/categories') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Category Name:</label>
                        <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" style="background-color: rgb(119, 49, 49);  color: #fff;">
                        Add Category
                      </button>
                </form>

                <h3 class="mt-5">Existing Categories</h3>
                <ul class="list-group mt-3">
                    @foreach($categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $category->category_name }}
                            <div>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal-{{ $category->id }}">
                                    Edit
                                </button>
                                <form action="{{ url('/admin/categories/'.$category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </li>

                        <div class="modal fade" id="editModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $category->id }}">Edit Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('/admin/categories/'.$category->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="category_name">Category Name:</label>
                                                <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('/admin_css/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admin_css/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admin_css/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admin_css/js/front.js') }}"></script>
</body>
</html>
