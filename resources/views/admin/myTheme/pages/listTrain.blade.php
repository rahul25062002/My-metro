@extends('admin.myTheme.layout')

@section('listTrain')
    <div class='pl-4 pr-4 flex justify-center border-0 ' ng-controller="getTrains">
        <div class='w-[65%]'>
            <ul class='flex justify-between bg-gray-400 border-solid border-b-4 border-gray-50 '>
                <li class='bg-red-100 w-12 '>s.no</li>
                <li>Train name</li>
                <li>Start from</li>
                <li>End at</li>
                <li>Start Time</li>
            </ul>
            <ul class='flex justify-between bg-blue-100'>
                <li class='bg-red-100 w-12' >1</li>
                <li>metro-150</li>
                <li>Noida Electronic City</li>
                <li>Dwarika</li>
                <li>6:50 AM</li>
            </ul>
        </div>
          <% leng %> 
    </div>

    <script>
         nexgiApp.controller('getTrains',function ($scope){

            $scope.searchProducts=function(){
                var response = '';
        $.ajax({
            type: "GET",
            url: "http://local.mymetro.com/getAllTrains",
            async: false,
            success: function(text) {
                response = text;
            }
        });

        alert(response);
  
            

            angular.element(document).ready(function () {
		        $scope.searchProducts();
    });
         
     }});    
    </script>
    
@endsection