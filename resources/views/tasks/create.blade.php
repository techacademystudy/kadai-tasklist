@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>タスク新規作成ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('tasks.store') }}" class="w-1/2">
            @csrf

        <div class="form-control my-4">
            <label for="title" class="label">
                <span class="label-text">タイトル<div class="text-red-500 inline-block ml-1">(必須)</div></span>
            </label>
            <input type="text" name="title" class="input input-bordered w-full" required>
        
            <label for="description" class="label">
                <span class="label-text">詳細<div class="text-red-500 inline-block ml-1">(必須)</div></span>
            </label>
            <input type="text" name="description" class="input input-bordered w-full" required>
        
            <label for="assigned_to" class="label">
                <span class="label-text">担当者<div class="text-gray-400 inline-block ml-1">(任意)</div></span>
            </label>
            <input type="text" name="assigned_to" class="input input-bordered w-full">
        
            <label for="start_date" class="label">
                <span class="label-text">開始日<div class="text-gray-400 inline-block ml-1">(任意)</div></span>
            </label>
            <input type="date" name="start_date" class="input input-bordered w-full">
            
            <label for="due_date" class="label">
                <span class="label-text">期限日<div class="text-gray-400 inline-block ml-1">(任意)</div></span>
            </label>
            <input type="date" name="due_date" class="input input-bordered w-full">
        
        </div>

            <button type="submit" class="btn btn-primary btn-outline">投稿</button>
        </form>
    </div>
@endsection