<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        $products = Product::orderBy('id','DESC')->get();
        return view('company.dashboard',compact('products'));
    }
    public function store(Request $request)
    {
     
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
      
        ]);
    
        $company = new Company();
        $company->name = $validatedData['name'];
        $company->address = $validatedData['address'];
        $company->save();

        return response()->json(['message' => 'Company data saved successfully']);
    }
    

        public function edit(Company $company){

            return response()->json($company);
        }
        public function update(Request $request,Company $company)
        {
            
            $rules = [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ];
            
            $validatedData=  $this->validate($request, $rules);

        $company->update($validatedData);
        

            return response()->json(['success' => true]);
        }
        public function destroy(Company $company)
    {
    
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }


        $company->delete();
        return response()->json(['message' => 'Company deleted successfully']);
    }

}
