<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Video Streaming</title>
    <link rel="icon" href="/streaming.png" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Scripts -->
    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @yield('scripts')
    <livewire:styles>
        <style>
            body,
            html {
                height: 100%;
                font-family: 'Lato', sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
            }

            .wrapper {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .content {
                flex: 1;
                padding-top: 4rem;
                /* Adjust based on the height of your navbar */
            }

            .footer {
                flex-shrink: 0;
            }

            .bg-dark-red {
                background-color: #450A0A;
                /* Dark red color */
            }

            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem;
            }

            .py-6 {
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }

            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }

            a.tmdb {
                /* Define your default styles for the anchor tag with class 'tmdb' */
                color: white;
                /* Set default text color */
                text-decoration: underline;
                /* Remove underline */
            }

            a.tmdb:hover {
                /* Define your hover styles for the anchor tag with class 'tmdb' */
                color: grey;
                /* Change text color to grey on hover */
                text-decoration: underline;
                /* Underline the text on hover */
            }

            .maincircle_long {
                text-transform: uppercase;
                font-weight: bold;
                padding: 5px 10px;
                border-radius: 50px;
                margin: 5px;
                display: inline-block;
                width: 120px;
                text-align: center;
                transition: 0.4s ease-in-out;
                font-size: 16px;
                color: white;

            }

            .maincircle_long:hover {
                text-transform: uppercase;
                font-weight: bold;
                padding: 5px 10px;
                border-radius: 50px;
                margin: 5px;
                display: inline-block;
                width: 120px;
                text-align: center;
                color: black;
                background-color: #fff;
                font-size: 16px;

            }

            .maincircle_nav {
                text-transform: uppercase;
                font-weight: bold;
                padding: 5px 10px;
                border-radius: 50px;
                margin: 5px;
                display: inline-block;
                width: 150px;
                text-align: center;
                transition: 0.4s ease-in-out;
                font-size: 16px;
                color: white;

            }

            .maincircle_nav:hover {
                text-transform: uppercase;
                font-weight: bold;
                padding: 5px 10px;
                border-radius: 50px;
                margin: 5px;
                display: inline-block;
                width: 150px;
                text-align: center;
                color: black;
                background-color: #fff;
                font-size: 16px;

            }

            footer {
                background-color: #450A0A;
                color: white;
                padding: 1rem;
                width: 100%;
            }

            .link {
                color: white;
            }

            .link:hover {
                color: #d70000;
            }

            /* Modal */
            .modal {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 1000;
                /* Sit on top */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                overflow: auto;
                /* Enable scrolling if needed */
                background-color: rgba(0, 0, 0, 0.8);
                /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                box-shadow: 0 6px 20px 0 #333333;
                /* Adjust the values as needed */
                border-color: black;
                /* Adjust the width and color as needed */
                background: linear-gradient(to bottom, #333333, #000000);
                margin: 1% auto;
                /* 15% from the top and centered */
                padding: 20px;
                height: 90%;
                border-radius: 2%;
                border: 1px solid #888;
                width: 100%;
                /* Could be more or less, depending on screen size */
                max-width: 800px;
                /* Max width */
                color: white;
            }

            /* Modal Body */
            .modal-body {
                height: calc(100vh - 40px);
                /* Adjust height to fill the modal */
                overflow-y: auto;
                /* Enable vertical scrolling if needed */
            }

            /* Close Button */
            .close {
                color: #aaa;
                font-size: 28px;
                font-weight: bold;
                align-self: flex-end;
                /* Aligns the close button to the end of the container */
                margin-left: auto;
                /* Pushes the button to the right side */
            }

            .close:hover,
            .close:focus {
                color: #DC6455;
                text-decoration: none;
                cursor: pointer;
            }

            .speechimg {
                background-image: url('/img/voice.png');
                /* Replace 'img/microphone.png' with your image path */
                background-size: cover;
                background-repeat: no-repeat;
            }

            .speechimg:hover {
                background-image: url('/img/voice1.png');
            }

            .record-button {
                background-color: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
                display: flex;
                justify-content: center;
                align-content: center;
                border-radius: 50%;
                /* Make the button circular */
            }

            .record-icon {
                width: 100px;
                height: 100px;
                transition: transform 0.2s ease-in-out;
                border-radius: 50%;
                /* Make the button circular */
            }

            .record-button:hover #recordIcon {
                content: url('/img/voice1.png');
                /* Change the path to your hover image */
            }

            .recording {
                animation: pulse 1s infinite alternate;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.7);
                }

                25% {
                    transform: scale(1.2);
                    box-shadow: 0 0 0 20px rgba(249, 115, 22, 0.3);
                }

                50% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(249, 115, 22, 0);
                }

                75% {
                    transform: scale(0.8);
                    box-shadow: 0 0 0 20px rgba(249, 115, 22, 0.3);
                }

                100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.7);
                }
            }

            .container1 {
                position: relative;
                display: inline-block;
            }

            textarea {
                width: 500px;
                height: 50px;
                background-color: #450A0A;
                color: white;
                border-radius: 10px;
                padding: 10px;
                font-size: 16px;
                border: none;
                box-shadow: 0 6px 10px #F97316;
            }

            .dropdown-content {
                display: none;
                /* Initially hide the dropdown */
                position: absolute;
                width: 500px;
                /* Match the width of the textarea */
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                border-radius: 10px;
                padding: 5px;
                z-index: 1;
                top: 60px;
                /* Adjust this value based on your textarea height and desired spacing */
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .no-results {
                color: #555;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            #searchButton {
                width: 120px;
                height: 50px;
                background-color: #F97316;
                color: white;
                border: none;
                border-radius: 0 10px 10px 0;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                box-shadow: 0 6px 10px #450A0A;
                transition: background-color 0.3s ease;
            }

            #searchButton:disabled {
                background-color: #666;
                cursor: not-allowed;
            }

            #searchButton:hover:enabled {
                background-color: #ffae42;
            }

            #searchButton:active:enabled {
                background-color: #c34a00;
            }

            #showMoreButton {
                display: none;
                /* Initially hidden */
                color: black;
                /* Text color */
                background-color: #FFFFFF;
                /* Background color */
                border: 1px solid black;
                /* Border */
                border-radius: 5px;
                /* Border radius */
                padding: 5px 10px;
                /* Padding */
            }

            #showMoreButton:hover {
                background-color: orange;
                /* Change background color on hover to orange */
                color: white;
                /* Text color */
            }
            .dropdown-item {
                text-align: center;
            }

            .dropdown-item:hover {
                background-color: #900; 
                /* Change background color on hover */
                color:white;
            }
        </style>
