@extends('layouts.app')

@section('content')
<div class="container">

    <form id="profileUpdate" action="" method="post">  
        {{ csrf_field() }}
        <div class="row pb-3">
            <div class="col-md-12">
                <h5>IDENTIFICATION</h5>
                <hr>
            </div>
        </div>       

        <div class="row pb-4">           
            <div class="col">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
            </div>    

            <div class="col">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" class="form-control" value="{{ $user->middle_name }}" >
            </div>  
        </div>

         <div class="row pb-4">       
            <div class="col">
                <label for="middle_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
            </div> 
            <div class="col"></div>
        </div>       

        <div class="row pb-4">      
           <div class="col">
                <label for="phone">Birthday</label>
                <input type="date" name="birthday" class="form-control" value="{{ $profile->birthday }}">
            </div> 
            <div class="col">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" class="form-control" value="{{ $profile->phone }}">
            </div>             
        </div>   

         <div class="row pb-5">       
            <div class="col">
                <label>User Role</label>    
                <select class="form-control" name="role_id">
                    <option value="{{ $user->role_id }}">{{ $user->role_id }}</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>  
            <div class="col"></div>
        </div>    
            
         <div class="row pb-3">       
            <div class="col-md-12">
                <h5>ADDRESS</h5>
                <hr>
            </div>       
        </div>    

        <div class="row pb-4">  
            <div class="col">
                <label for="house_number">House Number</label>
                <input type="text" name="house_number" class="form-control" value="{{ $profile->house_number }}">
            </div> 
            <div class="col">
                <label for="street">Street</label>
                <input type="text" name="street" class="form-control" value="{{ $profile->street }}">
            </div> 
        </div>    

        <div class="row pb-4">  
            <div class="col">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" value="{{ $profile->city }}">
            </div> 
            <div class="col">
                <label for="Province">Province</label>
                <input type="text" name="province" class="form-control" value="{{ $profile->province }}">
            </div> 
        </div>  

        <div class="row pb-4">  
            <div class="col">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" value="{{ $profile->postal_code }}">
            </div> 
            <div class="col">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" value="{{ $profile->country }}">
            </div> 
        </div>  

        <div class="row pb-4">
            <div class="col-md-12">
                <hr>
                <input type="submit" class="btn btn-primary float-right" value="update">
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
     
        $("#profileUpdate").validate({
          submitHandler: function(form) {
            $.ajax({
              type:'POST',
              url:'{{ url("/profile") }}',
              data: $("#profileUpdate").serialize(),
              success:function(data){
                console.log('success');  
              },
              error: function(XMLHttpRequest) {
                console.log('Something Went Wrong!');
              }
            });
          }
        });

    });

@endsection

 
