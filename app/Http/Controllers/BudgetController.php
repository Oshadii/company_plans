<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Company;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function storeBudget(Request $request){
        
        $string_expenses = implode(',', $request->expense_names);
        $string_estimated_price = implode(',', $request->estimated_prices);
        $alldetails=$request->all();
        $alldetails['expense_name']=$string_expenses;
        $alldetails['estimated_price']=$string_estimated_price;
        Budget::create($alldetails);
        return "Saved budget successfully";
    }
    public function updateBudget(Request $request){
        
        $budget=Budget::find($request->budget_id);
        $string_expenses = implode(',', $request->expense_names);
        $string_estimated_price = implode(',', $request->estimated_prices);

        $input = $request->all();
        $input['expense_name']=$string_expenses;
        $input['estimated_price']=$string_estimated_price;

        $budget->update($input);

        // return $budget;        
    }
}
