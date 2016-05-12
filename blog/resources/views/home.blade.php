@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">All Topics</div>

                <div class="panel-body">
                    
                <!-- Test Home -->
                    @if (isset($message))
                        {{$message}}
                    @endif
                    <div class="row text-right">
                        <a href="{{url('/posts/new')}}" class="btn btn-info">New Article</a>    
                    </div><br>
                    
                    <table class="table text-center table-hover table-bordered">
                        <tr>
                            <th >#</th>
                            <th>Auther Namae</th>
                            <th>title</th>
                            <th>Action</th>
                        </tr>
                         
                          @for ($i = 0; $i < count($articles)  ; $i++)
                                    <?php $index = $i; ?>
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><?php echo $articles[$i]->name ?></td>
                                        <td>{{ $articles[$i]->title }}</td>
                                        <td>
                                            <a href="<?php echo  url('/posts/') ?>/{{$articles[$i]->id}}" class="btn btn-info">View</a>
                                            <a href="/posts/?post_id={{ $articles[$i]->id }}" class="btn btn-info">Update</a>
                                            <a href="posts.php?post_id={{ $articles[$i]->id }}" class="btn btn-info">Delete</a>
                                        </td>
                                    </tr>            
                                
                            @endfor
                                   
                        
                                   
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
