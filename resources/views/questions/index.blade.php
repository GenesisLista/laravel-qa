@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Questions</div>

                <div class="card-body">
                   <!-- This is to display the question in loop -->
                   @foreach ($questions as $question)
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mt-0"> {{ $question->title }} </h3>
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