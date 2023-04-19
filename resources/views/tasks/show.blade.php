
@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2 class="break-all">{{ $task->title }} のタスク詳細ページ</h2>
    </div>
    
    <table class="table w-full my-4 table-zebra table-fixed">
        <thead>
            <tr>
                <th class="w-40 text-xl break-all">項目</th>
                <th class="text-xl break-all">詳細</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>id</th>
                <td class="break-all">{{ $task->id }}</td>
            </tr>
        
            <tr>
                <th>タイトル</th>
                <td class="break-all">{{ $task->title }}</td>
            </tr>
        
            <tr>
                <th>説明</th>
                <td class="break-all">{!! nl2br(e($task->content)) !!}</td>
            </tr>
        
            <tr>
                <th>担当者</th>
                <td class="break-all">{{ $task->assigned_to }}</td>
            </tr>
        
            <tr>
                <th>開始日</th>
                <td class="break-all">{{ $task->start_date }}</td>
            </tr>
        
            <tr>
                <th>期限日</th>
                <td>{{ $task->due_date }}</td>
            </tr>
        
            <tr>
                <th>作成日時</th>
                <td>{{ $task->created_at }}</td>
            </tr>
        
            <tr>
                <th>更新日時</th>
                <td>{{ $task->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    
    {{-- タスク編集ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('tasks.edit', $task->id) }}">このタスクを編集</a>
    
    {{-- タスク削除フォーム --}}
    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('id = {{ $task->id }} のタスクを削除します。よろしいですか？')">削除</button>
    </form>

@endsection
