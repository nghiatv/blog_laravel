@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif

                        <div class="callout callout-info">
                            <h4>Vui lòng check mail nhá</h4>

                            <p>Check mail nhé cu.Anh gửi mail trong cái mail em vừa gửi rồi đấy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.ready(function () {
            setTimeout(function () {
                window.location = {{url('/login')}}
            }, 200)
        })

    </script>
    @endpush

@endsection
