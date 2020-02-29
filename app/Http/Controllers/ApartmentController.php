<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Apartment;
use App\Meta;

use Auth;
use Storage;

class ApartmentController extends Controller
{
    public function apartmentView($id)
    {
      
        $data          = Apartment::find($id); 
        $images        = json_decode($data->images);
        $link          = asset('/storage/apartment/'. $data->user_id);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'apartment';
       
        if(!empty($images)){         
            $files=[];
            foreach($images as $img){
                $files[] = $link  .'/'. $img;
            }
        }   else {
            $files = [asset('/storage/images/no-image.png')];
        }

        $previous = "javascript:history.go(-1)";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }

        return view('property.view', compact('data','files','amenitiesVal','amenitiesList','type','previous')); 
           
    }

    public function apartmentEditView($id)
    {           
        $userID        = Auth::id();    
        $data          = Apartment::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/apartment/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'apartment';       

        if(!empty($images)){         
            $files=[];
            foreach($images as $img){
                $files[] = $link  .'/'. $img;
            }
        }   else {
            $files = [asset('/storage/images/no-image.png')];
        }

        $previous = "javascript:history.go(-1)";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }    
 
        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type','images','previous')); 
    }

    public function apartmentEdit(Request $request, $id)
    {           
        $userID        = Auth::id();    
        $data          = Apartment::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/apartment/'. $userID);
        $type          = 'apartment';
                
        $files=[];
        if($request->hasFile('images')){            

            foreach ($images as $img) {
                Storage::delete('public/apartment/'. $data->user_id .'/'. $img );
            }           

            foreach($request->file('images') as $image) {  

                //Get Filename with the extension
                $filenameWithExt = $image->getClientOriginalName();

                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                //Get just EXT
                $extension = $image->getClientOriginalExtension();

                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
              
                $path = $image->storeAs("public/apartment/$userID", $fileNameToStore);  
              
                $files[] = $fileNameToStore;
            }    
        } 

        $data                 = Apartment::find($id);
        $data->name           = $request->name;
        $data->unit_number    = $request->unit_number;
        $data->street         = $request->street;
        $data->city           = $request->city;
        $data->province       = $request->province;
        $data->postal_code    = $request->postal_code;
        $data->country        = $request->country;
        $data->units          = $request->units;
        $data->amenities      = json_encode($request->amenities);
        $data->description    = $request->description;
        $data->terms          = $request->terms;
        $data->images         = json_encode($files);
        $data->status         = $request->status;
        $data->monthly_rental = $request->monthly_rental;
        $data->deposit        = $request->deposit;
        $data->advance        = $request->advance;
        $data->electric_bill  = $request->electric_bill;
        $data->water_bill     = $request->water_bill;  
        $data->penalty        = $request->penalty;
        $data->update();

        return redirect("/properties/apartment/$data->id/view");

    }
 
    public function remove(Request $request,$id)
    {   
     
        $data   = Apartment::find($id);
        $images = json_decode($data->images);

        if(Auth::id() !== $data->user_id){
            return redirect('/properties')->with('error', 'Unauthorized Access');
        }

        if(!empty($data->images) ){
            foreach ($images as $img) {
                Storage::delete('public/apartment/'. $data->user_id .'/'. $img );
            }           
        }

        $data->delete();

        return redirect('/properties')->with('success', 'Apartment property removed.');
    }

}
