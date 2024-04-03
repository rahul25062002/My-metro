@extends('admin.myTheme.layout')

@section('listTrain')
    <div class='pl-4 pr-4 flex justify-center border-0 flex-col ' ng-controller="getTrains">
        <div class='w-[95%]'>
            <ul class='flex justify-between gap-y-6 bg-gray-400 border-solid border-b-4 border-gray-50 '>
                <li class='bg-red-100 w-12  text-center'>s.no</li>
                <li class='bg-red-700 w-12 text-gray-100 text-center'>Train No</li>
                <li>Train name</li>
                <li>Start from</li>
                <li>Station To</li>
                <li>Start Time</li>
                <li>Operations</li>
                

            </ul>
            <div     ng-repeat='(index ,train) in allTrain' >

                <ul class='flex justify-between gap-y-6 bg-blue-100  border-solid border-b-4 border-gray-50 px-2' >
                    <li class=' w-12 text-center '><% index+1 %></li>
                    <li class=' w-12 text-center  '><% train.Train_no %></li>
                    <li><% train.stationFrom %></li>
                    <li><%train.stationTo %></li>
                    <li><% train.startTime %></li>
                    <li><% train.startTime %></li>
                    <li>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" ng-click='edit(train.Train_no )'>Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" ng-click='delete( train.Train_no )'>Delete</button>
                    </li>
                    
                </ul>
            </div>
        </div>


           
        <div class='bg-red-200 w-[60%] border border-black px-2 '>
              <form action="" class='flex flex-col gap-4'>
                <span>Edit the train</span>

                <label for="">
                    Train No.
                    <input type="text">
                </label>

                <label for="">
                    Start From
                    <input type="text">
                </label>

                <label for="">
                    End At
                    <input type="text">
                </label>

                <label for="">
                    Start Time
                    <select name="" id="" class='appearance-none'>
                        <option value="hr" ng-repeat='hr in h'><% hr %></option>
                    </select>
                    <select name="" id="" class='appearance-none'>
                        <option value="min" ng-repeat='min in m'  ><% min %></option> 
                    </select>
                    <select name="" id="" >
                        <option value="a" ng-repeat='a in ["AM","PM"]' ><% a %></option>
                    </select>
                </label>

                <label for="">
                    End Time
                    <input type="time">
                </label>
                
              </form>
    
        </div>


    </div>



    <script>
         nexgiApp.controller('getTrains',function ($scope,$http){
                     $scope.allTrain='';
         $scope.searchProducts=function(){
                
                $http.get("http://local.mymetro.com/getAllTrain")
                .then(function (response) {
                    $scope.allTrain=response.data.data.data; 
                    
                })
                .catch(function (error) {
                    console.error('Error:', error);
                });

            };

            $scope.edit=function ($id){
                console.log($id);
            };
            $scope.delete=function ($id){
                console.log($id);
            };
            $scope.h=[];
            $scope.m=[];
            $scope.hours=function (){
                let hour=[];
                for(let i=1;i<=12;i++){

                    hour.push(i.toString());
                }
                 console.log(hour)
                $scope.h= hour;
            };
            


            

            $scope.mins=function (){
                let min=[];
                for(let i=1;i<=60;i++){
                    
                    min.push(i.toString());
                }

                $scope.m=min;
            };




        
  
       
            
         
        

            
            
            
            angular.element(document).ready(function () {
		        $scope.searchProducts();
                $scope.mins();
                $scope.hours();

              }
              
              );
    });    
    </script>


    
@endsection