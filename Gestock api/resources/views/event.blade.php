<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto max-w-lg p-6 bg-white rounded-lg shadow-lg">
        <div class="header text-center py-4 bg-blue-500 text-white rounded-t-lg">
            <img src="{{url('img/téléchargement (4).jfif')}}" alt="">
            <h1 class="text-2xl">{{ $data['title'] }}</h1>
        </div>
        <div class="content p-6">
            <p>{{ $data['message'] }}</p>
        </div>
        <div class="footer text-center py-4 bg-gray-200 rounded-b-lg">
            <p>Merci d'utiliser notre application !</p>
        </div>
    </div>
</body>
</html>