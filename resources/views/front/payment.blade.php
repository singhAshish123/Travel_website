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

       
        

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>

<body>
    @php
        
    @endphp
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
                                    <h4 class="text-center">Payment</h4>
                                </div>
                                <div class="card-body card-body-auth">
                                    @if (session()->get('success'))
                                        <div class=" alert alert-success">{{session()->get('success')}}</div>
                                    @endif
                                    <form method="post" action="{{route('paymentSubmit',$booking->id)}}">
                                        @csrf
                                       
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="display" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>  
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="form-control" id="display" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>  
                                        
                                       
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Pay</button>
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