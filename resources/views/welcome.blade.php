<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts -->
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @guest
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        @endguest

        <div class="max-w-7xl mx-auto p-6 lg:p-8">

            <form id="payment-form">
                <input type="text" id="card-holder-name" placeholder="Cardholder Name">
                <div id="card-element"></div>
                <button type="submit">Submit Payment</button>
            </form>

            <div id="payment-result"></div>

            <script src="https://js.stripe.com/v3/"></script>
            <script>
                var stripe = Stripe('pk_test_51KlB0XB98YvBhyuIaHzuE6zxpUwoTrAkMktCCFLE6smHiVN7nr133D2amMKBqHJFk9aqmbnp37kIF9E3lm2cbZ4C00qLlEjune');
                var elements = stripe.elements();
                var cardElement = elements.create('card');
                cardElement.mount('#card-element');

                var form = document.getElementById('payment-form');
                var resultContainer = document.getElementById('payment-result');

                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    stripe.createToken(cardElement).then(function(result) {
                        if (result.error) {
                            resultContainer.textContent = result.error.message;
                        } else {
                            sendTokenToBackend(result.token.id);
                        }
                    });
                });

                function sendTokenToBackend(token) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '/api/add-card');
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // Assuming you're using CSRF protection

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                resultContainer.textContent = 'Payment successful';
                            } else {
                                resultContainer.textContent = 'Payment failed: ' + response.message;
                            }
                        }
                    };

                    var data = JSON.stringify({
                        token: token,
                        user_id : "9b61637d-776a-4c36-870c-5fcdb593625a"
                    });
                    xhr.send(data);
                }
            </script>

            {{-- <div class="flex justify-center">
                <a href="{{ route('google.redirect') }}" class="btn btn-primary"> Login with Google </a>
            </div> --}}

            {{-- <img src="" {{ route('image' ,['name' => 'download.jpeg']) }}   alt="" srcset=""> --}}

            {{-- <img src="{{ route('image', ['name' => 'download.jpeg' , 'token' => 'token' ]) }}" alt="Image"> --}}

            <img src="{{ asset('images/download.jpeg') }}" alt="test">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
