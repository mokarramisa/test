<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserListsResource;
use App\Models\Access;
use App\Models\Order;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewUser (Request $request)
    {
        $payLoad = $request->all();

        if (is_null($payLoad)) {
            $user = User::all();
            return UserListsResource::collection($user);
        }

        $statusFilter = [
            'not purchased' => false,
            'purchased'     => true
        ];

        if ($request->status == 'not purchased') {

            //dd(Order::find(1)->user);
            $users = Order::where('order_status', 'Pending')->user;
            dd($users);
            //$users = Order::find(1)->user;
            //$users = Order::where('order_status', 'active')->user;
            //dd($users);
            //return UserListsResource::collection($user);


            $users = User::with(['orders' => function ($query) {
                $query->where('oredr_number', '123');
            }])->get();

            dd($users);
        }

        $ordering = [
            'registeration_time',
            'orders_count',
            'total_fee'
        ];

        if ($request->ordering == 'registeration_time') {
            $user = User::orderByDesc('created_at')->get();
            return UserListsResource::collection($user);
        }

        if ($request->ordering == 'orders_count') {
            $user = User::with('orders')->withCount('orders')->orderByDesc('orders_count')->get();
            return UserListsResource::collection($user);
        }

        if ($request->ordering == 'total_fee') {
            $user = User::withSum('orders', 'total_fee')->orderByDesc('orders_sum_total_fee')->get();
            return UserListsResource::collection($user);
        }
    }

    public function addPermission (Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response('user not found');
        }

        $user->attachPermission(Permission::where('id', $request->permId)->first());
    }

    public function show(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response('user not found');
        }

        return new UserListsResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
