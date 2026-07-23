@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
<div class="card stat-card p-4" style="max-width:500px;">
    <h5 class="mb-3">Edit Category</h5>
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" value="{{ old('category_name', $category->category_name) }}" required autofocus>
        </div>
        <button class="btn btn-danger">Update Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection
