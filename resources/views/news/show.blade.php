@extends('layouts.master')

@section('title', $news->title)

@section('content')

{{$news->title}}
{{$news->description}}

@endsection

@section('scripts')

@endsection
