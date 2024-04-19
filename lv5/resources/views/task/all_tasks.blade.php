@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Available Tasks') }}</div>

                <div class="card-body">
                    @foreach ($tasks as $task)
                    <div class="card mb-3">
                        <div class="card-body">

                            @if(session('message'))
                            <p>{{ session('message') }}</p>
                            @endif

                            <h5 class="card-title">{{ $task->name }}</h5>
                            <p class="card-text"><strong>Name Eng:</strong> {{ $task->name_eng }}</p>
                            <p class="card-text"><strong>Description:</strong> {{ $task->description }}</p>
                            <p class="card-text"><strong>Study Program:</strong> {{ $task->study_program }}</p>
                            <a href="{{ route('task.apply', $task->id) }}" class="btn btn-primary">{{ __('Apply') }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection