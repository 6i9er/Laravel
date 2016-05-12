@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            
                <div class="page-header">{{ $article[0]->title}}</div>
                {{ $article[0]->mytext }}
                
                
            
        </div>
    </div>
</div>
@endsection
