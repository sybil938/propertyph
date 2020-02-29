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

    public function add(Request $request)
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
       
        return redirect('/properties');

    }

    //DATATABLES
    public function allProp(Request $request){

        $apartments   = Apartment::query()->where('user_id', Auth::user()->id)->with('ptype','stat')->get();
        $condominiums = Condominium::query()->where('user_id', Auth::user()->id)->with('ptype','stat')->get();
        $dormitories  = Dormitory::query()->where('user_id', Auth::user()->id)->with('ptype','stat')->get();
        $houses       = House::query()->where('user_id', Auth::user()->id)->with('ptype','stat')->get();
        $datas        = Collect($apartments)->merge($condominiums)->merge($dormitories)->merge($houses);

        if ($request->ajax()) {              

            return dataTables()->of($datas)
                ->addIndexColumn()              
                ->addColumn('type', function ($data) {
                    return $data->ptype->name ?? ''; 
                })     
                ->addColumn('status', function ($data) {
                    return $data->stat->name ?? ''; 
                })                 
                ->addColumn('action', function($data){
                    $id   = $data->id;
                    $type = $data->ptype->value;
                    $btn  = '
                        <a href="'.url("properties/$type/$id").'"><button type="button" class="btn btn-dark btn-sm">remove</button></a>
                        <a href="'.url("properties/$type/$id/edit").'"><button type="button" class="btn btn-dark btn-sm">edit</button></a>
                        <a href="'.url("properties/$type/$id/view").'"><button type="button" class="btn btn-dark btn-sm">view</button></a>                        
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);    
        }  

        return view('property.index');

    }


    public function apartment(Request $request)
    {
        $apartment = Apartment::where('user_id', Auth::user()->id)->get(); 
        
        if ($request->ajax()) {              

            return dataTables()->of($apartment)
                ->addIndexColumn()                 
                ->addColumn('action', function($data){
                    $btn = '
                        <a href="'.url("properties/apartment/$data->id").'"><button type="button" class="btn btn-dark btn-sm">remove</button></a>
                        <a href="'.url("properties/apartment/$data->id/edit").'"><button type="button" class="btn btn-dark btn-sm">edit</button></a>
                        <a href="'.url("properties/apartment/$data->id/view").'"><button type="button" class="btn btn-dark btn-sm">view</button></a>                        
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
                        <a href="'.url("properties/condominium/$data->id").'"><button type="button" class="btn btn-dark btn-sm">remove</button></a>
                        <a href="'.url("properties/condominium/$data->id/edit").'"><button type="button" class="btn btn-dark btn-sm">edit</button></a>
                        <a href="'.url("properties/condominium/$data->id/view").'"><button type="button" class="btn btn-dark btn-sm">view</button></a>                        
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
                        <a href="'.url("properties/dormitory/$data->id").'"><button type="button" class="btn btn-dark btn-sm">remove</button></a>
                        <a href="'.url("properties/dormitory/$data->id/edit").'"><button type="button" class="btn btn-dark btn-sm">edit</button></a>
                        <a href="'.url("properties/dormitory/$data->id/view").'"><button type="button" class="btn btn-dark btn-sm">view</button></a>                        
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
                        <a href="'.url("properties/house/$data->id").'"><button type="button" class="btn btn-dark btn-sm">remove</button></a>
                        <a href="'.url("properties/house/$data->id/edit").'"><button type="button" class="btn btn-dark btn-sm">edit</button></a>
                        <a href="'.url("properties/house/$data->id/view").'"><button type="button" class="btn btn-dark btn-sm">view</button></a>                        
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);    
        }  

        return view('property.index', compact('house'));
    }  
 
    
   
}
