@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in as ') }} {{ Auth::user()->role }}{{ __('!') }}

                    @if(auth()->user()->role === 'admin')
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">{{ __('Manage Users') }}</a>
                    </div>
                    @endif
                    @if(auth()->user()->role === 'professor')
                    <div class="text-center mt-3">
                        <a href="{{ route('task.create') }}" class="btn btn-primary">{{ __('Create Task') }}</a>
                    </div>
                    @endif
                    @if(auth()->user()->role === 'student')
                    <div class="text-center mt-3">
                        <a href="{{ route('task.all_tasks') }}" class="btn btn-primary">{{ __('View Available Tasks') }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection