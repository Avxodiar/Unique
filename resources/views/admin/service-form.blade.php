<form action="{{ route( $actionType . '-service', $list['id']) }}" class="form-horizontal" method="post" enctype="multipart/form-data">

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
                <label for="inputIcon">Иконка</label>
                <input type="text" id="inputIcon" name="icon" class="form-control form-control-lg" placeholder="Иконка" value="{{ old('icon', $list['icon']) }}" required>
                @error('icon')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col d-flex flex-column">
            <label>Текущая иконка:</label>
            <div class="service_block">
                <div class="service_icon wow">
                    <span><i class="fa {{ $list['icon'] }}"></i></span>
                </div>
            </div>
            <p class="text-secondary text-center">{{ $list['icon'] }}</p>
        </div>
    </div>

    <div class="form-group">
        <label for="textEditor">Текст</label>
        <textarea id="textEditor" name="text" class="form-control form-control-lg" rows="10" required>{{ old('text', $list['text']) }}</textarea>
        @error('text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <a class="btn btn-lg btn-outline-info" href="{{ route('service-list') }}">Вернуться к списку</a>
        <button type="submit" class="btn btn-lg btn-outline-warning w-50 mx-3">Сохранить</button>
        <button type="reset" class="btn btn-lg btn-outline-secondary">Cбросить</button>
    </div>
</form>
