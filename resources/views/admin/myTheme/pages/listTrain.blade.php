@extends('admin.myTheme.layout')

@section('listTrain')
    <div class='pl-4 pr-4 flex justify-center  flex-col ' ng-controller="getTrains">
        
        <div class="py-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" ng-click='addTrain()' >Add Trains</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" ng-click='addRoute()'>Add Routes</button>
        </div>
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
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" ng-click='edit( index )'>Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" ng-click='delete( train.Train_no )'>Delete</button>
                    </li>
                    
                </ul>


                <toaster-container toaster-options="{'positionClass': 'toast-top-right'}"></toaster-container>
            </div>
        </div>


           
        <div class='bg-red-200 w-[96%] border border-black px-2 modalEdit absolute  top-[15%] hidden '>
              <form action="" class='flex flex-col gap-4 items-center w-[80%]'>
                <span>Edit the train</span>
                <% allTrain[particularTrain] %>
                <div class='flex gap-[15%] border'>
                       
                    <label for="" class='w-[23%] '>
                        Train No.:-
                    </label>
                    <div>
    
                        <input type="text" value='<% allTrain[particularTrain].Train_no %>' readonly>
                    </div>
                </div>
                
                <div class='flex gap-[15%] '>

                    <label for=""  class='w-[23%] '>
                        Start From :-
                    </label>
                    <div>
    
                        <input type="text" value='<% allTrain[particularTrain].stationFrom %>'>
                    </div>
                </div>

                 <div class='flex gap-[15%] '>

                     <label for=""  class='w-[23%] '>
                         End At :-
                     </label>
                     <div>
     
                         <input type="text"  value='<% allTrain[particularTrain].stationTo %>'>
                     </div>
                 </div>
                
                 <div class='flex gap-[15%] '>

                     <label for=""  class='w-[23%]  '>
                         Start Time :-
                     </label>
                     <div >
                        <% selectedStartTime[1]%>
                        
                         <select name="" id="" class='appearance-none w-8 text-center' ng-model=' selectedStartTime[0]'>
                             <option  ng-repeat='hr in h' ><% hr %></option>
                         </select>
                         <select name="" id="" class='appearance-none w-8 text-center' ng-model='selectedStartTime[1]'>
                             <option  ng-repeat='min in m'  ><% min %></option> 
                            
                         </select>
                         <select name="" id=""  ng-model='selectedStartTime[2]'>
                             <option value="a" ng-repeat='a in ["AM","PM"]' ><% a %></option>
                         </select>
                     </div>
                 </div>
               
                 <div class='flex gap-[15%] '>

                     <label for=""  class='w-[23%] '>
                         End Time :-
                     </label>
                         <div>
     
                             <select name="" id="" class='appearance-none w-8 text-center'>
                                 <option value="hr" ng-repeat='hr in h'><% hr %></option>
                             </select>
                             <select name="" id="" class='appearance-none w-8 text-center some'>
                                 
                                 <option value="min" ng-repeat='min in m'  ><% min %></option> 
                                 
                                 
                             </select>
                             <select name="" id="" >
                                 <option value="a" ng-repeat='a in ["AM","PM"]' ><% a %></option>
                             </select>
                         </div>
                 </div>
               
                 <button ng-click='closeMode' class='bg-red-500 w-16 rounded p-2'>Submit</button>
              </form>
    
        </div>


    </div>



    <script>
         nexgiApp.controller('getTrains',function ($scope,$http,toastr){
          
         $scope.addTrain=function (){
            console.log("clicked to add train");
            window.location.href = '/addTrain';
         } 
         
         $scope.addRoute=function(){
            console.log("clicked to add Route")
         }


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
             $scope.particularTrain;

            $scope.edit=function ($id){
                let v=document.querySelector('.modalEdit').classList.remove('hidden');
                $scope.particularTrain=$id;
               $scope.selectedStartTime= $scope.handleTimefun( $scope.allTrain[ $scope.particularTrain].startTime);
               $scope.selectedEndTime= $scope.handleTimefun( $scope.allTrain[ $scope.particularTrain].endTime);
                console.log(typeof  $scope.selectedStartTime[0])
                console.log(typeof $scope.h[0])
                // console.log(  $scope.allTrain  );
            };

         $scope.handleTimefun=function ($data){
            let temp=$data.split(':');
            let temp2=temp[1].split(' ');
            
            return  [temp[0] , temp2[0] , temp2[1]]; 
         }

            $scope.closeMode=function (){
                document.querySelector('.modalEdit').classList.add('hidden');
            }




            $scope.delete=function ($id){
                alert('Are you sure Want to delete this')
                $http.delete("/delete/"+$id).then((res)=>
                {

                    if(res.data.succ){
                        toastr.success(res.data.public_msg, 'Delete');
                    
                    }
                    else{
                        toastr.error(res.data.public_msg, 'Delete') 
                    }
                }
                
            ).catch((err)=> toastr.error(err.message, 'Delete'));
               
            };
            $scope.h=[];
            $scope.m=[];
            $scope.hours=function (){
                let hour=[];
                for(let i=1;i<=12;i++){
                    let temp=i.toString();
                    if(temp.length==1){
                        temp='0'+temp;
                    }
                    hour.push(temp);
                }
                 console.log(hour)
                $scope.h= hour;
            };
            


            

            $scope.mins=function (){
                let min=[];
                for(let i=1;i<=60;i++){
                    let temp=i.toString();
                    if(temp.length==1){
                        temp='0'+temp;
                    }
                    min.push(temp);
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