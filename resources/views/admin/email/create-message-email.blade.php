@extends('admin.main-page')

@section('title', 'Создание email письма')

@section('content')
    <h3 class="text-center mb-4">Создание email письма</h3>

    <div>
        <div class="col-md-12 d-flex flex-column justify-content-center align-items-center">
            <form action="{{ route('emails.shipped.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="subject_email" class="form-label">Тема письма</label>
                    <input type="text" class="form-control" id="subject_email" name="subject_email"
                        value="{{ old('subject_email') }}">
                    @error('subject_email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <select class="form-select" multiple aria-label="multiple select example" name = 'to_email[]' size="5">
                        <option selected disabled>Держите клавишу ctrl для выбора несколько Emails получателя</option>
                        @foreach ($emails as $email)
                        <option value="{{$email->id}}" {{collect(old('to_email'))->contains($email->id) ? 'selected': ''}}
                            >{{$email->email}}</option>
                        @endforeach
                    </select>
                    @error('to_email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <textarea id="email_text" name="email_text" rows="10" cols="50" placeholder="Текст письма">{{ old('email_text') }}</textarea>
                    <div>
                        @error('email_text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-info btn-sm">Отправить</button>
                <a role="button" class="btn btn-danger btn-sm" href="{{ route('emails.index') }}">Отмена</a>


            </form>

        </div>
    </div>
@endsection
