<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};
class DropdownController extends Controller
{
    public function index()
    {
        $data['countries'] = Country::get(["name", "id"]);
        // dd($data);
        return view('add_student', $data);
    }
    public function fetchState(Request $request)
    {
    	// dd(1);
        $data['states'] = State::where("countryid",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
}