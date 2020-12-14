<form action="{{ route( $actionType . '-people', $list['id']) }}" class="form-horizontal" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="inputName">Имя</label>
                <input type="text" class="form-control form-control-lg" id="inputName" name="name" placeholder="имя"  value="{{ old('name', $list['name']) }}" required>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPosition">Должность</label>
                <input type="text" id="inputPosition" name="position" class="form-control form-control-lg" placeholder="Должность" value="{{ old('position', $list['position']) }}" required>
                @error('position')
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

        <div class="col d-flex flex-column">
            <label>Текущее изображение:</label>
            <div class="m-auto">
                <img src="{{ asset($imageToShow) }}" alt="" class="img-thumbnail float-right min-w125">
            </div>
            <p class="text-secondary text-center">{{ $list['images'] }}</p>
        </div>
    </div>

    <div class="form-group">
        <label for="editor">Текст</label>
        <textarea id="editor" name="text" class="form-control form-control-lg" rows="10" required>{{ old('text', $list['text']) }}</textarea>
        @error('text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <a class="btn btn-lg btn-outline-info" href="{{ route('people-list') }}">Вернуться к списку</a>
        <button type="submit" class="btn btn-lg btn-outline-warning w-50 mx-3">Сохранить</button>
        <button type="reset" class="btn btn-lg btn-outline-secondary">Cбросить</button>
    </div>
</form>
