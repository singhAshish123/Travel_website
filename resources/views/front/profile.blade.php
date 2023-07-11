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
               

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
</head>

<body>
    @include('front.header')


    <div id="app">
        <div class="main-wrapper">
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset('storage/user_img/'.Auth::user()->profile_img)}}"><span class="font-weight-bold"></span><span class="text-black-50"></span><span> </span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right"><strong>Edit Profile</strong> </h4>
                            </div>
                            <form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
                                @csrf
                                @if (session()->get('success'))
                                    <div class="alert alert-success">{{session()->get('success')}}</div>
                                @endif
                                <div class="row mt-2">
                                    <div class="col-md-12"><label class="labels"></label><input type="text" name="name" class="form-control" placeholder="Your Full Name" value="{{ Auth::user()->name }}"></div>
                                    <div class="col-md-12"><label class="labels"><strong>Email Addres</strong></label><input type="text" name="email" class="form-control" placeholder="Your email address" value="{{Auth::user()->email}}"></div>
                                    <div class="col-md-12"><label class="labels"><strong>Mobile Number</strong></label><input type="text" name="phone_no" class="form-control" placeholder="Your Mobile Number" value="{{Auth::user()->phone_no}}"></div>
                                    <div class="col-md-12"><label class="labels"><strong>Profile Image</strong></label><input type="file" name="profile_img" class="form-control"  value="{{Auth::user()->profile_img}}"></div>
                                   
                                </div>
                               
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit">Update Profile</button>
                                    
                                </div>
                               
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>

    @include('front.footer')

    @include('admin.layout.scripts_footer')
</body>

</html>

