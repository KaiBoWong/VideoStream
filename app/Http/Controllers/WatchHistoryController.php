<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchHistory;
use Illuminate\Support\Facades\Auth;

class WatchHistoryController extends Controller
{
    public function storeWatchHistory(Request $request)
    {
        // Validate the request if needed
        $request->validate([
            'movie_id' => 'required|exists:movies,id'
        ]);

        // Store the watch history
        WatchHistory::create([
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'movie_id' => $request->movie_id,
            'watched_at' => now() // You may customize this timestamp
        ]);

        return response()->json(['message' => 'Watch history stored successfully']);
    }
    public function showWatchHistory()
    {
        // Retrieve the logged-in user
        $user = Auth::user();

        // Retrieve the watch history data for the logged-in user
        $watchHistory = WatchHistory::where('username', $user->username)
            ->latest('updated_at')
            ->paginate(10); // Paginate the results

        // Pass the watch history data and whether more pages exist to the Blade view
        return view('watch_history', [
            'watchHistory' => $watchHistory,
            'hasMorePages' => $watchHistory->hasMorePages()
        ]);
    }

    public function deleteHistory($id)
    {
        $history = WatchHistory::find($id);
        if (!$history) {
            return redirect()->route('watch_history')->with('error', 'Watch history not found.');
        }

        $history->delete();

        return redirect()->route('watch_history')->with('success', 'Watch history deleted successfully.');
    }
}
