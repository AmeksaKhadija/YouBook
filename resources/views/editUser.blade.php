<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edite page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <form action="{{route('user.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Nom :</label>
            <input type="text" class="form-control" id="title" name="name" value="{{ old("name", $user->name ?? null) }}" >
        </div>
        <div class="form-group">
            <label for="prix">Email :</label>
            <input type="email" class="form-control" id="prix" name="email" value="{{ $user->email }}" >
        </div>
        <select class="form-control" name="role_id" data-placeholder="choose a role">
            @foreach($roles as $role)
            <option value="{{ $role->id }}" @if($role->id == $user->id_role) selected @endif>
                {{ $role->name }}
            </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
