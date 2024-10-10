<!DOCTYPE html>
<html>
<head> 
    @include('user.css')
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    
        .page-content {
            padding: 20px;
            margin: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    
        .page-header h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }
    
        .card {
            border-radius: 8px;
            margin-bottom: 20px;
        }
    
        .card-header {
            background-color: #2d629a;
            color: white;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
    
        .card-body {
            padding: 20px;
        }
    
        .form-group {
            margin-bottom: 15px;
        }
    
        .form-control {
            background-color: #ffffff;
            color: #343a40;
        }
    
        .form-control option {
            background-color: #ffffff;
            color: #343a40;
        }
    
        .form-control:focus {
            border-color: #2d629a;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    
        .btn {
            border-radius: 4px;
        }
    
        .table {
            width: 100%;
            margin-top: 20px;
        }
    
        .table th,
        .table td {
            padding: 12px;
            text-align: left;
        }
    
        .table th {
            background-color: #2d629a;
            color: white;
        }
    
        .text-danger {
            font-size: 0.9em;
            color: #dc3545;
        }
    
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.9em;
        }
    
        @media (max-width: 768px) {
            .page-content {
                margin: 10px;
            }
    
            .table th,
            .table td {
                padding: 8px;
            }
        }
    </style>
    
</head>
<body>
    @include('user.header')
    @include('user.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="my-4"> User File Management </h2>

                <!-- File Upload Form -->
                <div class="card mb-4">
                    <div class="card-header">Upload a New File</div>
                    <div class="card-body">
                        <form action="{{ route('user.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Choose File</label>
                                <input type="file" name="file" class="form-control" required>
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="category">Select Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">-- Select a Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Upload File</button>
                        </form>
                    </div>
                </div>

                <!-- List of Uploaded Files -->
                <h3 class="my-4">Your Uploaded Files</h3>
                @if($documents->isEmpty())
                    <p>No files uploaded yet.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Category</th>
                                <th>Uploaded At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{ $document->filename }}</td>
                                    <td>{{ $document->category->category_name }}</td>
                                    <td>{{ $document->updated_at }}</td>
                                    <td>
                                         <!-- View File -->
                                      <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-info btn-sm">
                                        View
                                        </a>
                                        <!-- Download File -->
                                        <a href="{{ asset('storage/' . $document->file_path) }}" download class="btn btn-success btn-sm">
                                            Download
                                        </a>

                                        <!-- Delete File -->
                                        <form action="{{ route('user.delete', $document->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this file?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>

    @include('user.footer') 

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
