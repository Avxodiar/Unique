<div class="form">
    <form action="{{ route('home') }}#contact" method="post">
        {{ csrf_field() }}

        {{-- Сообщение об успешной отправке --}}
        @if (session('mail-status'))
            <div class=" alert alert-success">
                {{ session('mail-status') }}
            </div>
        @endif

        {{-- Сообщение об ошибке отправления --}}
        @error('mail-status')
            <div class="input-text alert-danger">
                {{$errors->first('mail-status')}}
            </div>
        @enderror

        <label for="contact-name">Ваше имя:</label>
        @error('name')
            <p class="contact-field-error">
                {{$errors->first('name')}}
            </p>
        @enderror
        <input name="name" id="contact-name" class="input-text" type="text" value="{{ old('name') }}" placeholder="введите ваше имя" required>

        <label for="contact-email">Ваш почтовый адрес:</label>
        @error('email')
            <p class="contact-field-error">
                {{$errors->first('email')}}
            </p>
        @enderror
        <input name="email" id="contact-email" class="input-text" type="text"  value="{{ old('email') }}" placeholder="введите ваш email" required>

        <label for="contact-message">Текст сообщения</label>
        @error('message')
            <p class="contact-field-error">
                {{$errors->first('message')}}
            </p>
        @enderror
        <textarea name="message" id="contact-message" class="input-text text-area" cols="0" rows="0" required>{{ old('message') }}</textarea>

        <input class="input-btn" type="submit" value="Отправить">
    </form>
</div>
