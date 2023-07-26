<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function storeAuthorDetails(Request $request){
        // return $request->company_id;
        $author=$request->all();
        Author::create($author);
        $authors=Author::where('company_id',$request->company_id)->get();
        return ['Author added successfully',$authors]; 
    }
    public function updateAuthors(Request $request){
        $author=Author::find($request->author_id);
        $input = $request->all();
        $author->update($input);
        // return 'updated';        
    }
    public function delete_added_author( $id) {
        $query = Author::findOrFail($id);
        $query->delete();
        return 'Author deleted';
    }
}
