@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>id: {{ $task->id }} のタスク編集ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="w-1/2">
            @csrf
            @method('PATCH')

            <div class="form-control my-4">
                <label for="title" class="label">
                    <span class="label-text">タイトル<div class="text-red-500 inline-block ml-1">(必須)</div></span>
                </label>
                <input type="text" name="title" class="input input-bordered w-full" value="{{ $task->title }}" required>
            </div>

            <div class="form-control my-4">
                <label for="content" class="label">
                    <span class="label-text">説明<div class="text-red-500 inline-block ml-1">(必須)</div></span>
                </label>
                <textarea name="content" class="textarea textarea-bordered w-full" required>{{ $task->content }}</textarea>
            </div>

            <div class="form-control my-4">
                <label for="assigned_to" class="label">
                    <span class="label-text">担当者<div class="text-gray-400 inline-block ml-1">(任意)</div></span>
                </label>
                <input type="text" name="assigned_to" class="input input-bordered w-full" value="{{ $task->assigned_to }}">
            </div>

            <div class="form-control my-4">
                <label for="start_date" class="label">
                    <span class="label-text">開始日<div class="text-gray-400 inline-block ml-1">(任意)</div></span>
                </label>
                <input type="date" name="start_date" class="input input-bordered w-full" value="{{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') : '' }}">
            </div>
            
            <div class="form-control my-4">
                <label for="due_date" class="label">
                    <span class="label-text">期限日<div class="text-gray-400 inline-block ml-1">(任意)</div></span>
                </label>
                <input type="date" name="due_date" class="input input-bordered w-full" value="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}">
            </div>

            <div class="form-control my-4">
                <label for="title" class="label">
                    <span class="label-text">ステータス<div class="text-red-500 inline-block ml-1">(必須)</div></span>
                </label>
                <input type="text" name="status" class="input input-bordered w-full" value="{{ $task->status }}" required>
            </div>


            <button type="submit" class="btn btn-primary btn-outline">更新</button>
        </form>
    </div>
@endsection