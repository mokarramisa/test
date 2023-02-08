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
        $adminShopId = auth()->user()->shop_id;

        $orderingFilter = [
            'registeration_time' => User::registerationTime($adminShopId),
            'orders_count'       => User::orderCount($adminShopId),
            'total_fee'          => User::fee($adminShopId)
        ];
        $statusFilter = [
            'not purchased' => 'Pending',
            'purchased'     => 'Success'
        ];

        if (is_null($payLoad)) {
            $user = User::where('shop_id', $adminShopId)->get();
            return UserListsResource::collection($user);
        }

        if ($request->has('ordering')) {
            $user = $orderingFilter[$request->ordering];
            return UserListsResource::collection($user);
        }

        if ($request->has('status')) {
            $orders = Order::where('order_status', $statusFilter[$request->status])->get();
            
            foreach ($orders as $order) {
                $user[] = $order->user()->where('shop_id', $adminShopId)->first();    
            }

            return UserListsResource::collection(collect(array_filter($user, 'strlen')));
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
