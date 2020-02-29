@extends('layouts.app')

@section('content')    
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills mb-4 float-right" id="pills-tab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="pills-apartment-tab" data-toggle="pill" href="#pills-apartment" role="tab" aria-controls="pills-apartment" aria-selected="true">APARTMENT</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="pills-condominium-tab" data-toggle="pill" href="#pills-condominium" role="tab" aria-controls="pills-condominium" aria-selected="false">CONDOMINIUM</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="pills-dormitory-tab" data-toggle="pill" href="#pills-dormitory" role="tab" aria-controls="pills-dormitory" aria-selected="false">DORMITORY</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="pills-house-tab" data-toggle="pill" href="#pills-house" role="tab"
                    aria-controls="pills-house" aria-selected="false">HOUSE</a>
              </li>
          </ul>
        </div>  
      </div>  
      <div class="row">
        <div class="col-md-12">  
          <div class="tab-content pt-2 pl-1" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-apartment" role="tabpanel" aria-labelledby="pills-apartment-tab">
                  @include('property.apartment')
              </div>
              <div class="tab-pane fade" id="pills-condominium" role="tabpanel" aria-labelledby="pills-condominium-tab">
                  @include('property.condominium')
              </div>
              <div class="tab-pane fade" id="pills-dormitory" role="tabpanel" aria-labelledby="pills-dormitory-tab">
                  @include('property.dormitory')
              </div> 
              <div class="tab-pane fade" id="pills-house" role="tabpanel" aria-labelledby="pills-house-tab">
                  @include('property.house')
              </div>           
          </div>
        </div>  
      </div>  
    </div>
@endsection        

@section('scripts')
<script type="text/javascript">
  jQuery(document).ready(function($){
    //INPUT MASK
    $('.currency').mask("#,##0.00", {reverse: true});

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
 
    $("#addPropertyApartment").validate({
      submitHandler: function(form) {
        var formData = new FormData(form);
        $.ajax({
          url: baseUrl + "{{ url("/properties/create") }}",
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

    $("#addPropertyCondo").validate({
      submitHandler: function(form) {
        var formData = new FormData(form);
        $.ajax({
          type:'POST',
          url:'{{ url("/properties/create") }}',
          data: $("#addPropertyCondo").serialize(),
          success:function(data){
            console.log('success');  
          },
          error: function(XMLHttpRequest) {
            console.log('Something Went Wrong!');
          }
        });
      }
    });

    $("#addPropertyDorm").validate({
      submitHandler: function(form) {
        var formData = new FormData(form);
        $.ajax({
          url: baseUrl + "{{ url("/properties/create") }}",
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

    $("#addPropertyHouse").validate({
      submitHandler: function(form) {
        var formData = new FormData(form);
        $.ajax({
          url: baseUrl + "{{ url("/properties/create") }}",
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
