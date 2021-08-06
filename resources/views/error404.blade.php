@extends('layouts.app')
<title>Error404</title>
@section('content')


<div class="container">
    <div class="text-center">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    К сожалению, запрашиваемая вами страница не найдена.
                </div>
                <br>
                <div class="error-actions">
                    <a href="http://laraveltest.loc/page/" class="btn btn-primary btn-lg"><span
                            class="glyphicon glyphicon-home"></span>
                        На главную </a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
