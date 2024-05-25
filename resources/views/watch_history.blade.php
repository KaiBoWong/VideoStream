@extends('layouts.app')

@section('content')
    <style>
        body {
            color: white;
        }

        .details {
            margin-right: 10px;
            width: 100%;
        }

        .delete-btn {
            background-color: transparent;
            border: none;
            padding: 0;
        }

        .delete-btn:hover img {
            content: url('/img/recycle-bin（red).png');
            max-width: 50px;
        }

        /* Adjust image size */
        .details img {
            max-width: 100px;
            /* Adjust the maximum width as needed */
            height: auto;
        }

        /* Style for the table */
        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        /* Style for table cells */
        .details td,
        .details th {
            padding: 10px;
            border: none;
            border-top: 1px solid transparent;
            /* Make other borders transparent */
            border-bottom: 1px solid transparent;
            /* Make other borders transparent */
            text-align: center;
        }

        .details th {
            background-color: #8B0000;
            /* Adjust background color as needed */
            border-top: 1px solid transparent;
            /* Make other borders transparent */
            border-bottom: 1px solid transparent;
            /* Make other borders transparent */
            vertical-align: middle;
            /* Vertical alignment */
        }

        /* Style for table header text */
        .details th strong {
            color: #fff;
        }

        /* Style for alternate rows */
        .details tr:nth-child(even) {
            border-top: 5px solid #8B0000;
            border-bottom: 5px solid #8B0000;
            /* Adjust background color as needed */
        }

        .watch-history-container {
            width: 100%;
            background-color: rgba(251, 251, 251, 0.3);
        }

        /* Style for the row onclick */
        .row-clickable:hover {
            background-color: #450A0A;
            /* Change background color on hover */
            cursor: pointer;
            /* Change cursor to pointer on hover */
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

        a.page {
            text-decoration: none;
            color: white;
        }

        .btn {
            background-color: #8B0000;
            border-color: #8B0000;
            color: white;
            width: 100px;
        }

        a.btn:hover {
            background-color: #450A0A;
            border-color: #450A0A;
            color: white;
        }

        .btn:hover {
            background-color: #450A0A;
            /* Darker blue color on hover */
            color: white;
        }
    </style>

    <div class="container">
        <h1>Watch History</h1>
        @if ($watchHistory->isEmpty())
            <div class="watch-history-container" style="height: 80vh;">
                <table class="details">
                    <tbody>
                        <tr>
                            <th><strong>#</strong></th>
                            <th><strong>Image
                                </strong></th>
                            <th><strong>Title
                                </strong></th>
                            <th><strong>Genre
                                </strong></th>
                            <th><strong>Media Type
                                </strong></th>
                            <th><strong>
                                    Time
                                </strong></th>
                            <th><strong>
                                    Action
                                </strong></th>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <p>No watch history available.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-4" style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                <div style="padding-left:20px;">
                    <a href="{{ route('home') }}" class="btn">{{ __('Back') }}</a>
                </div>
            </div>
        @else
            <div class="watch-history-container" style="height: 1800px;">
                <table class="details" id="watchHistoryTable">
                    <tbody>
                        <tr>
                            <th><strong>#</strong></th>
                            <th><strong>Image
                                </strong></th>
                            <th><strong>Title
                                </strong></th>
                            <th><strong>Genre
                                </strong></th>
                            <th><strong>Media Type
                                </strong></th>
                            <th><strong>
                                    Time
                                </strong></th>
                            <th><strong>
                                    Action
                                </strong></th>
                            </th>
                        </tr>
                        @foreach ($watchHistory as $index => $history)
                            <tr class="row-clickable"
                                onclick="window.location.href = 
                                '{{ $history->media_type === 'MOVIE' ? route('movies.show', $history->tmdb_id) : ($history->media_type === 'TV' ? route('tv.show', $history->tmdb_id) : '#') }}';">
                                <td scope="row">{{ $index + 1 }}</th>
                                <td><img src="{{ 'https://image.tmdb.org/t/p/w500/' . $history->poster_path }}"
                                        alt="poster"></td>
                                <td>{{ $history->title }}</td>
                                <td>{{ $history->genre }}</td>
                                <td>{{ $history->media_type }}</td>
                                <td>{{ $history->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <form action="{{ route('delete_history', $history->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn"
                                            onclick="confirmDelete('{{ $history->title }}')">
                                            <img src="/img/recycle-bin.png" alt="Delete" style="max-width: 50px;">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($watchHistory->hasPages())
                <div class="pagination" style="padding-top:50px;font-size:16px;">
                    @if ($watchHistory->onFirstPage())
                        <div class="page disabled" id="prev">Previous Page</div>
                    @else
                        <a href="{{ $watchHistory->previousPageUrl() }}" class="page" id="prev">Previous Page</a>
                    @endif

                    <div class="current" id="current">{{ $watchHistory->currentPage() }}</div>

                    @if ($watchHistory->hasMorePages())
                        <a href="{{ $watchHistory->nextPageUrl() }}" class="page" id="next">Next Page</a>
                    @else
                        <div class="page disabled" id="next">Next Page</div>
                    @endif
                </div>
            @endif
            <div class="my-4" style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                <div style="padding-left:20px;">
                    <a href="{{ route('home') }}" class="btn">{{ __('Back') }}</a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete(title) {
            if (confirm("Are you sure you want to delete the watch history with title " + title + "?")) {
                // If user confirms, submit the form
                document.getElementById('deleteForm').submit();
            } else {
                // If user cancels, do nothing
                return false;
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const watchHistoryTableBody = document.getElementById('watchHistoryTableBody');

            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', function() {
                    const prevPageUrl = '{{ $watchHistory->previousPageUrl() }}';

                    if (prevPageUrl) {
                        fetchPageData(prevPageUrl);
                    }
                });

                nextBtn.addEventListener('click', function() {
                    const nextPageUrl = '{{ $watchHistory->nextPageUrl() }}';

                    if (nextPageUrl) {
                        fetchPageData(nextPageUrl);
                    }
                });
            }

            function fetchPageData(url) {
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        // Clear the existing table data
                        watchHistoryTableBody.innerHTML = '';

                        // Create a temporary div to hold the new table rows
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;

                        // Append new rows to the existing table body
                        watchHistoryTableBody.insertAdjacentHTML('beforeend', tempDiv.querySelector('tbody')
                            .innerHTML);
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
