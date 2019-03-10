@extends('main')

@section('title', '| Yeni Gönderi Oluştur')

@section('css')
    {!! Html::style('css/parsley.css') !!}
    {{Html::style('css/select2.min.css')}}
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({
        selector:'textarea',
        plugins: 'link code',
		menubar: true
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1><b>Yeni Gönderi Oluştur</b></h1>
            <hr />

            {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
                {{Form::label('title', 'Title:')}}
                {{Form::text('title', '', ['class' => 'form-control', 'required' => '', 'maxlength' => '255', 'placeholder' => 'Başlık'])}}

                {{Form::label('slug', 'Slug:')}}
                {{Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255'])}}

                {{ Form::label('category_id', 'Category:') }}
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name}} </option>
                    @endforeach

                </select>

                {{ Form::label('tags', 'Tag:') }}
                <select name="tags[]" id="" class="form-control select2-multi" multiple="multiple">
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"> {{ $tag->name}} </option>
                    @endforeach

                </select>

                {{ Form::label('featured_image', 'Upload Featured Image:') }}
                {{ Form::file('featured_image') }}

                {{Form::label('body', 'Post Body:')}}
                {{Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'İçerik Giriniz'])}}

                {{Form::submit('Create Post', ['class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection
