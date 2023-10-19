@extends('admin.main-page')

@section('title', "Редактирование почты для рассылки")

@section('content')

<h3 class="text-center mb-4">Редактирование почтового ящика для рассылки</h3>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <form action="{{route('mailer-update.update', $email->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="mail_username" class="form-label">Email</label>
                    <input type="email" class="form-control" id="mail_username" name="mail_username" value="{{old('mail_username', $email->mail_username)}}">
                    @error('mail_username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mail_host" class="form-label">Сервер исходящей почты</label>
                    <input type="text" class="form-control" id="mail_host" name="mail_host" value="{{old('mail_host', $email->mail_host)}}">
                    @error('mail_host')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mail_port" class="form-label">Порт SMTP</label>
                    <input type="text" class="form-control" id="mail_port" name="mail_port" value="{{old('mail_port', $email->mail_port)}}">
                    @error('mail_port')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mail_encryption" class="form-label">Протокол шифрования</label>
                    <input type="text" class="form-control" id="mail_encryption" name="mail_encryption" value="{{old('mail_encryption', $email->mail_encryption)}}">
                    @error('mail_encryption')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mail_password" class="form-label">Пароль для внешнего приложения</label>
                    <input type="password" class="form-control" id="mail_password" name="mail_password" value="{{old('mail_password', $email->mail_password)}}">
                    @error('mail_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-info btn-sm">Редактировать</button>
                <a role="button" class="btn btn-danger btn-sm" href="{{ route('mailer-list.index') }}">Отмена</a>


            </form>

        </div>
    </div>
@endsection
