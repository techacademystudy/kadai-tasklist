<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 認証を確認し、ログインしている場合のみタスク一覧を表示
        if (Auth::check()) {
            // ログインしているユーザーのIDを取得する
            $userId = Auth::user()->id;
        
            // ログインしているユーザーのタスクのみを取得する
            $tasks = Task::where('user_id', $userId)->get();
        
            return view('tasks.index', compact('tasks'));
        } else {
            // ログインしていない場合はログイン画面にリダイレクト
            // return redirect()->route('login');
            $tasks = null;
             // メッセージ一覧ビューでそれを表示
            return view('tasks.index', [
                'tasks' => $tasks,
            ]);
            
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        if (Auth::check()) {
            $task = new Task;
    
            // メッセージ作成ビューを表示
            return view('tasks.create', [
                'task' => $task,
            ]);
        } else {
            // ログインしていない場合はログイン画面にリダイレクト
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // バリデーション
            $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|max:10'
        ]);
        
        $request->merge(['created_by' => Auth::id()]); // ここを追加

         // タスクを作成
        $task = new Task;
        $task->title = $request->title;
        $task->content = $request->content;
        $task->assigned_to = $request->assigned_to;
        $task->due_date = $request->due_date;
        $task->start_date = $request->start_date;
        $task->status = $request->status;
        $task->user_id = Auth::id(); // ここを追加
        $task->save();

        // タスク一覧へリダイレクトさせる
        return redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // getでmessages/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        // ログインしているユーザーの情報を取得
        $user = Auth::user();
    
        // ログインしているユーザーとタスクのユーザーが一致するか確認
        if ($task->user_id !== $user->id) {
            // 一致しない場合はエラーを返す
            return redirect('/');
        }
    
        // タスク詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // getでmessages/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // ログインしていない人をhome画面へリダイレクト
        if (!Auth::check()) {
            return redirect('/');
        }
        
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
    
        // ログインしているユーザーのIDとタスクのユーザーIDが一致しない場合はhome画面へリダイレクト
        if ($task->user_id != Auth::id()) {
            return redirect('/');
        }
    
        // タスク編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // putまたはpatchでmessages/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // ログインしていない場合はログインページにリダイレクトする
        if (!Auth::check()) {
            return redirect('/');
        }
        
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
    
        // タスクのユーザーIDとログイン中のユーザーIDが一致しない場合は'/'にリダイレクトさせる
        if ($task->user_id != Auth::id()) {
            return redirect('/');
        }
        
        // バリデーション
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|max:10'
        ]);
        
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        // タスクを更新
        $task->title = $request->title;
        $task->content = $request->content;
        $task->assigned_to = $request->assigned_to;
        $task->due_date = $request->due_date;
        $task->start_date = $request->start_date;
        $task->status = $request->status;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $task = Task::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $task->user_id) {
            $task->delete();
            return redirect('/')->with('success','Delete Successful');
        }
    }
}
