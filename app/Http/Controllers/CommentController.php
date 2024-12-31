<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Feature $feature)
    {
        // Validate the request
        $data = request()->validate([
            'comment' => 'required|string',
        ]);

        $data['feature_id'] = $feature->id;
        $data['user_id'] = Auth::id();
        // Create a new comment
        Comment::create($data);
        return to_route('features.show', $feature);
    }

    public function destroy(Comment $comment)
    {
        $featureId = $comment->feature_id;
        $comment->delete();
        return to_route('features.show', $featureId);
    }
}
