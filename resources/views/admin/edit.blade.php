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

    @if (count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                        </div>

                        <div class="form-group">
                            <label for="inputAlias">Псевдоним</label>
                            <input type="text" id="inputAlias" name="alias" class="form-control form-control-lg" placeholder="псевдоним" value="{{ old('alias', $list['alias']) }}" required>
                        </div>


                        <div class="form-group">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio-image" id="radio-text" value="text" checked>
                                <label class="form-check-label" for="radio-text">
                                    Текущее изображение
                                </label>
                            </div>
                            <div class="custom-file mb-3">
                                <label class="visually-hidden" for="input-image">Текущее изображение</label>
                                <input type="text" id="input-image" name="images" class="form-control form-control-lg" placeholder="Изображение" value="{{ old('images', $list['images']) }}" required>

                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio-image" id="radio-file" value="file">
                                <label class="form-check-label" for="radio-file">
                                    Загрузить
                                </label>
                            </div>
                            <div class="custom-file mb-3">
                                <input type="file" name="images" class="custom-file-input" id="input-file" required disabled>
                                <label class="custom-file-label form-control-lg" for="input-file">Choose file...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>

                        </div>

                    </div>

                    <div class="col">
                        <label>Текущее изображение</label>
                        @if ($noImage)
                        <img src="{{ asset('assets/img/no_image.png') }}" alt="" class="img-thumbnail float-right">
                        @else
                        <img src="{{ asset('assets/img/' . $section . '/'. $list['images']) }}" alt="" class="img-thumbnail float-right min-w125">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="editor">Текст</label>
                    <textarea id="editor" name="content" class="form-control form-control-lg" rows="10" required>{{ old('content', $list['content']) }}</textarea>
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


