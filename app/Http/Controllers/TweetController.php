<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Tag;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tweets = Tweet::with(['user', 'liked'  ,'tag'])->latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
      return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
      'tweet' => 'required|max:255',
    ]);

    

     // ツイートを保存（タグと紐づけ）
    $tweet=$request->user()->tweets()->create([
        'tweet' => $request->input('tweet'),
    ]);
    
// タグを取得または作成
    $tag = Tag::firstOrCreate(['tag' => $request->input('tag'), 'tweet_id' => $tweet->id ]);

 // タグが入力されているときだけ保存
    if ($request->filled('tag')) {
        $tweet->tag()->create([
            'tag' => $request->input('tag'),
            'tweet_id' => $tweet->id,
        ]);

    return redirect()->route('tweets.index');
    }
  }


    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
      $tweet->load(['comments', "tag"]);
      return view('tweets.show', compact('tweet'));


      $tweet = Tweet::with('tags')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
    return view('tweets.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
       $request->validate([
      'tweet' => 'required|max:255',
    ]);

    $tweet->update($request->only('tweet'));

    return redirect()->route('tweets.show', $tweet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        $tweet->delete();

      return redirect()->route('tweets.index');
    }
    /**
 * Search for tweets containing the keyword.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\View\View
 */
public function search(Request $request)
{

  $query = Tweet::query();

  // キーワードが指定されている場合のみ検索を実行
  if ($request->filled('keyword')) {
    $keyword = $request->keyword;
    $query->where('tweet', 'like', '%' . $keyword . '%');
  }

  // ページネーションを追加（1ページに10件表示）
  $tweets = $query
    ->latest()
    ->paginate(10);

  return view('tweets.search', compact('tweets'));
 }
}
