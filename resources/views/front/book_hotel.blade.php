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

       
        .selected-room {
        font-size: 18px;
        
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
                                    <h4 class="text-center">Book Hotel</h4>
                                </div>
                                <div class="card-body card-body-auth">
                                    @if (session()->get('success'))
                                        <div class="alert alert-success">{{session()->get('success')}}</div>
                                    @endif
                                    <form method="post" action="{{route('bookHotelSubmit',$hotel->id)}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Check In</label>
                                                    <input type="date" name="check_in" class="form-control">
                                                    @error('check_in')
                                                        <div class="text-danger">{{$message}}</div>    
                                                    @enderror
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Check Out</label>
                                                    <input type="date" name="check_out" class="form-control">
                                                    @error('check_out')
                                                    <div class="text-danger">{{$message}}</div>    
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Select Room Type *</label>
                                                <select class="form-control" name="room_id" id='room_types'  onchange="update()" value="ACCT_VALUE_KEY">
                                                    <option value="">Select Room Types</option>
                                                    @foreach($hotel->selectedRoomTypes as $ht)
                                                    <option value="{{$ht->roomType->id}}">{{$ht->roomType->room_type}}</option>
                                                    @endforeach
                                                    <div>   
                                                    </div>
                                                </select>
                                                @error('room_id')
                                                <div class="text-danger">{{$message}}</div>    
                                            @enderror
                                            </div>
                                        </div>
                                        <div id="room-quantity" class="mb-3">
                                            <div class="form-group">
                                                <label for="room_quantity">Rooms *</label>
                                                <div class="input-group">
                                                    <button type="button" class="btn btn-secondary" onclick="decreaseRoom()">-</button>
                                                    <input type="number" name="room_quantity" class="form-control" id="room_quantity" value="1" min="1">
                                                    <button type="button" class="btn btn-secondary" onclick="increaseRoom()">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="city_id">Guests *</label>
                                                <select class="form-control" name="guests">
                                                    <option value="">Select Guest</option>
                                                    <option value="adults">Adults</option>
                                                    <option value="children">Children</option>
                                                    
                                                </select>
                                                @error('guests')
                                                    <div class="text-danger">{{$message}}</div>    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="amount">Total Amount *</label>
                                                <input type="text" name="price" class="form-control" id="display" value="">
                                                @error('price')
                                                <div class="text-danger">{{$message}}</div>    
                                            @enderror
                                            </div>
                                        </div>  
                                        <div id="selected_room" style="display: none;"></div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Reserve</button>
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
    <script>
        function update(){
            sel = document.getElementById("room_types");
            display = document.getElementById("display");
            display.value = {{$ht->one_room_price}};
        }
        function increaseRoom() {
            const roomQuantityInput = document.getElementById("room_quantity");
            const roomQuantity = parseInt(roomQuantityInput.value);
            roomQuantityInput.value = roomQuantity + 1;
            displaySelectedRoom();
        }

        function decreaseRoom() {
            const roomQuantityInput = document.getElementById("room_quantity");
            const roomQuantity = parseInt(roomQuantityInput.value);
            if (roomQuantity > 1) {
                roomQuantityInput.value = roomQuantity - 1;
                displaySelectedRoom();
            }
        }
        function calculateTotalPrice() {
            const roomQuantityInput = document.getElementById("room_quantity");
            const roomQuantity = parseInt(roomQuantityInput.value);
            const oneRoomPrice = {{$ht->one_room_price}};
            const totalPrice = roomQuantity * oneRoomPrice;
            return totalPrice;
        }
        const selectedRooms = [];
        function displaySelectedRoom() {
        const roomTypeSelect = document.getElementById("room_types");
        const selectedRoomOptions = Array.from(roomTypeSelect.selectedOptions);
        const roomQuantityInput = document.getElementById("room_quantity");
        const roomQuantity = parseInt(roomQuantityInput.value);
        const totalPrice = calculateTotalPrice();

        // Clear the existing content
        const selectedRoomDiv = document.getElementById("selected_room");
        selectedRoomDiv.innerHTML = "";

        // Update the selectedRooms array
        selectedRooms.length = 0; // Clear the array
        selectedRoomOptions.forEach(option => {
            const roomType = option.text;
            const roomID = option.value;
            const roomData = {
                roomType,
                roomQuantity,
                totalPrice
            };
            selectedRooms.push(roomData);
        });

        // Display the selected rooms
        if (selectedRooms.length > 0 && roomQuantity > 0) {
            selectedRooms.forEach(roomData => {
                const roomInfo = document.createElement("div");
                roomInfo.textContent = `${roomData.roomType} - Rooms: ${roomData.roomQuantity}, Total Price: ${roomData.totalPrice}`;
                roomInfo.classList.add("selected-room");
                selectedRoomDiv.appendChild(roomInfo);
            });

            selectedRoomDiv.style.display = "block";
        } else {
            selectedRoomDiv.style.display = "none";
        }

        const displayInput = document.getElementById("display");
        displayInput.value = totalPrice;
}
    </script>
     @include('front.footer')
    @include('admin.layout.scripts_footer')
</body>

</html>