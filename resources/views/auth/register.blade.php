@extends('auth.layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Student Registration') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="regno" class="col-md-4 col-form-label text-md-right">{{ __('Registration No') }}</label>

                            <div class="col-md-3">
                                <input id="regno" type="text" class="form-control{{ $errors->has('regno') ? ' is-invalid' : '' }}" name="regno" value="{{ old('regno') }}" required autofocus>

                                @if ($errors->has('regno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('regno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" readonly type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" readonly type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <div class="error_msg alert-warning"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('keyup','#regno',function(){

                var regno=$(this).val();
                var error_msg=" ";
                //console.log(regno);

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('userregistration')!!}',
                    data:{'id':regno},

                    success:function(data){
                        // console.log("success");
                        // console.log(data);
                        console.log(data.length);

                            $('#name').val(" ");
                            $('#email').val(" ");

                        for(var i=0; i< data.length;i++)
                        {
                            $('#name').val(data[i].name);
                            $('#email').val(data[i].email);
                        }
                        if(data.length == 0)
                            {
                            $('.error_msg').html('Record doesnot exist in our Database. Kindly contact Administrator.');
                            }
                        else{
                            $('.error_msg').html('A verification link will will be sent to the linked e-mail. Please verify before login.');
                        }
                    },
                    error:function(){

                    }

                });

            });
        });
    </script>

@endsection
