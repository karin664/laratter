<?php

namespace App\Http\Controllers;
use App\Models\Tweet;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Tweet $tweet)
    {
       // タグを保存（重複があれば取得）
    $tag = Tag::firstOrCreate(['name' => $request->input('tag')]);

    // ツイートにタグを関連付け
    $tweet->tags()->attach($tag->id);

    return redirect()->route('tags.index')->with('success', 'タグを追加しました');
}

    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
