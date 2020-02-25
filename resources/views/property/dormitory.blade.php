<div class="container">

    <form id="addPropertyDorm" method="post" action="{{ url('/properties/create') }}" enctype="multipart/form-data">    
        {{ csrf_field() }}

        <div class="row pb-3">
            <div class="col-md-12">
                <h5>PROPERTY</h5>
                <hr>
            </div>
        </div> 

        <div class="row pb-5">
            <div class="col">
                <label for="name">Dormitory Name</label>
                <input type="text" name="name" class="form-control" value="">
                <small class="pt-2">How would you like to market your dorm unit/s?</small>
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
                <label for="units">Number of units in the indicated address:</label>
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
                <input type="hidden" name="type" value="dormitory">
                <input type="hidden" name="status" value="{{ $status->id }}">                
            </div>  
        </div>

        <div class="row pb-3">
            <div class="col-md-12">
                <h5>BILLING</h5>
                <hr>
            </div>
        </div>          

        <div class="row pb-4">           
            <div class="col">
                <label for="monthly_rental">Monthly Rental</label>
                <input type="number" name="monthly_rental" class="form-control" value="" placeholder="Enter Amount">
            </div>    

            <div class="col"></div>  
        </div> 

        <div class="row pb-4">           
            <div class="col">
                <label for="deposit">Deposit</label>
                <select name="deposit" class="form-control">
                    <option value="" disabled selected>Enter Amount</option>
                    <option value="1000">1,000</option>
                    <option value="2000">2,000</option>
                    <option value="3000">3,000</option>
                    <option value="4000">4,000</option>
                    <option value="5000">5,000</option>
                </select>               
            </div>    

            <div class="col">
                <label for="advance">Advance</label>
                <select name="advance" class="form-control">
                    <option value="" disabled selected>Enter Amount</option>
                    <option value="1000">1,000</option>
                    <option value="2000">2,000</option>
                    <option value="3000">3,000</option>
                    <option value="4000">4,000</option>
                    <option value="5000">5,000</option>
                </select>     
            </div>  
        </div> 

        <div class="row pb-4">           
            <div class="col">
                <label for="electric_bill">Electric Bill</label>
                <input type="number" name="electric_bill" class="form-control" value="" placeholder="Enter Amount">
            </div>    

            <div class="col">
                <label for="water_bill">Water Bill</label>
                <input type="number" name="water_bill" class="form-control" value="" placeholder="Enter Amount">
            </div>  
        </div> 

        <div class="row pb-4">           
            <div class="col">
                <label for="other_payments">Other Payments</label>
                <input type="number" name="other_payments" class="form-control" value="" placeholder="Enter Amount">
            </div>    

            <div class="col">
                <label for="penalty">Penalty</label>
                <input type="number" name="penalty" class="form-control" value="" placeholder="Enter Amount">
            </div>  
        </div> 


        <div class="row pb-4">  
            <div class="col">
                <hr>
                <input type="submit" class="btn btn-primary float-right" value="create">
            </div>    
        </div> 
    </form>    
     
</div>


