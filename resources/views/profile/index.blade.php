@extends('layouts.app')

@section('content')
<div class="container">

    <form id="profileUpdate" method="post" enctype="multipart/form-data" action="{{ url('/profile') }}">  
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
                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
            </div>    

            <div class="col">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" class="form-control" value="{{ $user->middle_name }}" required>
            </div>  
        </div>

         <div class="row pb-4">       
            <div class="col">
                <label for="middle_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
            </div> 
            <div class="col"></div>
        </div>       

        <div class="row pb-4">      
           <div class="col">
                <label for="phone">Birthday</label>
                <input type="date" name="birthday" class="form-control" value="{{ $profile->birthday }}" required>
            </div> 
            <div class="col">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" class="form-control" value="{{ $profile->phone }}" required>
            </div>             
        </div>   

         <div class="row pb-5">       
            <div class="col">
                <label for="role_id">User Role</label>    
                <select class="form-control" name="role_id">
                    <option value="{{ $user->role_id }}">{{ $user->role_id }}</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>  
            <div class="col">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
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
                <input type="text" name="house_number" class="form-control" value="{{ $profile->house_number }}" required>
            </div> 
            <div class="col">
                <label for="street">Street</label>
                <input type="text" name="street" class="form-control" value="{{ $profile->street }}" required>
            </div> 
        </div>    

        <div class="row pb-4">  
            <div class="col">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" value="{{ $profile->city }}" required>
            </div> 
            <div class="col">
                <label for="Province">Province</label>
                <input type="text" name="province" class="form-control" value="{{ $profile->province }}" required>
            </div> 
        </div>  

        <div class="row pb-4">  
            <div class="col">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" value="{{ $profile->postal_code }}" required>
            </div> 
            <div class="col">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" value="{{ $profile->country }}" required>
            </div> 
        </div>  

        <div class="row pb-3">       
            <div class="col-md-12">
                <h5>PROFILE & VALIDATION ID</h5>
                <hr>
            </div>       
        </div>    

        <div class="row pb-4">  
            <div class="col-md-6">
                <div class="row">  
                    <div class="col-md-6">
                        <label for="image">Upload Profile Image</label>
                        <input type="file" name="image" class="form-control-file mb-3" value="" >
                    </div>
                    <div class="col-md-6">    
                        <a class="retina" href="{{ $link .'/'. $profile->image }}">
                            <div id="imageModal"
                                style="
                                width: 200px; 
                                height: 200px; 
                                background-image: url({{ $link .'/'. $profile->image }});
                                background-position: center;
                                background-size: cover;
                                background-repeat: no-repeat;
                            "></div>  
                        </a>   
                    </div>    
                </div>    
            </div>                        
            <div class="col-md-6">
                <div class="row">  
                    <div class="col-md-6">
                        <label for="image_id">Upload Valid ID</label>
                        <input type="file" name="image_id" class="form-control-file mb-3" value="" >
                    </div>
                    <div class="col-md-6">   
                        <a class="retina" href="{{ $link .'/'. $profile->image_id }}">
                            <div style="
                                width: 200px; 
                                height: 200px; 
                                background-image: url({{ $link .'/'. $profile->image_id }});
                                background-position: center;
                                background-size: cover;
                                background-repeat: no-repeat;">                                 
                            </div>
                        </a>    
                    </div>
                </div>    
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

        $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }); 
     
        $("#profileUpdate").validate({
          submitHandler: function(form) {
            var formData = new FormData(form);
            $.ajax({
                url: baseUrl + "{{ url("/profile") }}",
                type: 'POST',
                data: formData, 
                dataType: 'json',
                processData: false,
                contentType: false,
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
</script>    
@endsection

 
