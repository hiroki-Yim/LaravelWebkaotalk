@extends('layouts.master')
@section('title') 정보수정 페이지
@endsection

@section('head')
@include('Components.head')
<link rel="stylesheet" type="text/css" href="{{asset('css/registerForm.css')}}" />
@endsection

@section('registerFormContent')
<div class="container" id="msform">
    <fieldset>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="fs-title">{{ __('UpdateYourAccount') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail(ID)') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" pattern="(\w+\.)*\w+@(\w+\.)+[A-Za-z]+"
                                        title="이메일 형식으로 입력해 주세요!" placeholder="{{$profile['email']}}" required readonly>
                                    @if ($errors->has('email'))
                                    <span class=" invalid-feedback " role="alert ">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label for="password " class="col-md-4 col-form-label text-md-right ">{{ __('Password')
                                    }}</label>

                                <div class="col-md-6 ">
                                    <input id="password " type="password " class="form-control{{ $errors->has('password')
                                    ? ' is-invalid' : '' }}"
                                        name="password" pattern=".{6,}" title="6자 이상 입력 해 주세요!" placeholder="비밀번호 6자 이상"
                                        required> @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{
                                    __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nickname" class="col-md-4 col-form-label text-md-right">{{ __('nickname')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="nickname" type="text" class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}"
                                        name="nickname" value="{{ old('nickname') }}" placeholder="{{$profile['nickname']}}"
                                        required> @if ($errors->has('nickname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        name="phone" placeholder="{{$profile['phone']}}" required>
                                    @if($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span> @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="submit action-button">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
@endsection
