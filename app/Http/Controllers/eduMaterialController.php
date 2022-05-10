<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\EducationalMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;





class eduMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Might not need this function
    public function index(Request $request)
    {
        DB::table('tagging_tags')->where('count','0')->delete();
        return view('eduMaterials.adminEduMaterials');
    }

    public function displayCreatePage()
    {
        DB::table('tagging_tags')->where('count','0')->delete();
        //For admins to go to the create material page
        return view('eduMaterials.addEduMaterials');
    }

    public function store(Request $request)
    {
         //validation
        $data = $request->validate([
            'eduMatsTitle' => 'required',
            'eduMatsDesc' => 'required',
            'tags' => 'required',
            'exampleCheck1' =>'accepted'
        ]);

        //store information in educational material table with the usage of EducationalMaterial model
        $post = EducationalMaterial::create([
            'title' => $request->eduMatsTitle,
            'eduDesc'=> $request->eduMatsDesc,
        ]);

        //Store tags
        $tags = explode(",", $request->tags);
        $post->tag($tags);
        //Redirect to the same page
        Session::flash('succ', 'Educational material has been created successfully');
        return redirect()->back();
    }

    public function search()
    {
            //Redirects users to different search pages based on their role
            $educationalMaterials =  EducationalMaterial::paginate(5);
            $tags = EducationalMaterial::existingTags();
            if (Auth::user()->hasRole('admin'))
            {
                return view('/eduMaterials/adminEduMaterials',['eduMaterials'=>$educationalMaterials,'tags'=>$tags]);
            }
            else
            {
                return view('/eduMaterials/searchEduMaterials',['eduMaterials'=>$educationalMaterials,'tags'=>$tags]);
            }
                  
            
    }

    
    public function findSearch(Request $request)
    {
        //validation (One of the field must be filled)
        $this->validate($request, [
            'searchVariable' => 'required_without_all:tags',
            'tags' => 'required_without_all:searchVariable',
        ]);
        
        $search = $request->searchVariable;
        
         //Current existing tags for all the conditions to return back to the search page
         $tags = EducationalMaterial::existingTags();

          //If tags is not set, just search text field will do
          if (!isset($request->tags))
          {
              $result = EducationalMaterial::where('title', 'LIKE', '%'.$search.'%')->distinct()->paginate(5);
            
            
          }

         else
          {
               $result = EducationalMaterial::where('title', 'LIKE', '%'.$search.'%')->withAllTags($request->tags)->distinct()->paginate(5);

          } 
        
        if (count ( $result ) > 0)
        {
            return redirect()->route('eduMaterial.search')->with(['searchResults'=>$result,'tags'=>$tags,]);
        } 
        else
            {
          
          
                return redirect()->route('eduMaterial.search')->with(['message'=>'No results found','tags'=>$tags,]);
            }
        
        
            
    }

    public function viewShow($id)
    {
        //Get one record of the educational material which matches the id 
        $educationalMaterial= EducationalMaterial::whereid($id)->first();
        return view('/eduMaterials/viewEduMaterials',['eduMaterial'=>$educationalMaterial]);
    }

    public function editShow($id)
    {
        //Get one record of the educational material which matches the id 
        $educationalMaterial= EducationalMaterial::whereid($id)->first();
        return view('/eduMaterials/editEduMaterials',['eduMaterial'=>$educationalMaterial]);
    }

    public function update(Request $request,$id)
    {
         //validation
         $this->validate($request, [
            'hCondTitle' => 'required',
            'hCondDesc' => 'required',
            'tags' => 'required',
            'exampleCheck1' =>'accepted'
        ]);

        //Update the educational material record 
        $educationalMaterial = EducationalMaterial::find($id);
        $educationalMaterial->title = $request->hCondTitle;
        $educationalMaterial->eduDesc = $request->hCondDesc;
        $educationalMaterial->save();

        $educationalMaterial->retag($request->tags);
        DB::table('tagging_tags')->where('count','0')->delete();
    
         //Redirect to the same page
        Session::flash('succ', 'Educational material has been updated successfully');
        return redirect()->back();

    
    }

    public function destroy(EducationalMaterial $edu)
    {
        $edu->untag();
        $edu->delete();  
        DB::table('tagging_tags')->where('count','0')->delete();
        Session::flash('succ', 'Educational material has been deleted successfully');
        return redirect()->back();
    }
    
    
}
