@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            
                <div class="page-header">{{ $article[0]->title}}</div>
                {{ $article[0]->mytext }}


                <hr>

                @if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

                {!! Form::open(array('url' => '/comments/create')) !!}
				     
				    {{Form::textarea('text', ''  ,array('class' => 'form-control' , 'name' => 'mytext'  , 'placeholder' => 'Please Enter Article Title'))}}
				    {{Form::hidden('text', Auth::user()->id ,array('class' => 'form-control'  ,  'name' => 'u_id'  ))}}
				    {{Form::hidden('text', $article[0]->p_id ,array('class' => 'form-control'  ,  'name' => 'post_id'  ))}}
					<br>
					{{Form::submit('Comment' , array('class'=>'btn btn-info' , 'name' => 'submit' ))}}
				{!! Form::close() !!}	
                
                <hr>
                
                
                @for ($i = 0; $i < count($comments) ; $i++)
                	<div class="row">
	                	{{$comments[$i]->mytext}}
	                </div>
	                @if (Auth::user()->id == $comments[$i]->u_id)
                        <div class="row text-right"><a href="<?php echo  url('/comments/') ?>/{{$comments[$i]->id}}">Delete</a></div>
                    @endif
	                
                @endfor
            
        </div>
    </div>
</div>
@endsection
