@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create Project') }}
                </div>

                <div class="card-body">
                    <div class="project-card text-center">

                        @if(session('message'))
                        <p>{{ session('message') }}</p>
                        @endif

                        <form action="{{ route('task.store') }}" method="POST">
                            @csrf
                            <label for="name">Task name:</label><br>
                            <input type="text" id="name" name="name"><br>

                            <label for="name_eng">Task name eng:</label><br>
                            <input id="name_eng" name="name_eng"></input><br>

                            <label for="description">Description:</label><br>
                            <textarea type="text" id="description" name="description"></textarea><br>

                            <label>Select Study Program:</label><br>
                            <div class="form-group">
                                <select class="form-control" id="study_program" name="study_program">
                                    <option value="" disabled selected hidden>{{ __('Select Study Program') }}</option>
                                    <option value="preddiplomski">{{ __('Preddiplomski') }}</option>
                                    <option value="strucni">{{ __('Strucni') }}</option>
                                    <option value="diplomski">{{ __('Diplomski') }}</option>
                                </select>
                            </div><br>
                            <button type="submit" class="btn btn-primary float-right">Create Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection