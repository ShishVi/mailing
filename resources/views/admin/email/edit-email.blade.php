@extends('admin.main-page')

@section('title', "Редактирование почты {$email->email}")

@section('content')
<h3 class="text-center mb-4">Редактирование почты {{$email->email}}</h3>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <form action="{{route('emails.update', $email->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="first_name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name', $email->first_name)}}">
                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name', $email->last_name)}}">
                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email', $email->email)}}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>               
                
                <button type="submit" class="btn btn-info btn-sm">Сохранить</button>
                <a role="button" class="btn btn-danger btn-sm" href="{{ route('emails.index') }}">Отмена</a>


            </form>

        </div>       
    </div>
@endsection