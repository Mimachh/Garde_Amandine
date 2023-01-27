<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">          
    <title>{{ $title }}</title>
</head>
<body>
    <div class="container mt-5">
        <div class="mb-5">
            LOGO DU SITE ET INFO SOCIETE
        </div>
        <h2 class="fs-5 text-center mb-3 text-red-600">{{ $title }}</h2>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Dates</th>
                    <th scope="col">Nom du propriétaire</th>
                    <th scope="col">Nom du gardien</th>
                    <th scope="col">Prix total de la garde</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Du {{ $start_watch }} au {{$end_watch}}</th>
                    <td>{{$owner}}</td>
                    <td>{{$keeper}}</td>
                    <td>{{$price}} €</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
