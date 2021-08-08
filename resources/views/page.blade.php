@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="text-center">Сервис по сокращению ссылок</h1>


        <form method="post" action="{{ route('short.link.post') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="url" class="form-control" name="link" placeholder="URL">
                <input type="text" class="form-control" name="limit" placeholder="Лимит переходов">
                <input type="time" class="form-control" name="time_to_die" placeholder="Время жизни ссылки">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Исходная ссылка</th>
                <th>Сокращенная ссылка</th>
                <th>Переходов по ссылке</th>
                <th>Лимит переходов по ссылке</th>
                <th>Время конца жизни ссылки</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shortLinks as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->request_link }}</td>
                    <td>
                        <a href="{{ route('short.link.token', $link->token_link) }}"
                           target="_blank">{{ route('short.link.token', $link->token_link) }}</a>
                    </td>
                    <td>{{ $link->count_limit }}</td>
                    @if($link->attendance_limit == 0)
                        <td>Нету лимита переходов</td>
                    @else
                        <td>{{ $link->attendance_limit }}</td>
                    @endif
                    <td>{{ $link->time_to_die }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @stop
    </div>
