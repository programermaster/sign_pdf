@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Pdf') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Pdf') }}</label>

                            <div class="col-md-6">
                                <input id="pdf" type="file" class="form-control @error('pdf') is-invalid @enderror"
                                name="pdf" autocomplete="pdf">

                                @error('pdf')
                                <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <canvas id="signature-pad" class="signature-pad" style="width:300px" height=200></canvas>
                            </div>

                            <textarea id="signature64" name="signed_image" style="display: none"></textarea>

                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>

    </script>
    <style>
        .signature-pad {
            border:1px solid black;
        }
    </style>
@endsection
