<?php

namespace Bulkly\Http\Controllers\Api;

use Illuminate\Http\Request;
use Bulkly\Http\Controllers\Controller;
use Bulkly\BufferPosting;

class BufferPostController extends Controller
{
    public function index(Request $request)
    {
        $posts = BufferPosting::with(['accountInfo' => function($q) {
            $q->select('id', 'name', 'type');
        },
        'groupInfo' => function ($q) {
            $q->select('id', 'name', 'type');
        }])->limit(100)->get();

        return $posts;
    }
}
