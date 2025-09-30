<?php

use App\Models\Tweet;
use App\Models\User;
use App\Models\Tag;

// 🔽一覧取得のテスト
it('displays tags', function () {
  // ユーザを作成
  $user = User::factory()->create();

   // ユーザを認証
  $this->actingAs($user);

  // Tweetを作成
  $tag = Tag::factory()->create();

  // GETリクエスト
  $response = $this->get('/tags');


});

