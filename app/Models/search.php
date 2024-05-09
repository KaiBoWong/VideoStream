<?php

// Check if the 'search' parameter is set and has a length of at least 2 characters
if (isset($_GET['search']) && strlen($_GET['search']) >= 2) {
    // Your search logic goes here
    // This example assumes you're using the TMDB API to fetch search results
    $searchQuery = urlencode($_GET['search']); // URL encode the search query
    $apiKey = 'YOUR_TMDB_API_KEY'; // Replace 'YOUR_TMDB_API_KEY' with your actual TMDB API key

    // Make a request to the TMDB API to search for movies or TV shows
    $url = "https://api.themoviedb.org/3/search/multi?query={$searchQuery}&api_key=1cf50e6248dc270629e802686245c2c8";
    $response = file_get_contents($url); // Make the API request
    $searchResults = json_decode($response, true); // Decode the JSON response

    // Output the search results as JSON
    echo json_encode($searchResults['results']);
} else {
    // If 'search' parameter is not set or is too short, return an empty array
    echo json_encode([]);
}
