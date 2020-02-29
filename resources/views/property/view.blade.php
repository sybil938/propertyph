@extends('layouts.app')

@section('content')    

    <div class="container">
        <div class="row">
        	<div class="col-md-12 pb-3">
        		<h3 class="mb-3">{{ $data->name ?? '' }}</h3>
        		<hr>
        	</div>
        </div>	
        <div class="row pb-3">
        	<div class="col-md-6">	
        	    <h5>Location</h5>
    			<hr>			
				<div class="form-group row">
					<label for="unit_number" class="col-sm-4 col-form-label">Unit Number</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->unit_number ?? '' }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="street" class="col-sm-4 col-form-label">Street</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->street ?? '' }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="city" class="col-sm-4 col-form-label">City</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->city ?? '' }}">
					</div>
				</div>	
				<div class="form-group row">
					<label for="province" class="col-sm-4 col-form-label">Province</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->province ?? '' }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="postal_code" class="col-sm-4 col-form-label">Postal Code</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->postal_code ?? '' }}">
					</div>
				</div>	
				<div class="form-group row">
					<label for="country" class="col-sm-4 col-form-label">Country</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->country ?? '' }}">
					</div>
				</div>					
        	</div>	
           	<div class="col-md-6">     

				<div id="carouselProperty" class="carousel slide" data-ride="carousel">
					@if(isset($files))
					<ol class="carousel-indicators">
						@foreach($files as $file)
							<li data-target="#demo" data-slide-to="{{ $file ?? '' }}"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
						@endforeach	
					</ol>
					
					<div class="carousel-inner" role="listbox">
						@foreach($files as $file)
							<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
								<a class="retina" href="{{ $file }}">
									<div style="
										with:100%; 
										height: 360px; 
										background-image: url({{$file}}); 
										background-position: center;
										background-size: cover;
	                                    background-repeat: no-repeat;">
									</div>
								</a>	
							</div>
						@endforeach
					</div>
					@endif
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
        		<h5 class="pt-3">Details</h5>
    			<hr>

				<div class="form-group row">
					@if($data->type == 'dormitory')
						<label for="units" class="col-sm-4 col-form-label">Number of Units</label>
					@else 
						<label for="units" class="col-sm-4 col-form-label">Number of Rooms</label>
					@endif
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->units ?? '' }}">
					</div>
				</div>

				<div class="form-group row">
					<label for="status" class="col-sm-4 col-form-label">Status</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->stat->name ?? '' }}">
					</div>
				</div>

				<div class="form-group row">
					<label for="amenities" class="col-sm-4 col-form-label">Amenities</label>
					<div class="col-sm-8">
						@if(!empty($amenitiesVal))		
							@foreach($amenitiesVal as $a)
								{{$a}},&nbsp;			
							@endforeach	
						@else
							<input type="text" readonly class="form-control" value="Nothing Added">
						@endif					  	
					</div>
				</div>

				<div class="form-group row">
					<label for="description" class="col-sm-4 col-form-label">Description</label>
					<div class="col-sm-8">
						<p>{{$data->description ?? '' }}</p>
					</div>
				</div>

				<div class="form-group row">
					<label for="terms" class="col-sm-4 col-form-label">Terms of Agreement</label>
					<div class="col-sm-8">
					  	<p>{{$data->terms ?? '' }}</p>
					</div>
				</div>
        	</div>	
        	<div class="col-md-6">
				<h5 class="pt-3">Billing & Payments<span class="float-right">(PHP)</span></h5>				
				<hr>
				
				<div class="form-group row">
					<label for="monthly_rental" class="col-sm-4 col-form-label">Monthly Rental</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->monthly_rental ?? '' }}">
					</div>
				</div>

				<div class="form-group row">
					<label for="deposit" class="col-sm-4 col-form-label">Deposit</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->deposit ?? '' }}">
					</div>
				</div>

				<div class="form-group row">
					<label for="advance" class="col-sm-4 col-form-label">Advance</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->advance ?? '' }}">
					</div>
				</div>

				@if($type == 'dormitory')
				<div class="form-group row">
					<label for="electric_bill" class="col-sm-4 col-form-label">Electric Bill</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->electric_bill ?? '' }}">
					</div>
				</div>

				<div class="form-group row">
					<label for="water_bill" class="col-sm-4 col-form-label">Water Bill</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->water_bill ?? '' }}">
					</div>
				</div>
				@endif

				<div class="form-group row">
					<label for="penalty" class="col-sm-4 col-form-label">Penalty</label>
					<div class="col-sm-8">
					  	<input type="text" readonly class="form-control" value="{{$data->penalty ?? '' }}">
					</div>
				</div>
							
        	</div>	
        </div>	

		<div class="row">        
        	<div class="col-md-12">
	            <hr>	            	
	            
	            <a href="{{ $previous }}"><input type="button" class="btn btn-primary float-right" value="back"></a>  	           
	            @if(Auth::check() == true)
				<a href="{{ url('properties/'. $type .'/'. $data->id . '/edit') }}"><input type="button" class="btn btn-primary float-right mr-2" value="edit"></a>
				 @endif	     
			</div>
        </div>    

    </div>
@endsection


@section('scripts')
<script type="text/javascript">
  	jQuery(document).ready(function($){
		$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});   
  	});
</script>
@endsection		      