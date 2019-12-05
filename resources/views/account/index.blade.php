@extends("layouts.app")

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        {!! \Form::open()->route('account.change_password') !!}

                        {!! \Form::text('current_password', "Current Password")->type('password') !!}
                        {!! \Form::text('password', "New Password")->type('password') !!}
                        {!! \Form::text('password_confirmation', "Confirm New Password")->type('password') !!}

                        {!! \Form::submit('Change Password') !!}

                        {!! \Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
