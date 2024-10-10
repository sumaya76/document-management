<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Document Management System</title>
    <style>
         :root {
            --my-color: rgb(119, 49, 49); 
            --my-color: #2d629a;
          
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('/admin_css/img/welcome.jpg'); /* Path to your background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Do not repeat the image */
            color: #333;
        }

        .container {
           
            max-width: 700px;
            margin: 0 auto;
            padding: 40px 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top:300px;
            transition: transform 0.3s; /* Add transition for scaling effect */
        }

        .container:hover {
            transform: scale(1.02); /* Slightly scale up on hover */
        }

        .header {
            
            margin-bottom: 40px;
        }

        h2 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #2d629a;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: #666;
            line-height: 1.5;
        }

        .nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap; /* Allow links to wrap on smaller screens */
        }

        .nav-link {
            text-decoration: none;
            padding: 12px 20px;
            background-color: #2d629a;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s; /* Transition for background and shadow */
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .nav-link:hover {
            background-color: #e63946;
            transform: translateY(-2px); /* Lift effect on hover */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
        }

        .footer {
            margin-top:30rem;
            font-size: 0.9rem;
            color: black;
            text-align: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem; /* Smaller heading on medium screens */
            }

            p {
                font-size: 1.1rem; /* Adjust paragraph size */
            }

            .nav-link {
                padding: 10px 15px; /* Smaller padding on medium screens */
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem; /* Smaller heading on small screens */
            }

            p {
                font-size: 1rem; /* Further adjust paragraph size */
            }

            .nav-link {
                padding: 8px 12px; /* Smaller padding on small screens */
                font-size: 0.9rem; /* Smaller font size */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h2>Welcome to the Document Management System</h2>
            <p>Your secure solution for efficient document management. Seamlessly upload, view, and organize your files with ease, empowering you to focus on what matters most.</p>

            @if (Route::has('login'))
                <nav class="nav">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

       
    </div>
    <footer class="footer">
        <p>&copy; <span id="year"></span> Document Management System. All rights reserved by lami.</p>
    </footer>
    <script>
        // Automatically update the copyright year
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>
