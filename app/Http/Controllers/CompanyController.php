<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        return view('company.dashboard');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // Add more validation rules for other fields
        ]);
    // dd($request->all());
        // Create a new company record
        $company = new Company();
        $company->name = $validatedData['name'];
        $company->address = $validatedData['address'];
        // Set other fields as needed
        $company->save();
    
        // Return a JSON response indicating success
        return response()->json(['message' => 'Company data saved successfully']);
    }
    

    // public function store(Request $request){
        
    //    $company= Company::updateOrCreate(
    //         ['id'=>$request->id],
    //         ['name'=>$request->name],
    //         ['address'=>$request->address]

    //     );
    //     return response()->json($company);
    // }
    public function edit(Company $company){

        return response()->json($company);
    }
    public function update(Request $request,Company $company)
    {
        // dd($company,$request->all());
        // die;
        
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];
        
        $validatedData=  $this->validate($request, $rules);
//         dd($validatedData);
// die;
    $company->update($validatedData);
    
        // // Update the company record
        // $company->name = $validatedData['name'];
        // $company->address = $validatedData['address'];
        // $company->save();
    
        // Return a success response
        return response()->json(['success' => true]);
    }
    public function destroy(Company $company)
{
  

    if (!$company) {
        return response()->json(['error' => 'Company not found'], 404);
    }

    // Delete the company
    $company->delete();

    // Return a JSON response indicating success
    return response()->json(['message' => 'Company deleted successfully']);
}

}
