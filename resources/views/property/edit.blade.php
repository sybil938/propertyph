@extends('layouts.app')

@section('content')    

    <div class="container">


        <div class="row">
            <div class="col-md-12 pb-3">
                <h2 class="mb-3 text-right">Edit this property</h2>
            </div>
            <div class="col-md-12 pb-3">
                <h3 class="mb-3">{{ $data->name }}</h3>
                <hr>
            </div>
        </div>	

        <form id="editProperty" method="post" action="{{ url('/properties/'. $type .'/'. $data->id .'/edit') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row pb-3">
                <div class="col-md-6">	

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Unit Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" value="{{$data->name}}">
                            <small class="pt-2">How would you like to market your unit?</small>
                        </div>
                    </div> 

                    <h5>Location</h5>
                    <hr>			
                    <div class="form-group row">
                        <label for="unit_number" class="col-sm-4 col-form-label">Unit Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="unit_number" class="form-control" value="{{$data->unit_number}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="street" class="col-sm-4 col-form-label">Street</label>
                        <div class="col-sm-8">
                            <input type="text" name="street" class="form-control" value="{{$data->street}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-sm-4 col-form-label">City</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" class="form-control" value="{{$data->city}}">
                        </div>
                    </div>	
                    <div class="form-group row">
                        <label for="province" class="col-sm-4 col-form-label">Province</label>
                        <div class="col-sm-8">
                            <input type="text" name="province" class="form-control" value="{{$data->province}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postal_code" class="col-sm-4 col-form-label">Postal Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="postal_code" class="form-control" value="{{$data->postal_code}}">
                        </div>
                    </div>	
                    <div class="form-group row">
                        <label for="country" class="col-sm-4 col-form-label">Country</label>
                        <div class="col-sm-8">
                            <input type="text" name="country" class="form-control" value="{{$data->country}}">
                        </div>
                    </div>					
                </div>	
                <div class="col-md-6">     

                    <div id="carouselProperty" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            @foreach($files as $file)
                                <li data-target="#demo" data-slide-to="{{ $file }}"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach	
                        </ol>
                        
                        <div class="carousel-inner" role="listbox">
                            @foreach($files as $file)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div style="
                                        with:100%; 
                                        height: 450px; 
                                        background-image: url({{$file}});
                                        background-position: center;
                                        background-size: cover;
                                        background-repeat: no-repeat;">                                 
                                    </div>
                                </div>
                            @endforeach:
                        </div>
                        
                        <a class="carousel-control-prev" href="#carouselProperty" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselProperty" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>				
                    </div>	 
                    
                </div>	
            </div>	


            <div class="row">
                <div class="col-md-6">
                    <h5 class="pt-2">Details</h5>
                    <hr>

                    <div class="form-group row">
                        <label for="units" class="col-sm-4 col-form-label">Number of Units</label>
                        <div class="col-sm-8">
                            <input type="number" name="units" class="form-control" value="{{$data->units}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status" class="form-control">
                                <option value="{{ $data->stat->id }}">{{ $data->stat->name }}</option>
                                @foreach($status as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amenities" class="col-sm-4 col-form-label">Amenities</label>
                        <div class="col-sm-8">	                              	           
                            @foreach( $amenitiesList as $a)             
                                <div class="form-check form-check-inline"> 
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="amenities[]" 
                                        value="{{ $a->name }}"                                    
                                        <?php 
                                            if(!empty($amenitiesVal)) :
                                                if( in_array($a->name, $amenitiesVal) ):
                                                    echo 'checked';    
                                                else:              
                                                    echo '';                        
                                                endif;
                                            endif;      
                                        ?>
                                    >
                                    <label class="form-check-label" for="amenities">{{ $a->name }}</label>                       
                                </div>		
                            @endforeach	                             				  	
                        </div>                       
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control">{{$data->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="terms" class="col-sm-4 col-form-label">Terms of Agreement</label>
                        <div class="col-sm-8">
                            <input type="text" name="terms" class="form-control" value="{{$data->terms}}">
                        </div>
                    </div>
                </div>	
                <div class="col-md-6">
                    <h5 class="pt-3">Billing & Payments</h5>
                    <hr>
                    
                    <div class="form-group row">
                        <label for="monthly_rental" class="col-sm-4 col-form-label">Monthly Rental</label>
                        <div class="col-sm-8">
                            <input type="number" name="monthly_rental" class="form-control" value="{{$data->monthly_rental}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deposit" class="col-sm-4 col-form-label">Deposit</label>
                        <div class="col-sm-8">
                            <input type="text" name="deposit" class="form-control" value="{{$data->deposit}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="advance" class="col-sm-4 col-form-label">Advance</label>
                        <div class="col-sm-8">
                            <input type="text" name="advance" class="form-control" value="{{$data->advance}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="electric_bill" class="col-sm-4 col-form-label">Electric Bill</label>
                        <div class="col-sm-8">
                            <input type="text" name="electric_bill" class="form-control" value="{{$data->electric_bill}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="water_bill" class="col-sm-4 col-form-label">Water Bill</label>
                        <div class="col-sm-8">
                            <input type="text" name="water_bill"class="form-control" value="{{$data->water_bill}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="penalty" class="col-sm-4 col-form-label">Penalty</label>
                        <div class="col-sm-8">
                            <input type="text" name="penalty" class="form-control" value="{{$data->penalty}}">
                        </div>
                    </div>

                </div>	
            </div>	
            <div class="row">        
                <div class="col-md-12">
                    <hr>
                    <input type="submit" class="btn btn-primary float-right" value="update">    
                    <a href="{{ url('properties') }}"><input type="button" class="btn btn-primary float-right mr-2" value="back"></a>                     	
                </div>
            </div> 
            
        </form>
    </div>
@endsection         

@section('scripts')
<script type="text/javascript">
  jQuery(document).ready(function($){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
 
    $("#editProperty").validate({
        submitHandler: function(form) {
            $.ajax({
                type:'POST',
                url: '{{ url("/properties/$type/$data->id/edit") }}',
                data: $("#editProperty").serialize({ checkboxesAsBools: true }),
                success:function(data){
                    console.log('success'); 
                    setTimeout("location.reload(true)", 1800);
                },
                error: function(XMLHttpRequest) {
                    console.log('Something Went Wrong!');
                }
            });
        }
    });

  });
</script>
@endsection