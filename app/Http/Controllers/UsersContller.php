<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersContller extends Controller
{
    public function show($id)
    {
    $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'tasks' => $tasks,
        ]);
    }
}
