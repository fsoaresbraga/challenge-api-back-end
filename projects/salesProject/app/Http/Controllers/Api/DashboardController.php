<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DashboardResource;


class DashboardController extends Controller
{

    public function index() {

        if(Auth::user()->profile_id ==  User::SALESMAN) {

            return response()->json(['errors' => ['message' => config('messages.noPermission.message')]], config('messages.noPermission.statusCode'));
        }

        $units = DB::table('unities')
                    ->join('companies', 'companies.unity_id', '=', 'unities.id')
                    ->join('users', 'users.company_id', '=', 'companies.id')
                    ->leftJoin('sales', 'sales.user_id', '=', 'users.id')
                    ->select('unities.name', DB::raw("count(sales.user_id) as count"))
                    ->groupBy('sales.user_id', 'unities.name')
                    ->orderBy('unities.name', 'ASC')
                    ->get()
                    ->toArray();

        return DashboardResource::collection($units);

    }
}
