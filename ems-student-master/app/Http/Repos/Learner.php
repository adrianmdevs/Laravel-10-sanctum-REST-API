<?php
/**
 * Created by PhpStorm.
 * User: Silicon
 * Date: 10/15/2018
 * Time: 1:34 AM
 */

Namespace App\Http\Repos;

use App\Member;
use Illuminate\Support\Facades\Auth;

class Learner
{
    public static function user()
    {
        $id = Auth::user()->member->id;
        $member = Member::find($id);
        return $member;
    }
}