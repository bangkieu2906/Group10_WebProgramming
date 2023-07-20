<!DOCTYPE html>
<html>
<head>
    <title>Custom Valdiation Rule on Laravel 5.6</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Custom Valdiation Rule on Laravel 5.6</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('custom') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Text</label>

                                <div class="col-md-6">
                                    <input type="text" name="text" 
                                        class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}"
                                        value="{{ old('text') }}" 
                                        required autofocus>

                                    @if ($errors->has('text'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Number</label>

                                <div class="col-md-6">
                                    <input type="text" name="number" 
                                        class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" required>

                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Let's Go
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
