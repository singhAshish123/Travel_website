<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="uploads/favicon.png">

    <title>Travel Along</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    @include('admin.layout.styles')

    @include('admin.layout.scripts')

    <style>
        /* Add your custom styles here */
        /* Example styles for the header and footer */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Source Sans Pro', sans-serif; /* Apply a custom font */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            
        }

        header h1 {
            margin: 0;
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>

<body>
    @include('front.header')

    <div id="app">
        <div class="main-wrapper">
            <section class="section">
                <div class="container container-login">
                    <div class="row">
                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary border-box">
                                <div class="card-header card-header-auth">
                                    <h4 class="text-center">User Registration</h4>
                                </div>
                                <div class="card-body card-body-auth">
                                    <form method="POST" action="{{ route('registerSubmit') }}" enctype="multipart/form-data">
                                        @csrf
                                        @if (session()->get('success'))
                                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                                        @endif
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Your name" autocomplete="username"
                                                value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if (session()->get('error'))
                                            <div class="text-danger">{{ session()->get('error') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                name="email" placeholder="Email Address" autocomplete="username"
                                                value="{{ old('email') }}">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if (session()->get('error'))
                                            <div class="text-danger">{{ session()->get('error') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control @error('email') is-invalid @enderror"
                                                name="password" placeholder="Your password" autocomplete="username"
                                                value="{{ old('password') }}">
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if (session()->get('error'))
                                            <div class="text-danger">{{ session()->get('error') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control @error('cpassword') is-invalid @enderror"
                                                name="cpassword" placeholder="your confirm Password" autocomplete="current-password">
                                            @error('cpassword')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('phone_no') is-invalid @enderror"
                                                name="phone_no" placeholder="your mobile number" autocomplete="current-password">
                                            @error('phone_no')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="file"
                                                class="form-control @error('profile_img') is-invalid @enderror"
                                                name="profile_img">
                                            @error('profile_img')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg btn-block">Register</button>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <a href="{{route('userLogin')}}">Existing Login</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('front.footer')

    @include('admin.layout.scripts_footer')
</body>

</html>