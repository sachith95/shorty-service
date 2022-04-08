<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\URLShort;
use Illuminate\Support\Facades\Auth;

class UrlShortController extends Controller
{
    public function short(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);
        $url = $request->get('url');
        $shortUrl = URLShort::where('url', $url)->first();
        if ($shortUrl) {
            return response()->json([
                'url' => $url,
                'short_url' => $shortUrl->short_url,
            ]);
        }
        $shortUrl = URLShort::create([
            'url' => $url,
            'short_url' => URLShort::generateShortUrl(),
            'user_id' => Auth::id(),
        ]);
        return response()->json([
            'url' => $url,
            'short_url' => $shortUrl->short_url,
        ]);
    }

    public function redirect($shortUrl)
    {
        if (!$shortUrl) {
            return response()->json([
                'error' => 'Short url is required',
            ], 400);
        }

        $url = URLShort::where('short_url', $shortUrl)->first();
        // if not null update redirect count
        if ($url) {
            $url->increment('redirect_count');
        }
        if ($url) {
            return redirect($url->url);
        }
        return response()->json([
            'error' => 'URL not found!!',
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);
        $url = $request->get('url');
        $response = URLShort::where('id', $id)->first();
        if ($response) {
            $response->url = $url;
            $response->save();
            return response()->json([
                'url' => $url,
                'short_url' => $response->short_url,
            ]);
        }
        return response()->json([
            'error' => 'URL not found!!',
        ], 404);
    }

    public function destroy($id)
    {
        $url = URLShort::where('id', $id)->first();
        if ($url) {
            URLShort::where('id', $id)->delete();
            return response()->json([
                'url' => $url->url,
                'short_url' => $url->short_url,
            ]);
        }
        return response()->json([
            'error' => 'URL not found!!',
        ], 404);
    }
}
