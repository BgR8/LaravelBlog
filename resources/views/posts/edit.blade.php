@extends('main')

@section('title', '| Gönderiyi Düzenle')

@section('css')
    {{Html::style('css/select2.min.css')}}
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({
        selector:'textarea'
        });
    </script>
@endsection

@section('content')
<div class="row">
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="col-md-8">
                {{Form::label('title', 'Title:')}}
                {{Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}

                {{Form::label('slug', 'Slug:', ['class' => 'form-spacing-top'])}}
                {{Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255'])}}

                {{ Form::label('category_id', 'Category:') }}
                {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

                {{ Form::label('tags', 'Tag:') }}
                {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

                {{ Form::label('featured_img', 'Update Featured Image:') }}
                {{ Form::file('featured_img' ) }}

                {{Form::label('body', 'İçerik:', ['class' => 'form-spacing-top'])}}
                {{Form::textarea('body', null, ['class' => 'form-control', 'required' => ''])}}
        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At: </dt>
                    <dd>{{ date('M j, Y H:i', strtotime($post->created_at))}}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Updated: </dt>
                    <dd>{{ date('M j, Y H:i', strtotime($post->updated_at))}}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), ['class' => 'btn btn-danger btn-block']) !!}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    </div> <!-- /.row-->
@endsection

@section('js')
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection
