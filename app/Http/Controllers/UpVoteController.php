<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Upvote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpVoteController extends Controller
{

    public function store(Request $request, Feature $feature){
      $data  =  $request->validate([
            'upvote'=>['required','boolean']
        ]);
        Upvote::updateOrCreate(
            ['feature_id'=>$feature->id,'user_id'=>Auth::id()],
            ['upvote'=>$data['upvote']]
        );

        return back();
       }

       public function destroy(Feature $feature){
        $feature->upvotes()->where('user_id', Auth::id())->delete();
        return back();
       }
}
