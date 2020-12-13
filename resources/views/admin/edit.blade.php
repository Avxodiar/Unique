@extends('admin.layouts.layout')

@section('nav-button')
    <a class="btn btn-outline-primary min-w125" href="{{ route('logout') }}">Выход</a>
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')

    @error('formError')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            @if (session('id'))
                <br><a href="{{route('edit-' . $section , session('id'))}}">Изменить</a>
            @endif
        </div>
    @endif

    <div class="card mb-5">
        <div class="card-header bg-secondary text-light">
            <h2 class="h4 font-weight-normal">
                {{ $title }}
                @if (isset($id))
                #{{ $id }}
                @endif
            </h2>
        </div>
        <div class="card-body">

            <form action="{{ route( $actionType . '-' . $section, $list['id']) }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputName">Название</label>
                            <input type="text" class="form-control form-control-lg" id="inputName" name="name" placeholder="имя"  value="{{ old('name', $list['name']) }}" required>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputAlias">Псевдоним</label>
                            <input type="text" id="inputAlias" name="alias" class="form-control form-control-lg" placeholder="псевдоним" value="{{ old('alias', $list['alias']) }}" required>
                            @error('alias')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Загрузить изображение</label>
                            <div class="custom-file mb-3">
                                <input type="file" name="images" class="custom-file-input" id="input-file" value="{{ old('images', $list['images']) }}">
                                <label class="custom-file-label form-control-lg" for="input-file">{{ old('images', $list['images']) }}</label>
                                @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col">
                        <label>Текущее изображение:</label>
                        @if ($noImage)
                        <img src="{{ asset('assets/img/no_image.png') }}" alt="" class="img-thumbnail float-right">
                        @else
                        <img src="{{ asset('assets/img/' . $section . '/'. $list['images']) }}" alt="" class="img-thumbnail float-right min-w125">
                        @endif
                        <p class="text-secondary text-right">{{ $list['images'] }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editor">Текст</label>
                    <textarea id="editor" name="content" class="form-control form-control-lg" rows="10" required>{{ old('content', $list['content']) }}</textarea>
                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a class="btn btn-lg btn-outline-info" href="{{ route($section . '-list') }}">Вернуться к списку</a>
                    <button type="submit" class="btn btn-lg btn-outline-warning w-50 mx-3">Сохранить</button>
                    <button type="reset" class="btn btn-lg btn-outline-secondary">Cбросить</button>
                </div>
            </form>

        </div>
    </div>

@endsection


