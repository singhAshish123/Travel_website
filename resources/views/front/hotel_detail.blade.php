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
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffcc00;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        /* Additional custom styles */
        .main-wrapper {
            background-color: #f5f5f5;
            padding: 20px;
            flex-grow: 1;
            margin-bottom: 60px; /* Adjust the margin-bottom value as needed */
        }

        .album {
            padding-top: 20px; /* Adjust the spacing value as needed */
            padding-bottom: 20px; /* Adjust the spacing value as needed */
            background-color: #f5f5f5;
        }

        .album .card-img-top {
            object-fit: cover;
            height: 225px;
        }

        .hotel-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hotel-info h4 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .hotel-info ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .hotel-info ul li {
            margin-bottom: 10px;
        }

        .hotel-info ul li h6 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #333;
        }

        .hotel-info ul li .text-body-secondary {
            color: #777;
        }

        .booking-button {
            margin-top: 20px;
        }

        .booking-button button {
            background-color: #ffcc00;
            color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .booking-button button:hover {
            background-color: #ffa500;
        }
        .custom-list {
    font-size: larger;
}

.larger-font {
    font-size: larger;
}


    </style>
</head>

<body>
    @include('front.header')

    <div id="app">
        <div class="main-wrapper">
            <div class="album py-3 bg-body-tertiary"> <!-- Update the padding values -->
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach ($hotel->hotelPhotos as $dt )
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="{{asset('storage/hotel_image/'.$dt->image)}}" alt="Image" width="225px" height="225px">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <main>
                <div class="py-5 text-center">
                  
                </div>
                <div class="container">
                    <div class="row g-5">
                        <div class="col-md-7 col-lg-8">
                            <div class="hotel-info">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-primary">Hotel Information</span>
                                </h4>
                                <ul class="list-group mb-3 custom-list">
                                  <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                          <h6 class="my-0">Description</h6>
                                          <span class="text-body-secondary larger-font">{{$hotel->description}}</span>
                                      </div>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                          <h6 class="my-0">Facilities</h6>
                                          @php
                                              $facilityNames = $hotel->facilities->pluck('facilities')->unique();
                                          @endphp
                                          @foreach ($facilityNames as $facilityName)
                                              <div>
                                                  <span class="text-body-secondary larger-font">{{$facilityName}}</span>
                                              </div>
                                          @endforeach
                                      </div>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                          <h6 class="my-0">Total Available Rooms</h6>
                                          @foreach ($hotel->selectedRoomTypes as $selectedRoomType)
                                              <div>
                                                  <span class="text-body-secondary larger-font">{{$selectedRoomType->roomType->room_type}} - {{$selectedRoomType->total_rooms}}</span>
                                              </div>
                                          @endforeach
                                      </div>
                                      <span class="text-body-secondary larger-font">{{$hotel->selectedRoomTypes->sum('total_rooms')}}</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between lh-sm">
                                      <div>
                                          <h6 class="my-0">One Room Price For All Type of Rooms</h6>
                                          @foreach ($hotel->selectedRoomTypes as $selectedRoomType)
                                          <div>
                                              <span class="text-body-secondary larger-font"> {{$selectedRoomType->roomType->room_type}} - {{$selectedRoomType->one_room_price}}₹</span>
                                          </div>
                                      @endforeach
                                      
                                      </div>
                                      <span class="text-body-secondary"></span>
                                  </li>
                              </ul>
                              
                              <div class="booking-button">
                                  <a href="{{route('bookHotel',$hotel->id)}}"><button type="submit" class="btn btn-primary">Book Hotel</button></a>
                              </div>
                              
                              
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @include('front.footer')
    @include('admin.layout.scripts_footer')
</body>

</html>