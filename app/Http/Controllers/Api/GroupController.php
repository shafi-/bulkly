<?php

namespace Bulkly\Http\Controllers\Api;

use Illuminate\Http\Request;
use Bulkly\Http\Controllers\Controller;
use Bulkly\SocialPostGroups;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = SocialPostGroups::select('name','id','type')->get();
        return $groups;
    }
}
