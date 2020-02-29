<div class="container">

    <form id="addPropertyApartment" method="post" action="{{ url('/properties/create') }}" enctype="multipart/form-data">    
        {{ csrf_field() }}

        <div class="row pb-3">
            <div class="col-md-12">
                <h5>APARTMENT PROPERTY FORM</h5>
                <hr>
            </div>
        </div> 

        <div class="row pb-5">
            <div class="col">
                <label for="name">Apartment Name</label>
                <input type="text" name="name" class="form-control" value="">
                <small class="pt-2">How would you like to market your apartment unit/s?</small>
            </div>    
            <div class="col"></div> 
        </div> 

        <div class="row pb-3">
            <div class="col-md-12">
                <h5>LOCATION</h5>
                <hr>
            </div>
        </div>  

        <div class="row pb-4">           
            <div class="col">
                <label for="unit_number">Unit Number</label>
                <input type="text" name="unit_number" class="form-control" value="">
            </div>    

            <div class="col">
                <label for="street">Street</label>
                <input type="text" name="street" class="form-control" value="" >
            </div>  
        </div>

        <div class="row pb-4">           
            <div class="col">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" value="">
            </div>    

            <div class="col">
                <label for="province">Province</label>
                <input type="text" name="province" class="form-control" value="" >
            </div>  
        </div>

        <div class="row pb-5">           
            <div class="col">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" value="">
            </div>    

            <div class="col">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" value="" >
            </div>  
        </div>

        <div class="row pb-3">
            <div class="col-md-12">
                <h5>DETAILS</h5>
                <hr>
            </div>
        </div>  

        <div class="row pb-4">           
            <div class="col">
                <label for="units">Number of Rooms:</label>
                <input type="number" name="units" class="form-control" value="">
            </div>    

            <div class="col"></div>  
        </div>

        <div class="row pb-4">  
            <div class="col">
                <label for="amenities">Amenities</label><br>
                <div class="amenityList">
                    @foreach($amenities as $amenity)
                    <div class="form-check form-check-inline">                
                        <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity->name }}">
                        <label class="form-check-label" for="amenities">{{ $amenity->name }}</label>                       
                    </div>
                    @endforeach 
                </div>    
            </div>    
        </div>

        <div class="row pb-4">           
            <div class="col">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" value=""></textarea>
            </div>    

            <div class="col">
                <label for="terms">Terms of Agreement Policy</label>
                <textarea name="terms" class="form-control" value=""></textarea>
            </div>  
        </div> 

        <div class="row pb-5">           
            <div class="col">
                <label for="images">Upload Photos</label>
                <input type="file" name="images[]" class="form-control-file" multiple>
            </div>    
            <div class="col">
                <input type="hidden" name="type" value="apartment">
                <input type="hidden" name="status" value="{{ $status->id }}">                
            </div>  
        </div>

        <div class="row pb-3">
            <div class="col-md-12">
                <h5>BILLING <span class="float-right">(PHP)</span></h5>
                <hr>
            </div>
        </div>          

        <div class="row pb-4">           
            <div class="col">
                <label for="monthly_rental">Monthly Rental</label>
                <input type="text" name="monthly_rental" class="form-control currency" value="" placeholder="Enter Amount">
            </div>    
            <div class="col"></div>  
        </div> 

        <div class="row pb-4">           
            <div class="col">
                <label for="deposit">Deposit</label>
                <input type="text" name="deposit" class="form-control currency" value="" placeholder="Enter Amount">
            </div>    

            <div class="col">
                <label for="advance">Advance</label>
                <input type="text" name="advance" class="form-control currency" value="" placeholder="Enter Amount">    
            </div>  
        </div> 

        <div class="row pb-4">  
            <div class="col">
                <label for="penalty">Penalty</label>
                <input type="text" name="penalty" class="form-control currency" value="" placeholder="Enter Amount">
            </div>  
            <div class="col"></div>  
        </div> 


        <div class="row pb-4">  
            <div class="col">
                <hr>
                <input type="submit" class="btn btn-primary float-right" value="create">
            </div>    
        </div> 
    </form>    
     
</div>


    
