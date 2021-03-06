@extends('main')

@section('title', "| ".e($post->title))

@section('content')

	<div class="row">
		<div class="col-md-8 offset-md-2">

			<h1>{{ $post->title }}</h1>
			<div class="tags" style="margin-bottom: 20px;">
				@foreach($post->tags as $tag)
				<span class="badge badge-secondary">{{ $tag->name }}</span>
				@endforeach
			</div>
			<img src="{{ asset('images/' . $post->image) }}" class="img-fluid"/>
			<p>{!! $post->body !!}</p>
			<p>Category: <span class="badge badge-light">{{ $post->category->name }}</span></p>
		</div>
	</div>
	<hr />

	<div class="row">

		<div class="col-md-8 offset-md-2">
			<h3 class="comments-title"><span class="fas fa-comments"></span> {{ $post->comments()->count() }} Comments</h3>
			@foreach($post->comments as $comment)
			<div class="comment">
				<div class="author-info">

					<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid" }}" class="author-image">
					<div class="author-name">
						<h4>{{ $comment->name }}</h4>
						<p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
					</div>

				</div>

				<div class="comment-content">
					{{ $comment->comment }}
				</div>

			</div>
			@endforeach
		</div>
	</div>

	<div class="row">
		<div id="comment-form" class="col-md-8 offset-md-2" >
			{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

				<div class="row">
					<div class="col-md-6">
						{{ Form::label('name', "Name:") }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}
					</div>

					<div class="col-md-6">
						{{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, ['class' => 'form-control']) }}
					</div>

					<div class="col-md-12">
						{{ Form::label('comment', "Comment:") }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

						{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
</div>

@stop