</head>

<body>
    <div id="app"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,1) 70%), url('/Rectangle 22.png') repeat center top;">
        <nav class="navbar navbar-expand-md navbar-light bg-dark-red shadow-sm">
            <div class="container" style="width:1200px;">
                <a class="navbar-brand" href="{{ route('movies.index') }}">
                    <img style="width: 12rem;" viewBox="0 0 96 24" fill="none" src="{{ URL('/logo 1.png') }}"
                        alt="">
                </a>
                <ul class="navbar-nav flex-row ml-auto">
                    <li class="nav-item">
                        <a class="nav-link maincircle_long" href="{{ route('trend.index') }}">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link maincircle_long" href="{{ route('tv.index') }}">TV Shows</a>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex flex-row justify-content-end align-items-center">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Livewire search dropdown -->
                        <livewire:search-bar>
                            <button id="openModalButton" class="btn rounded-circle speechimg"
                                style="width: 35px; height: 35px;margin-left:30px;margin-right:30px;">
                                <!-- Add content or icon here if needed -->
                            </button>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link link" style="cursor: auto;" href="#"></a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link link" style="cursor: auto;" href="#"></a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle maincircle_nav"
                                            href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->username }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                                {{ __('Admin Dashboard') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main class="content">
            @yield('content')
        </main>
        <footer>
            <div class="container mx-auto text-sm px-4 py-6">
                Powered by <a href="https://www.themoviedb.org/documentation/api" class="underline tmdb">TMDb
                    API</a>
            </div>
        </footer>
        @yield('scripts')
        <livewire:scripts>
            <!-- Modal -->
            <!-- Full-page modal -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="modal-body" style="position:relative;">
                        <!-- Your modal content goes here -->
                        <!-- <uidiv> -->
                        <div id="warning">
                            <h1 style="font-weight:500;">Speech Recognition Speech SDK not found
                                (microsoft.cognitiveservices.speech.sdk.bundle.js missing).</h1>
                        </div>

                        <div id="content"
                            style="display:none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                                <img style="width: 5%;" src="/img/warning.png" />
                                <div style="margin-left: 10px;">Please Click the Search Button to show more results
                                </div>
                            </div>

                            <div style="display: flex; justify-content: center; align-items: center;">
                                <div class="container1">
                                    <div
                                        style="display: flex; align-items: center; border: 1px solid #ced4da; border-radius: 5px; padding: 5px;">
                                        <div style="display: flex; align-items: center;">
                                            <input id="phraseDiv" placeholder="Type something..."
                                                style="width: 500px; height: 50px; background-color: #450A0A; color: white; border-radius: 10px 0 0 10px; padding: 10px; font-size: 16px; border: none;;">
                                            <button id="searchButton" disabled>Search</button>
                                        </div>

                                    </div>
                                    <div class="dropdown-content" id="dropdown"></div>
                                    <button id="showMoreButton">Show More</button>
                                </div>
                            </div>

                            <div
                                style="display: flex; flex-direction: column; justify-content: center; align-items: center;height:300px;margin-top:100px;">
                                <div id="recordingText"
                                    style="display: none; color: white; font-size: 28px; margin-bottom: 50px;">
                                    Listening
                                </div>
                                <button id="startRecognizeOnceAsyncButton" class="record-button"
                                    onclick="toggleRecording()">
                                    <img id="recordIcon" src="/img/voice.png" alt="Record" class="record-icon">
                                </button>
                            </div>

                        </div>


                        <!-- </uidiv> -->

                        <div id="content" style="display:none">
                            <!-- Speech SDK reference sdk. -->
                            <script src="https://aka.ms/csspeech/jsbrowserpackageraw"></script>

                            <!-- Speech SDK USAGE -->
                            <script>
                                const showMoreButton = document.getElementById('showMoreButton');

                                document.getElementById('searchButton').addEventListener('click', function() {
                                    const searchData = document.getElementById('phraseDiv').value.trim();

                                    if (searchData !== "" && searchData.length >= 2) {
                                        // Redirect to the search page with the input value as a parameter
                                        window.location.href = "/search/" + encodeURIComponent(searchData);
                                    }
                                });

                                function toggleRecording() {
                                    var button = document.getElementById("startRecognizeOnceAsyncButton");
                                    var icon = document.getElementById("recordIcon");
                                    var recordingText = document.getElementById("recordingText");
                                    var phraseDiv = document.getElementById("phraseDiv");

                                    // Start animation regardless of textarea content
                                    button.style.animation = "pulse 1s infinite"; // Add animation class
                                    icon.src = "/img/voice.png"; // Change to finish icon
                                    recordingText.style.display = "block"; // Hide the text
                                }

                                // status fields and start button in UI
                                var phraseDiv;
                                var startRecognizeOnceAsyncButton;

                                // subscription key and region for speech services.
                                var subscriptionKey = "9fa2ebe6640a4006a62cea54b9a1f065";
                                var serviceRegion = "eastus";
                                var SpeechSDK;
                                var recognizer;

                                var icon = document.getElementById("recordIcon");
                                var recordingText = document.getElementById("recordingText");
                                var button = document.getElementById("startRecognizeOnceAsyncButton");

                                document.addEventListener("DOMContentLoaded", function() {
                                    startRecognizeOnceAsyncButton = document.getElementById("startRecognizeOnceAsyncButton");
                                    phraseDiv = document.getElementById("phraseDiv");

                                    startRecognizeOnceAsyncButton.addEventListener("click", function() {
                                        startRecognizeOnceAsyncButton.disabled = true;
                                        phraseDiv.focus(); // Focus on the textarea

                                        var speechConfig = SpeechSDK.SpeechConfig.fromSubscription(subscriptionKey, serviceRegion);
                                        speechConfig.speechRecognitionLanguage = "en-US";
                                        var audioConfig = SpeechSDK.AudioConfig.fromDefaultMicrophoneInput();
                                        recognizer = new SpeechSDK.SpeechRecognizer(speechConfig, audioConfig);

                                        recognizer.recognizeOnceAsync(
                                            function(result) {
                                                startRecognizeOnceAsyncButton.disabled = false;
                                                // Split recognized text into words, trim dots from each word, and join them without separators
                                                phraseDiv.value = result.text.split(' ').map(word => word.replace(/\./g,
                                                    '')).join(' ');
                                                window.console.log(result);

                                                recognizer.close();
                                                recognizer = undefined;
                                                recordingText.style.display = "none"; // Hide the text
                                                button.style.animation = "none";
                                                searchButton.disabled = false;

                                                searchTMDB(phraseDiv.value, function(results) {
                                                    displayResults(results.slice(0, 7)); // Display the results

                                                });
                                            },
                                            function(err) {
                                                startRecognizeOnceAsyncButton.disabled = false;
                                                // Concatenate the error message without separators
                                                phraseDiv.value = "Please Try Again!";
                                                window.console.log(err);

                                                recognizer.close();
                                                recognizer = undefined;
                                                recordingText.style.display = "none"; // Hide the text
                                                button.style.animation = "none";

                                                var dropdown = document.getElementById('dropdown');
                                                dropdown.innerHTML =
                                                    ''; // Clear dropdown if search text is less than 2 characters
                                                dropdown.style.display = 'none'; // Hide the dropdown
                                                searchButton.disabled = true; // Enable the search button
                                            });
                                    });

                                    if (!!window.SpeechSDK) {
                                        SpeechSDK = window.SpeechSDK;
                                        startRecognizeOnceAsyncButton.disabled = false;

                                        document.getElementById('content').style.display = 'block';
                                        document.getElementById('warning').style.display = 'none';
                                    }
                                });



                                function searchTMDB(query, callback) {
                                    // Replace 'YOUR_API_KEY' with your actual TMDB API key
                                    var apiKey = '1cf50e6248dc270629e802686245c2c8';
                                    var url = `https://api.themoviedb.org/3/search/multi?api_key=${apiKey}&query=${encodeURIComponent(query)}`;
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                callback(response.results);
                                            } else {
                                                console.error('Error fetching data from TMDB API');
                                            }
                                        }
                                    };
                                    xhr.open('GET', url, true);
                                    xhr.send();
                                }

                                function displayResults(results) {
                                    var dropdown = document.getElementById('dropdown');
                                    dropdown.innerHTML = ''; // Clear previous results

                                    if (results && results.length > 0) {
                                        results.slice(0, 7).forEach(function(result) {
                                            var title = result.title || result.name; // Use title for movies and name for TV shows
                                            var id = result.id;
                                            var mediaType = result.media_type;
                                            var listItem = document.createElement('a');
                                            listItem.textContent = title;
                                            if (mediaType === 'tv') {
                                                listItem.href = '/tv/' + id;
                                            } else {
                                                listItem.href = '/movies/' + id;
                                            }
                                            listItem.addEventListener('click', function(event) {
                                                event.preventDefault(); // Prevent default link behavior
                                                window.location.href = listItem.href; // Redirect to the specified URL
                                            });
                                            dropdown.appendChild(listItem);
                                        });
                                        dropdown.style.display = 'block'; // Show the dropdown

                                        // Create a div to contain the button and other content
                                        var showLessContainer = document.createElement('div');

                                        // Add styling to the container
                                        showLessContainer.style.display = 'flex';
                                        showLessContainer.style.alignItems = 'center';
                                        showLessContainer.style.justifyContent = 'center'; // Center content horizontally
                                        showLessContainer.style.marginTop = '10px'; // Adjust margin as needed
                                        showLessContainer.style.transition = 'background-color 0.3s'; // Transition effect

                                        // Create the "Show Less" button
                                        var showLessButton = document.createElement('button');
                                        showLessButton.textContent = 'Show Less';
                                        showLessButton.style.color = 'black'; // Text color
                                        showLessButton.style.backgroundColor = '#FFFFFF'; // Background color
                                        showLessButton.style.border = '1px solid black'; // Border
                                        showLessButton.style.borderRadius = '5px'; // Border radius
                                        showLessButton.style.padding = '5px 10px'; // Padding

                                        // Add event listeners to the button for hover effect
                                        showLessButton.addEventListener('mouseenter', function() {
                                            showLessButton.style.backgroundColor = 'orange'; // Change background color on hover to orange
                                            showLessButton.style.color = 'white'; // Text color
                                            showLessButton.style.border = '1px solid transparent'; // Border
                                        });
                                        showLessButton.addEventListener('mouseleave', function() {
                                            showLessButton.style.color = 'black'; // Text color
                                            showLessButton.style.backgroundColor = '#FFFFFF'; // Background color
                                            showLessButton.style.border = '1px solid black'; // Border
                                        });
                                        showLessButton.addEventListener('click', function() {
                                            dropdown.style.display = 'none'; // Hide the dropdown
                                            // Show the show more button
                                            showMoreButton.style.display = 'block';
                                        });

                                        showMoreButton.addEventListener('click', function() {
                                            // Assume that `results` is accessible here, otherwise pass it or fetch it again as needed
                                            dropdown.style.display = 'block'; // Show the dropdown with "No results found" message
                                            showMoreButton.style.display = 'none'; // Hide the "Show More" button
                                        });

                                        // Append the button to the container
                                        showLessContainer.appendChild(showLessButton);

                                        // Append the container to the dropdown
                                        dropdown.appendChild(showLessContainer);
                                    } else {
                                        dropdown.innerHTML = '<a class="no-results">No results found</a>';
                                        dropdown.style.display = 'block'; // Show the dropdown with "No results found" message
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal body script -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Get the modal element
                    var modal = document.getElementById("myModal");

                    // Get the button that opens the modal
                    var btn = document.getElementById("openModalButton");

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    const showMoreButton = document.getElementById('showMoreButton');

                    // When the user clicks the button, open the modal
                    btn.onclick = function() {
                        modal.style.display = "block";
                        phraseDiv.value = ''; // Clear previous results
                        dropdown.innerHTML = '';
                        dropdown.style.display = 'none'; // Show the dropdown with "No results found" message
                        showMoreButton.style.display = 'none'; // Hide the "Show More" button
                    }

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                        recordingText.style.display = "none"; // Hide the text
                        button.style.animation = "none";
                        recognizer.close();
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                });
            </script>
    </div>
</body>

</html>
