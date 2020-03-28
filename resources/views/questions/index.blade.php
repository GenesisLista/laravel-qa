@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- This is the message alert -->
                    @include ('layouts._messages')

                    <!-- This is to display the question in loop -->
                    @foreach ($questions as $question)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{ $question->votes }}</strong> {{ str_plural('vote', $question->votes) }}
                            </div>
                            <div class="status {{ $question->status }}">
                                <strong>{{ $question->answers }}</strong> {{ str_plural('answer', $question->answers) }}
                            </div>
                            <div class="view">
                                {{ $question->views . " " . str_plural('view', $question->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center">
                                <h3 class="mt-0"> <a href="{{ $question->url }}"> {{ $question->title }} </a> </h3>
                                <div class="ml-auto">
                                    <!-- This is for the Authorization - AuthServiceProvider.php and QuestionsController.php -->
                                    @if (Auth::user()->can('update-question', $question))
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                    @endif
                                    @if (Auth::user()->can('delete-question', $question))
                                        <form class="form-delete" method="post" action="{{ route('questions.destroy', $question->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            <p class="lead">
                                Asked by
                                <a href="{{ $question->user->url }}"> {{ $question->user->name }} </a>
                                <small class="text-muted"> {{ $question->created_date }} - {{ $question->created_date_format }} </small>
                            </p>
                            {{ str_limit($question->body, 250) }}
                        </div>
                    </div>
                    <hr>
                   @endforeach

                   <!-- This is for the pagination links -->    
                   {{ $questions-> links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection