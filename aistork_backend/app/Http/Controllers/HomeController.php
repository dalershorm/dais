<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Post;
use App\Models\ReportDaily;
use App\Models\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function posts() {
        return response()->json([
            'posts' => Post::where('is_active', 1)->orderBy('id', 'desc')->get()
        ]);
    }

    public function singlePost($id) {
        $post = Post::where('is_active', 1)->findOrFail($id);

        return response()->json([
            'posts' => $post
        ]);
    }

    public function otherStatus()
    {
        return response()->json([
            'statuses' => Status::select('id', 'name', 'status_resource_id')->where('status_resource_id', ReportDaily::STATUS_RESOURCE_ID)->get()
        ]);
    }
}
