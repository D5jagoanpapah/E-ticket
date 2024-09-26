<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Primago Travel - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Set the background image for the body */
        body {
            background: url('img/mekah.jpg') no-repeat center center fixed; /* Background image */
            background-size: cover; /* Cover the entire background */
            color: #ffffff; /* White text color for better readability */
        }

        .bg-gradient-primary {
            background: none; /* Remove the default gradient */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background for readability */
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #800000; /* Maroon button */
            border-color: #800000;
        }

        .btn-primary:hover {
            background-color: #660000; /* Darker maroon on hover */
            border-color: #660000;
        }

        .text-center a {
            color: #800000; /* Maroon links */
        }

        .text-center a:hover {
            color: #660000; /* Darker maroon on hover */
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <!-- Adjusted Card Size -->
            <div class="col-xl-6 col-lg-7 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-4">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- Centered Image at the Top, Made Larger -->
                            <div class="col-12 text-center mb-4">
                                <img src="{{ asset('img/prim.png') }}" alt="Primago Travel Logo" class="img-fluid" style="max-width: 200px;">
                            </div>
                            <div class="col-12">
                                <div class="p-4">
                                    <div class="text-center">
                                    </div>

                                    <!-- Display Error Message if Exists -->
                                    @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif

                                    <!-- Display Success Message if Exists -->
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    <form method="POST" action="{{ route('register.post') }}">
                                        @csrf

                                        <!-- Display Validation Errors if Any -->
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="name" placeholder="Name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" placeholder="Email Address" name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
