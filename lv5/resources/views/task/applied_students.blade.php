@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Applied Students') }}</div>

                <div class="card-body">
                    @if ($appliedStudents->count() > 0)
                    <ul class="list-group">
                        @foreach ($appliedStudents as $student)
                        <li class="list-group-item">{{ $student->name }}</li>
                        @endforeach
                    </ul>
                    @else
                    <p>No students have applied for this task yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection