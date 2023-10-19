@extends('admin.main-page')

@section('title', 'Ваша почта для рассылки |')

@section('content')
@if (session('successCreateEmailUser'))
<div class="alert alert-success">
    {{ session('successCreateEmailUser') }}
</div>
@endif
    <div class="row">
        <div class="col-6 col-md-12 border d-flex justify-content-center flex-column">
            @if (!$user_email)
                <h5 class="text-center text-danger">Вы не зарегистрировали почту для рассылки!</h5>
                <div class="d-flex justify-content-end">
                    <a role="button" class="btn btn-info btn-sm mb-3" href="{{ route('mailer-create.create') }}">Зарегистрировать почтовый ящик</a>
                </div>
            @else
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">Host</th>
                            <th scope="col">Port</th>
                            <th scope="col">Encryption</th>
                            <th scope="col">Email</th>
                            <th scope="col">Пароль</th>
                            <th scope='col'>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $user_email->mail_host }}</td>
                                <td>{{ $user_email->mail_port }}</td>
                                <td>{{ $user_email->mail_encryption }}</td>
                                <td>{{ $user_email->mail_username }}</td>
                                <td>{{ $user_email->mail_password }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('mailer-edit.edit', $user_email->id)}}">
                                            <img width="20" height="20" class="img-profile mx-2"
                                                src="{{ asset('assets/img/icon-edit.png') }}">
                                        </a>
                                        <form action="{{route('mailer-destroy.destroy', $user_email->id)}}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-light btn-sm"
                                                onclick='event.preventDefault();
                                    if(confirm("Email: {{ $user_email->mail_username }} будет удален! Продолжить?")){
                                                this.closest("form").submit();
                                            }'>
                                                <img width="20" height="20" class="img-profile"
                                                    src="{{ asset('assets/img/icon-delete.png') }}">
                                            </button>
                                        </form>
                                    </div>


                                </td>
                            </tr>

                    </tbody>
                </table>
        </div>
        @endif
    </div>
@endsection
