<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Mymetro</title>
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="css/custom-style.css">

   
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
    </script>
    <script>
        var nexgiApp = angular.module('nexgiApp', [], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });
    </script>
</head>
<body ng-cloak ng-app="nexgiApp" >

    {{-- header --}}
  @include("admin.myTheme.component.header");
  
  @hasSection ('listTrain')
    @yield('listTrain')
  @else
    no content found!
  @endif
 
    
</body>
</html>