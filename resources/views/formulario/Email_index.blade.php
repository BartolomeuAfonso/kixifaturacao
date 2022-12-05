<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Send Email Example</title>
</head>
<body>
    @if (count($errors))>0
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert"></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif
    <form method="POST" action="{{ url('sendemail') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Enter Your Name</label>
            <input type="text" name="name" class="form-control" />
        </div>
        <div class="form-group">
            <label>Enter Your E-mail</label>
            <input type="text" name="email" class="form-control" />
        </div>

        <div class="form-group">
            <label>Enter Your E-mail</label>
            <textarea type="text" name="message" class="form-control">
                </textarea>
        </div>


        <div class="form-group">
        
            <input type="submit" name="message" class="btn btn-info">
        </div>
    </form>
</body>
</html>
