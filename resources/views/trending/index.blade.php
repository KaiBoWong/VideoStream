@extends('layouts.main')

@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .movie {
            width: 250px;
            margin: 0.7rem;
            border-radius: 3px;
            box-shadow: 0.2px 4px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            cursor: pointer;
        }


        .movie img {
            width: 100%;
            height: 330px;
            object-fit: cover;
        }

        #tags {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin: 20px auto;
        }

        .tag {
            color: white;
            padding: 10px 20px;
            background-color: #FF5733;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            cursor: pointer;
            width: 193px;
            text-align: center;
        }

        .tag:hover {
            color: white;
            padding: 10px 20px;
            background-color: #630202;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            cursor: pointer;
            width: 193px;
            text-align: center;
            transition: 0.4s ease-in-out;

        }

        .tag.highlight {
            background-color: #630202;
        }

        .no-results {
            color: white;
        }

        .pagination {
            display: flex;
            margin: 10px 30px;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .page {
            padding: 20px;
            cursor: pointer;
        }

        .page.disabled {
            cursor: not-allowed;
            color: grey;
        }

        .current {
            padding: 10px 20px;
            border-radius: 50%;
            border: 5px solid orange;
            font-size: 20px;
            font-weight: 600;
        }

        .zoom_prod {
            height: auto;
            overflow: hidden;
            border-radius: 5%;
            border-color: transparent;
        }

        .zoom_prod:hover img {
            transform: scale(1.15);
        }

        .zoom_prod img {
            transition: transform .5s ease;
        }
    </style>
    <table
        style="background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 70%), 
    url('/Rectangle 22.png') repeat center top;width:100%;">
        <tbody>
            <tr>
                <td>
                    <table border="0" cellpadding="0" cellspacing="0"
                        style="width:100%;background-color: rgba(0, 0, 0, 0.50);">
                        <tbody>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="max-width:1366px; margin: auto;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div id="tags"></div>
                                                    </div>
                                                    <div style="padding-bottom:50px;display: flex;flex-wrap: wrap;justify-content: center;"
                                                        id="main"></div>
                                                    <div class="pagination">
                                                        <div class="page" id="prev">Previous Page</div>
                                                        <div class="current" id="current">1</div>
                                                        <div class="page" id="next">Next Page</div>

                                                    </div>
                                                    <div style="height:50px;">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <script>
        //TMDB 

        const API_KEY = 'api_key=410b1942b904a76040b5a2cc8597b339';
        const BASE_URL = 'https://api.themoviedb.org/3';
        const API_URL = BASE_URL + '/discover/movie?sort_by=popularity.desc&' + API_KEY;
        const IMG_URL = 'https://image.tmdb.org/t/p/w500';
        const searchURL = BASE_URL + '/search/tv?' + API_KEY;

        const genres = [{
                "id": 28,
                "name": "Action"
            },
            {
                "id": 12,
                "name": "Adventure"
            },
            {
                "id": 16,
                "name": "Animation"
            },
            {
                "id": 35,
                "name": "Comedy"
            },
            {
                "id": 80,
                "name": "Crime"
            },
            {
                "id": 99,
                "name": "Documentary"
            },
            {
                "id": 18,
                "name": "Drama"
            },
            {
                "id": 10751,
                "name": "Family"
            },
            {
                "id": 14,
                "name": "Fantasy"
            },
            {
                "id": 36,
                "name": "History"
            },
            {
                "id": 27,
                "name": "Horror"
            },
            {
                "id": 10402,
                "name": "Music"
            },
            {
                "id": 9648,
                "name": "Mystery"
            },
            {
                "id": 10749,
                "name": "Romance"
            },
            {
                "id": 878,
                "name": "Science Fiction"
            },
            {
                "id": 10770,
                "name": "TV Movie"
            },
            {
                "id": 53,
                "name": "Thriller"
            },
            {
                "id": 10752,
                "name": "War"
            },
            {
                "id": 37,
                "name": "Western"
            }
        ]

        const main = document.getElementById('main');
        const tagsEl = document.getElementById('tags');

        const prev = document.getElementById('prev')
        const next = document.getElementById('next')
        const current = document.getElementById('current')

        var currentPage = 1;
        var nextPage = 2;
        var prevPage = 3;
        var lastUrl = '';
        var totalPages = 100;

        var selectedGenre = []
        setGenre();

        function setGenre() {
            tagsEl.innerHTML = '';
            genres.forEach(genre => {
                const t = document.createElement('div');
                t.classList.add('tag');
                t.id = genre.id;
                t.innerText = genre.name;
                t.addEventListener('click', () => {
                    if (selectedGenre.length == 0) {
                        selectedGenre.push(genre.id);
                    } else {
                        if (selectedGenre.includes(genre.id)) {
                            selectedGenre.forEach((id, idx) => {
                                if (id == genre.id) {
                                    selectedGenre.splice(idx, 1);
                                }
                            })
                        } else {
                            selectedGenre.push(genre.id);
                        }
                    }
                    console.log(selectedGenre)
                    getMovies(API_URL + '&with_genres=' + encodeURI(selectedGenre.join(',')))
                    highlightSelection()
                })
                tagsEl.append(t);
            })
        }

        function highlightSelection() {
            const tags = document.querySelectorAll('.tag');
            tags.forEach(tag => {
                tag.classList.remove('highlight')
            })
            clearBtn()
            if (selectedGenre.length != 0) {
                selectedGenre.forEach(id => {
                    const hightlightedTag = document.getElementById(id);
                    hightlightedTag.classList.add('highlight');
                })
            }

        }

        function clearBtn() {
            let clearBtn = document.getElementById('clear');
            if (clearBtn) {
                clearBtn.classList.add('highlight')
            } else {

                let clear = document.createElement('div');
                clear.classList.add('tag', 'highlight');
                clear.id = 'clear';
                clear.innerText = 'Clear x';
                clear.addEventListener('click', () => {
                    selectedGenre = [];
                    setGenre();
                    getMovies(API_URL);
                })
                tagsEl.append(clear);
            }

        }

        getMovies(API_URL);

        function getMovies(url) {
            lastUrl = url;
            fetch(url).then(res => res.json()).then(data => {
                console.log(data.results)
                if (data.results.length !== 0) {
                    showMovies(data.results);
                    currentPage = data.page;
                    nextPage = currentPage + 1;
                    prevPage = currentPage - 1;
                    totalPages = data.total_pages;

                    current.innerText = currentPage;

                    if (currentPage <= 1) {
                        prev.classList.add('disabled');
                        next.classList.remove('disabled')
                    } else if (currentPage >= totalPages) {
                        prev.classList.remove('disabled');
                        next.classList.add('disabled')
                    } else {
                        prev.classList.remove('disabled');
                        next.classList.remove('disabled')
                    }

                    tagsEl.scrollIntoView({
                        behavior: 'smooth'
                    })

                } else {
                    main.innerHTML = `<div class="mt-8" style="padding-bottom:50px;">
    <table class="shadow-lg shadow-orange-500"
        style="border-radius: 5%;width:100%;">
        <tbody>
            <tr>
                <td class="products-container">
                    <table border="0" cellpadding="0"
                        cellspacing="0" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td class="photo_hoverpointProd"
                                    style="position: relative">
                                    <table border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td class="zoom_prod">
                                                    <img src="/img/notfound.jpg"
                                                    alt="movie poster"
                                                    class=" hover:scale-125 transition ease-in-out duration-150 hover-shadow preview"
                                                    style="width: 196px;height:294.6px;">
                                                    <table
                                                        border="0"
                                                        cellpadding="0"
                                                        cellspacing="0"
                                                        class="photo_prod"
                                                        style="width: 100%">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <img src="/data/cms/images/trans.gif"
                                                                        style="width: 10px; height: 1px;" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>`
                }

            })

        }


        function showMovies(data) {
            main.innerHTML = '';
            const genres = {
                    28: "Action",
                    12: "Adventure",
                    16: "Animation",
                    35: "Comedy",
                    80: "Crime",
                    99: "Documentary",
                    18: "Drama",
                    10751: "Family",
                    14: "Fantasy",
                    36: "History",
                    27: "Horror",
                    10402: "Music",
                    9648: "Mystery",
                    10749: "Romance",
                    878: "Science Fiction",
                    10770: "TV Movie",
                    53: "Thriller",
                    10752: "War",
                    37: "Western",
        };

        data.forEach(movie => {
            const {
                title,
                poster_path,
                vote_average,
                overview,
                id,
                release_date,
                genre_ids
            } = movie;
            const movieGenres = genre_ids.map(genreId => genres[genreId]);
            const movieEl = document.createElement('div');
            movieEl.classList.add('movie');
            movieEl.innerHTML = `
            <div class="mt-8">
    <table class="shadow-lg shadow-orange-500"
        style="border-radius: 5%;width:100%;">
        <tbody>
            <tr>
                <td class="products-container">
                    <table border="0" cellpadding="0"
                        cellspacing="0" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td class="photo_hoverpointProd"
                                    style="position: relative">
                                    <table border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td class="zoom_prod">
                                                    <img src="${poster_path ? IMG_URL + poster_path : "http://via.placeholder.com/1080x1580"}" alt="${title}">
                                                    <table
                                                        border="0"
                                                        cellpadding="0"
                                                        cellspacing="0"
                                                        class="photo_prod"
                                                        style="width: 100%">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <img src="/data/cms/images/trans.gif"
                                                                        style="width: 10px; height: 1px;" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%;">
        <tbody>
            <tr>
                <td>
                    <img src="/data/cms/images/trans.gif"
                        style="width: 10px; height: 10px;" />
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mt-2 movies">
                       <div>
                         ${title}
                         </div>
                        <div
                            class="flex items-center text-gray-400 text-sm mt-1">
                            <svg class="fill-current text-orange-500 w-4"
                                viewBox="0 0 24 24">
                                <g data-name="Layer 2">
                                    <path
                                        d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                        data-name="star" />
                                </g>
                            </svg>
                            <span class="ml-1">${vote_average.toFixed(2)}</span>
                            <span class="mx-2">|</span>
                            <span>${release_date}</span>
                        </div>
                    </div>
                    <div>
                        <span class="mr-2 text-gray-400 text-sm">${movieGenres.join(', ')}</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
        `;

            main.appendChild(movieEl);

            // Attach event listeners to both the image element and the movie div for opening detailed view
            const imageElement = movieEl.querySelector('img');
            imageElement.addEventListener('click', () => {
                openNav(movie);
            });

            movieEl.addEventListener('click', () => {
                openNav(movie);
            });
        });
        }

        const overlayContent = document.getElementById('overlay-content');
        /* Open when someone clicks on the span element */
        function openNav(movie) {
            var id = movie.id;
            window.location.href = `{{ route('trend.show', 'ID_PLACEHOLDER') }}`.replace('ID_PLACEHOLDER', id);
        }


        function getColor(vote) {
            if (vote >= 8) {
                return 'green'
            } else if (vote >= 5) {
                return "orange"
            } else {
                return 'red'
            }
        }

        prev.addEventListener('click', () => {
            if (prevPage > 0) {
                pageCall(prevPage);
            }
        })

        next.addEventListener('click', () => {
            if (nextPage <= totalPages) {
                pageCall(nextPage);
            }
        })

        function pageCall(page) {
            let urlSplit = lastUrl.split('?');
            let queryParams = urlSplit[1].split('&');
            let key = queryParams[queryParams.length - 1].split('=');
            if (key[0] != 'page') {
                let url = lastUrl + '&page=' + page
                getMovies(url);
            } else {
                key[1] = page.toString();
                let a = key.join('=');
                queryParams[queryParams.length - 1] = a;
                let b = queryParams.join('&');
                let url = urlSplit[0] + '?' + b
                getMovies(url);
            }
        }
    </script>
@endsection
