<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PollingUnit;
use App\Models\AnouncedPollUnitResult;
use App\Models\LocalGovtArea;
use App\Models\State;
use App\Models\Party;
use App\Models\Ward;
use App\Http\Resources\LocalGovtAreaCollection;
class IndexController extends Controller
{
    public function index(){
        $polling_units = PollingUnit::join('announced_pu_results', 'polling_unit.uniqueid', '=', 'announced_pu_results.polling_unit_uniqueid')
                        ->where('polling_unit_name','!=','')
                        ->with('ward')
                        ->with('lga')
                        ->paginate(25);
        ///The above query fetches the only the polling units that has matching records in announced_pu_results table.
        ///It only fetches the polling units that have name.
        ///I set the query criteria as stated above to make it easier for the user of the system to find it easier to use it
        ///Because there are polling unit records in the table that has no name and it will not be nice to show them.
        ///It was also done like that for user to easily find the results because if not done, one may end up having polling units that has not results in the whole page and that will not make a goo User Experience in this system
        // return $polling_units;
    	return view('index',['polling_units'=>$polling_units]);
    }
    public function polling_unit_results($id){
         $results = AnouncedPollUnitResult::where('polling_unit_uniqueid',$id)
         ->with('polling_unit')->get();
        //  return $results;
         return view('polling_unit_result',['results'=>$results]);
    }

    public function lga_polls(){
        $lgas = LocalGovtArea::OrderBy('lga_name')->withCount('polling_unit')->paginate(12);
        // return $lgas;
        return view('lga-polls',['lgas'=>$lgas]);
    }

    public function new_result(){
        $states = State::get();
        $parties = Party::get();
        return view('new-result',['states'=>$states,'parties'=>$parties]);
    }

    public function save_new_result(Request $request){
        $new_result = new AnouncedPollUnitResult([
            'polling_unit_uniqueid' => $request->polling_unit,
            'party_abbreviation' => $request->party, 	
            'party_score' => $request->party_score,
            'entered_by_user' => 'Agbo Boniface Ebuka',
        ]);
        if($new_result->save()){
            return response()->json(['message' => 'success']); 
        }
        else{
            return response()->json(['message' => 'error']); 
        }
    }

    public function find_lga(Request $request){ 
        $list_local_govt_areas = LocalGovtArea::where('state_id',$request->state_id)
        ->OrderBy('lga_name','DESC')->get();
        if(count($list_local_govt_areas)>0){
            $list_local_govt_areas = new LocalGovtAreaCollection($list_local_govt_areas);   
            return response()->json(['local_govt_area' => $list_local_govt_areas]);     
        }
        else{
            return response()->json(['local_govt_area' => false]);
        }
        
    }
    public function find_ward(Request $request){ 
        $list_wards = Ward::where('lga_id',$request->lga_id)
        ->OrderBy('ward_name','DESC')->get();
        if(count($list_wards)>0){
            $list_wards = new LocalGovtAreaCollection($list_wards);   
            return response()->json(['ward' => $list_wards]);     
        }
        else{
            return response()->json(['ward' => false]);
        }
        
    }

    public function find_polling_unit(Request $request){ 
        $list_polling_units = PollingUnit::where('ward_id',$request->ward_id)
        ->OrderBy('polling_unit_name','DESC')->get();
        if(count($list_polling_units)>0){
            $list_polling_units = new LocalGovtAreaCollection($list_polling_units);   
            return response()->json(['polling_unit' => $list_polling_units]);     
        }
        else{
            return response()->json(['polling_unit' => false]);
        }
        
    }
}
