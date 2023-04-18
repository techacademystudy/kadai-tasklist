@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>タスク一覧</h2>
    </div>

    @if (isset($tasks))
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full my-4">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>タイトル</th>
                        <th>詳細</th>
                        <th>担当者</th>
                        <th>開始日</th>
                        <th>期限日</th>
                        <th>作成日時</th>
                        <th>更新日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                        <td class="truncate max-w-xs">{{ $task->title }}</td>
                        <td class="truncate max-w-xs">{{ $task->description }}</td>
                        <td class="truncate max-w-xs">{{ $task->assigned_to }}</td>
                        <td>{{ $task->start_date }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>{{ $task->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- タスク新規作成ページへのリンク --}}
    <a class="btn btn-primary" href="{{ route('tasks.create') }}">新規タスクの作成</a>

@endsection