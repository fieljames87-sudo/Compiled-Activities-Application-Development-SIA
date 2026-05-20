<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
      $posts = Cache::remember('posts', 60, function () {

        $response = Http::get('https://api.jikan.moe/v4/top/anime');

            if ($response->failed()) {
                return [];
            }

            return $response->json()['data'];
        });

        // Local users
        $users = User::where('name', 'like', '%' . request('search') . '%')->get();

        return view('dashboard', compact('posts', 'users'));
    }
}