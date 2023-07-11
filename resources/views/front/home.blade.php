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

        .hero {
            background-image: url("travel_images/black.jpg");
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero h2 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 24px;
        }
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>

<body>
    @include('front.header')

    <div id="app">
        <div class="main-wrapper">
            <section class="section">
                <div class="hero">
                    <div class="container">
                        <h2>Explore the World</h2>
                        <p>Discover amazing destinations and book your hotel with us.</p>
                    </div>
                </div>
            </section>
            <div class="album py-5 bg-body-tertiary">
                <div class="container">
                  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($hotel as $ht )
                    <div class="col">
                      <div class="card shadow-sm">
                        <a href="{{route('hotelDetails',$ht->id)}}"><img class="card-img-top" src="{{asset('storage/images/'.$ht->logo)}}" alt="Image" width="300px" height="300px"></a>
                        <div class="card-body">
                          <p class="card-text"><strong>{{$ht->hotel_name}}</strong></p>
                          <span class="card-text">{{$ht->city_id}}, {{$ht->state_id}}</span>
                          <span class="card-text"></span>
                        </div>
                        
                        
                      </div>
                    </div>
                    @endforeach
                   
                    
                  </div>
                </div>
              </div>
              

     @include('front.footer')
    @include('admin.layout.scripts_footer')
</body>

</html>