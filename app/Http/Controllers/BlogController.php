<?php

namespace App\Http\Controllers;

use App\Events\BlogUpdated;
use App\Jobs\BlogSaveJob;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(10);
        return response()->json([
            'data' => $blogs,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            BlogSaveJob::dispatch(
                $request->title,
                $request->description,
            );

            return response()->json([
                'message' => 'Blog created successfully',
            ], 201);
        } catch (Exception $e) {
             Log::error($e->getMessage());

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $cacheKey = "blog-{$id}";

         if (Cache::has($cacheKey)) {
            return response()->json([
                'data' => Cache::get($cacheKey),
                'source' => 'cache'
            ], 200);
        }else{
            $blog = Blog::findOrFail($id)->toArray();
            Cache::put($cacheKey, $blog, 60);
            return response()->json([
                'data' => $blog,
                'source' => 'database'
            ], 200);
        }

        // $blog = Cache::remember($cacheKey, now()->addMinutes(2), function() use ($id) {
        //     return Blog::findOrFail($id)->toArray();
        // });

        // return response()->json([
        //     'data' => $blog,
        //     'source' => Cache::has($cacheKey) ? 'cache' : 'database'
        // ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        // $cacheKey = "blog-{$blog->id}";
        // Cache::put($cacheKey, $blog, 60);
        event(new BlogUpdated($blog));

        return response()->json([
            'message' => 'Blog updated successfully',
            'data' => $blog,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
