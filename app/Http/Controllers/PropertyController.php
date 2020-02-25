<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Apartment;
use App\Condominium;
use App\Dormitory;
use App\House;
use App\Meta;

use Auth;
use Storage;
use DataTables;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        return view('property.index');
    }

    public function create()
    {
        $status    = Meta::where('type', 'property-status')->where('name', 'vacant')->first();
        $amenities = Meta::where('type', 'property-ammenities')->get();

        return view('property.create', compact('status','amenities'));
    }

    public function addProperty(Request $request)
    {

        $id    = Auth::user()->id;
        $types = Meta::where('type', 'property-type')->get();
        $type  = $request->type;

        switch ($type) {
            case "apartment":
                $data = new Apartment();     
                break;
            case "condominium":
                $data = new Condominium();
                break;
            case "dormitory":
                $data = new Dormitory();
                break;
             case "house":
                $data = new House();
                break;                               
            default:
        }

        //Handle File Upload
        $files = [];

        if($request->hasFile('images')){            

            foreach($request->file('images') as $image) {  

                //Get Filename with the extension
                $filenameWithExt = $image->getClientOriginalName();

                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                //Get just EXT
                $extension = $image->getClientOriginalExtension();

                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                
                switch ($type) {
                    case "apartment":
                        $path = $image->storeAs("public/apartment/$id", $fileNameToStore); 
                        break;
                    case "condominium":
                        $path = $image->storeAs("public/condominium/$id", $fileNameToStore);
                        break;
                    case "dormitory":
                        $path = $image->storeAs("public/dormitory/$id", $fileNameToStore);
                        break;
                     case "house":
                        $path = $image->storeAs("public/house/$id", $fileNameToStore);
                        break;                               
                    default:
                }
                $files[] = $fileNameToStore;
            }    
        } else {
            $fileNameToStore = "noimage.jpg";
        }

        foreach($types as $t) {
            if( $type == $t->value ) {
                $typeID = $t->id;
            }
        }

        $data->user_id        = $id;       
        $data->type           = $typeID;     
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
        $data->save();
       
        return view('property.index');

    }

    public function apartmentView($id)
    {
        $userID        = Auth::id();    
        $data          = Apartment::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $images        = json_decode($data->images);
        $link          = asset('/storage/apartment/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'apartment';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.view', compact('data','files','amenitiesVal','amenitiesList','type')); 
           
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

        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type')); 
    }

    public function apartmentEdit(Request $request, $id)
    {           
        $userID        = Auth::id();    
        $data          = Apartment::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/apartment/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'apartment';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
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
        //$data->images         = json_encode($files);
        $data->status         = $request->status;
        $data->monthly_rental = $request->monthly_rental;
        $data->deposit        = $request->deposit;
        $data->advance        = $request->advance;
        $data->electric_bill  = $request->electric_bill;
        $data->water_bill     = $request->water_bill;  
        $data->penalty        = $request->penalty;
        $data->update();

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type'));  
    }
 

    //CONDO
    public function condoView($id)
    {
        $userID        = Auth::id();    
        $data          = Condominium::where('id',$id)->where('user_id',$userID)->with('user','stat')->first();  
        $images        = json_decode($data->images);
        $link          = asset('/storage/condominium/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'condominium';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.view', compact('data','files','amenitiesVal','amenitiesList','type')); 
           
    }

    public function condoEditView($id)
    {           
        $userID        = Auth::id();    
        $data          = Condominium::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/condominium/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'condominium';

        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type'));  
    }

    public function condoEdit(Request $request, $id)
    {           
        $userID        = Auth::id();    
        $data          = Condominium::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/condominium/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'condominium';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        $data                 = Condominium::find($id);
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
        //$data->images         = json_encode($files);
        $data->status         = $request->status;
        $data->monthly_rental = $request->monthly_rental;
        $data->deposit        = $request->deposit;
        $data->advance        = $request->advance;
        $data->electric_bill  = $request->electric_bill;
        $data->water_bill     = $request->water_bill;  
        $data->penalty        = $request->penalty;
        $data->update();

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type'));  
    }
 
    //DORM
    public function dormView($id)
    {
        $userID        = Auth::id();    
        $data          = Dormitory::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $images        = json_decode($data->images);
        $link          = asset('/storage/dormitory/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'dormitory';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.view', compact('data','files','amenitiesVal','amenitiesList','type')); 
           
    }

    public function dormEditView($id)
    {           
        $userID        = Auth::id();    
        $data          = Dormitory::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/dormitory/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'dormitory';

        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type'));  
    }

    public function dormEdit(Request $request, $id)
    {           
        $userID        = Auth::id();    
        $data          = Dormitory::where('id',$id)->where('user_id',$userID)->with('user','stat')->first();  
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/dormitory/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'dormitory';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        $data                 = Condominium::find($id);
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
        //$data->images         = json_encode($files);
        $data->status         = $request->status;
        $data->monthly_rental = $request->monthly_rental;
        $data->deposit        = $request->deposit;
        $data->advance        = $request->advance;
        $data->electric_bill  = $request->electric_bill;
        $data->water_bill     = $request->water_bill;  
        $data->penalty        = $request->penalty;
        $data->update();

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type'));  
    }
 
    //HOUSE
    public function houseView($id)
    {
        $userID        = Auth::id();    
        $data          = House::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $images        = json_decode($data->images);
        $link          = asset('/storage/house/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'house';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.view', compact('data','files','amenitiesVal','amenitiesList','type')); 
        
    }

    public function houseEditView($id)
    {           
        $userID        = Auth::id();    
        $data          = House::where('id',$id)->where('user_id',$userID)->with('user','stat')->first();  
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/house/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'house';

        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type'));  
    }

    public function houseEdit(Request $request, $id)
    {           
        $userID        = Auth::id();    
        $data          = House::where('id',$id)->where('user_id',$userID)->with('user','stat')->first(); 
        $status        = Meta::where('type', 'property-status')->get();
        $images        = json_decode($data->images);
        $link          = asset('/storage/house/'. $userID);
        $amenitiesVal  = json_decode($data->amenities);
        $amenitiesList = Meta::where('type', 'property-ammenities')->get();
        $type          = 'house';
        
        $files=[];
        foreach($images as $img){
            $files[] = $link  .'/'. $img;
        }

        $data                 = Condominium::find($id);
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
        //$data->images         = json_encode($files);
        $data->status         = $request->status;
        $data->monthly_rental = $request->monthly_rental;
        $data->deposit        = $request->deposit;
        $data->advance        = $request->advance;
        $data->electric_bill  = $request->electric_bill;
        $data->water_bill     = $request->water_bill;  
        $data->penalty        = $request->penalty;
        $data->update();

        return view('property.edit', compact('data','status','files','amenitiesVal','amenitiesList','type'));  
    }


    //DATATABLES
    public function apartment(Request $request)
    {
        $apartment = Apartment::where('user_id', Auth::user()->id)->get(); 
        
        if ($request->ajax()) {              

            return dataTables()->of($apartment)
                ->addIndexColumn()                 
                ->addColumn('action', function($data){
                    $btn = '
                        <a href="'.url("properties/apartment/$data->id/edit").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">Edit</button></a>
                        <a href="'.url("properties/apartment/$data->id/view").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">View</button></a>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);    
        }  

        return view('property.index', compact('apartment'));
    }

    public function condominium(Request $request)
    {
        $condo = Condominium::where('user_id', Auth::user()->id)->get(); 
        
        if ($request->ajax()) {              

            return dataTables()->of($condo)
                ->addIndexColumn()                 
                ->addColumn('action', function($data){
                    $btn = '
                        <a href="'.url("properties/condominium/$data->id/edit").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">Edit</button></a>
                        <a href="'.url("properties/condominium/$data->id/view").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">View</button></a>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);    
        }  

        return view('property.index', compact('condo'));
    }   

    public function dormitory(Request $request)
    {
        $dorm = Dormitory::where('user_id', Auth::user()->id)->get(); 
        
        if ($request->ajax()) {              

            return dataTables()->of($dorm)
                ->addIndexColumn()                 
                ->addColumn('action', function($data){
                    $btn = '
                        <a href="'.url("properties/dormitory/$data->id/edit").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">Edit</button></a>
                        <a href="'.url("properties/dormitory/$data->id/view").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">View</button></a>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);    
        }  

        return view('property.index', compact('dorm'));
    }  

    public function house(Request $request)
    {
        $house = House::where('user_id', Auth::user()->id)->get(); 
        
        if ($request->ajax()) {              

            return dataTables()->of($house)
                ->addIndexColumn()                 
                ->addColumn('action', function($data){
                    $btn = '
                        <a href="'.url("properties/house/$data->id/edit").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">Edit</button></a>
                        <a href="'.url("properties/house/$data->id/view").'" target="_blank"><button type="button" class="btn btn-dark btn-sm">View</button></a>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);    
        }  

        return view('property.index', compact('house'));
    }  
 
    
   
}
