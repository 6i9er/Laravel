@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            
                <h1 class="page-header">New Article</h1>
                @if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

                {!! Form::open(array('url' => '/posts/update')) !!}
				     
				    {{Form::label('email', 'Article Title :')}} 
				    {{Form::text('text', $article[0]->title ,array('class' => 'form-control' , 'name' => 'title' , 'placeholder' => 'Please Enter Article Title'))}}
				    {{Form::label('email', 'Article  :')}} 
				    {{Form::textarea('text', $article[0]->mytext ,array('class' => 'form-control' , 'name' => 'mytext'  , 'placeholder' => 'Please Enter Article Title'))}}
				    {{Form::hidden('text', Auth::user()->id ,array('class' => 'form-control' ,  'name' => 'u_id'  ))}}
				    {{Form::hidden('text', $article[0]->p_id ,array('class' => 'form-control' ,  'name' => 'post_id'  ))}}
					<br>
					{{Form::submit('Confirm!' , array('class'=>'btn btn-info' , 'name' => 'submit' ))}}
				{!! Form::close() !!}	
            
        </div>
    </div>
</div>
@endsection
