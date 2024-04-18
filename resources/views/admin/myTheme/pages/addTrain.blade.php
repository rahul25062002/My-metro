@extends('admin.myTheme.layout')

@section('addTrain')
    <div class='pl-4 pr-4 flex justify-center  flex-col m-2 p-2 ' ng-controller="AddTrain">    
        <div class='bg-red-200 w-[100%] border border-black flex  justify-center  top-[15%] p-4 '>
              <form action="" class='flex flex-col gap-4 items-center  border border-black w-[80%] p-4'>
                <span class='font-bold text-2xl '>Add New Trains</span>
                <div class='flex  borde w-[100%]'>
                       
                    <label for="" class='mx-4 w-[5rem]'>
                        Train No.:-
                    </label>
                    
    
                    <input type="text" class='p-1 rounded w-[80%]' value='<% allTrain[particularTrain].Train_no %>' readonly>
                
                </div>
                
                <div class='flex  w-[100%]'>

                    <label for=""  class='mx-2  w-[6rem] '>
                        Start From :-
                    </label>
                    
    
                        <input type="text" class='p-1 rounded w-[80%]' value='<% allTrain[particularTrain].stationFrom %>'>
                
                </div>

                 <div class='flex w-[100%] '>

                     <label for=""  class=' mx-4  w-[5rem]'>
                         End At :-
                     </label>
                     
     
                     <input type="text"  class='p-1 rounded w-[80%]' value='<% allTrain[particularTrain].stationTo %>'>
                     
                 </div>

                 <div class='flex w-[100%] '>

                    <label for=""  class=' mx-4  w-[5rem]'>
                        Route :-
                    </label>
                    
    
                    <input type="text"  class='p-1 rounded w-[80%]' value='<% allTrain[particularTrain].stationTo %>'>
                    
                </div>
                
                <div class='flex w-[100%] border border-black lg:w-[90%] lg:relative lg:right-14' >

                    <div class='flex  mx-2 px-2 w-[60%] items-center  border '>
    
                        <label for=""  class=' w-[6rem]    '>
                            Start Time :-
                        </label>
                        <div >
                           <% selectedStartTime[1]%>
                           
                            <select name="" id="" class='appearance-none w-8 text-center p-1 rounded' ng-model=' selectedStartTime[0]'>
                                <option  ng-repeat='hr in h' ><% hr %></option>
                            </select>
                            <select name="" id="" class='appearance-none w-8 text-center  p-1 rounded' ng-model='selectedStartTime[1]'>
                                <option  ng-repeat='min in m'  ><% min %></option> 
                               
                            </select>
                            <select name="" id="" class='appearance-none w-8 text-center  p-1 rounded'  ng-model='selectedStartTime[2]'>
                                <option  ng-repeat='a in ["AM","PM"]' ><% a %></option>
                            </select>
                        </div>
                    </div>
                  
                    <div class='flex   w-[60%] items-center justify-end '>
    
                        <label for=""  class='  w-[6rem]'>
                            End Time :-
                        </label>
                            <div>
        
                                <select name="" id="" class='appearance-none w-8 text-center  p-1 rounded' class='appearance-none w-8 text-center'>
                                    <option value="hr" ng-repeat='hr in h'><% hr %></option>
                                </select>
                                <select name="" id="" class='appearance-none w-8 text-center p-1 rounded'>
                                    
                                    <option value="min" ng-repeat='min in m'  ><% min %></option> 
                                    
                                    
                                </select>
                                <select name="" id="" class='appearance-none w-8 text-center  p-1 rounded' >
                                    <option   ng-repeat='a in ["AM","PM"]' ><% a %></option>
                                </select>
                            </div>
                    </div>
                </div>


               
                 <button ng-click='closeMode' class='bg-red-500  rounded py-2 px-4 font-bold text-white '>Submit</button>
              </form>
    
        </div>


    </div>



    <script>
         nexgiApp.controller('AddTrain',function ($scope,$http,toastr){
          
         $scope.addTrain=function (){
            console.log("clicked to add train");
         } 
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
                $scope.mins();
                $scope.hours();

              }
              
              );
    });    
    </script>


    
@endsection