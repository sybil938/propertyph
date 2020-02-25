@extends('layouts.app')

@section('content')    
    <div class="container">
        <div class="row pb-3">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-justified mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-apartment-tab" data-toggle="pill" href="#pills-apartment" role="tab" aria-controls="pills-apartment" aria-selected="true">APARTMENT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-condominium-tab" data-toggle="pill" href="#pills-condominium" role="tab" aria-controls="pills-condominium" aria-selected="false" onclick="condoTable()">CONDOMINIUM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-dormitory-tab" data-toggle="pill" href="#pills-dormitory" role="tab" aria-controls="pills-dormitory" aria-selected="false" onclick="dormTable()">DORMITORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-house-tab" data-toggle="pill" href="#pills-house" role="tab"
                          aria-controls="pills-house" aria-selected="false" onclick="houseTable()">HOUSE</a>
                    </li>
                </ul>
            </div>    
        </div>    
        <div class="row pb-5">
            <div class="col-md-12">
                <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-apartment" role="tabpanel" aria-labelledby="pills-apartment-tab">
                        <table class="table table-bordered" id="dataTableApartment">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Unit Number</th>
                                    <th>Street</th>  
                                    <th>Province</th>   
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table> 
                    </div>
                    <div class="tab-pane fade" id="pills-condominium" role="tabpanel" aria-labelledby="pills-condominium-tab">
                        <table class="table table-bordered" id="dataTableCondo">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Unit Number</th>
                                    <th>Street</th>  
                                    <th>Province</th>   
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>                                                        
                    </div>
                    <div class="tab-pane fade" id="pills-dormitory" role="tabpanel" aria-labelledby="pills-dormitory-tab">
                        <table class="table table-bordered" id="dataTableDorm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Unit Number</th>
                                    <th>Street</th>  
                                    <th>Province</th>   
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>                          
                    </div> 
                    <div class="tab-pane fade" id="pills-house" role="tabpanel" aria-labelledby="pills-house-tab">
                        <table class="table table-bordered" id="dataTableHouse">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Unit Number</th>
                                    <th>Street</th>  
                                    <th>Province</th>   
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>                          
                    </div> 
                </div>              
            </div>
        </div>   
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('properties/create') }}"><input type="button" class="btn btn-primary float-right" value="Add Property"></a>  
            </div>    
        </div>     
    </div>
@endsection 

@section('scripts')
<script text="text/javascript">
    window.addEventListener('load', function() {
        $("#dataTableApartment").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('properties') }}",
            columns: [              
                {data: 'name', name: 'name'},
                {data: 'unit_number', name: 'unit_number'},
                {data: 'street', name: 'street'},
                {data: 'province', name: 'province'},
                {data: 'city', name: 'city'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 1, "desc" ]]
        });     
    }); 
        
    function condoTable() {
        if (!$.fn.dataTable.isDataTable('#dataTableCondo')) {    
            $("#dataTableCondo").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('properties/condominium') }}",
                columns: [      
                    {data: 'name', name: 'name'},        
                    {data: 'unit_number', name: 'unit_number'},
                    {data: 'street', name: 'street'},
                    {data: 'province', name: 'province'},
                    {data: 'city', name: 'city'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "order": [[ 1, "desc" ]]
            });  
        }  
    }   

    function dormTable() {
        if (!$.fn.dataTable.isDataTable('#dataTableDorm')) {    
            $("#dataTableDorm").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('properties/dormitory') }}",
                columns: [              
                    {data: 'name', name: 'name'},
                    {data: 'unit_number', name: 'unit_number'},
                    {data: 'street', name: 'street'},
                    {data: 'province', name: 'province'},
                    {data: 'city', name: 'city'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "order": [[ 1, "desc" ]]
            });  
        }  
    } 

    function houseTable() {
        if (!$.fn.dataTable.isDataTable('#dataTableHouse')) {    
            $("#dataTableHouse").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('properties/house') }}",
                columns: [              
                    {data: 'name', name: 'name'},
                    {data: 'unit_number', name: 'unit_number'},
                    {data: 'street', name: 'street'},
                    {data: 'province', name: 'province'},
                    {data: 'city', name: 'city'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "order": [[ 1, "desc" ]]
            });  
        }  
    }    
</script>
@endsection   