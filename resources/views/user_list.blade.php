@extends('layouts.admin')

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

        .search-input {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 250px;
        }

        .search-button {
            padding: 8px 16px;
            background-color: #8B0000;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #450A0A;
        }
    </style>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;margin-bottom:20px;">
            <h1>User List</h1>
            <div class="search-container">
                <form action="{{ route('admin.search') }}" method="GET">
                    <input type="text" name="search" placeholder="Search by Username or Email"
                        value="{{ request()->input('search') }}" class="search-input">
                    <button type="submit" class="search-button">Search</button>
                </form>
            </div>
        </div>
        <div class="my-4" style="width:100%;display:flex;justify-content:left;align-items:left;color:white;">
            <div>
                <a href="{{ route('admin.register') }}" class="btn">
                    <i style="margin-right:10px;" class="fas fa-plus"></i> {{ __('Create User') }}
                </a>
            </div>
        </div>
        @if ($users->isEmpty())
            <div class="watch-history-container" style="padding-bottom:100px;height: 80vh;overflow: auto;">
                <table class="details">
                    <tbody>
                        <tr>
                            <th><strong>#</strong></th>
                            <th><strong>User
                                </strong></th>
                            <th><strong>Email
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
                            <td colspan="5">
                                <p>No User available.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-4" style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                <div style="padding-left:20px;">
                    <a href="{{ route('admin.users.index') }}" class="btn">{{ __('Back') }}</a>
                </div>
            </div>
        @else
            <div class="watch-history-container" style="padding-bottom:100px;height:1800px;">
                <table class="details" id="watchHistoryTable">
                    <tbody>
                        <tr>
                            <th><strong>#</strong></th>
                            <th><strong>User
                                </strong></th>
                            <th><strong>Email
                                </strong></th>
                            <th><strong>
                                    Time
                                </strong></th>
                        </tr>
                        @php $startIndex = 1; @endphp
                        @foreach ($users as $index => $user)
                            <tr>
                                <td style="padding-top:20px;padding-bottom:20px;" scope="row">{{ $startIndex++ }}</th>
                                <td style="padding-top:20px;padding-bottom:20px;">{{ $user->username }}</td>
                                <td style="padding-top:20px;padding-bottom:20px;">{{ $user->email }}</td>
                                <td style="padding-top:20px;padding-bottom:20px;">
                                    {{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="pagination" style="padding-top:50px;font-size:16px;">
                    @if ($users->onFirstPage())
                        <div class="page disabled" id="prev">Previous Page</div>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="page" id="prev">Previous Page</a>
                    @endif

                    <div class="current" id="current">{{ $users->currentPage() }}</div>

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="page" id="next">Next Page</a>
                    @else
                        <div class="page disabled" id="next">Next Page</div>
                    @endif
                </div>
            @endif
            <div class="my-4" style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                <div style="padding-left:20px;">
                    <a href="{{ route('admin.users.index') }}" class="btn">{{ __('Back') }}</a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete(username) {
            if (confirm("Are you sure you want to delete the user with username " + username + "?")) {
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
                    const prevPageUrl = '{{ $users->previousPageUrl() }}';

                    if (prevPageUrl) {
                        fetchPageData(prevPageUrl);
                    }
                });

                nextBtn.addEventListener('click', function() {
                    const nextPageUrl = '{{ $users->nextPageUrl() }}';

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
