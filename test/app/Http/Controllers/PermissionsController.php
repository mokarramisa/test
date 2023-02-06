<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $permissions = [
            // 'level-1' => [
            //     'Products Management' => 'مدیریت محصولات',
            //     'Product form Management' => 'مدیریت فرم محصولات',
            //     'Categories Management' => 'مدیریت دسته بندی ها',
            //     'Weblog and Pages Management' => 'مدیریت وبلاگ',
            //     'Orders Management' => 'مدیریت سفارشات',
            //     'Discount Code' => 'کد تخفیف',
            //     'Users Management' => 'مدیریت کاربران',
            //     'Access Management' => 'مدیریت دسترسی ها',
            //     'Reports' => 'گزارشات',
            //     'Activities' => 'فعالیت ها',
            // ],
            'level2' => [
                'Show Product'   => 'مشاهده محصول',
                'Create Product' => 'ایجاد محصول',
                'Edit Product'   => 'ویرایش محصول',
                'Delete Product' => 'حذف محصول',
                'Show Product'   => 'مشاهده فرم محصول',
                'Create Product' => 'ایجاد فرم محصول',
                'Edit Product'   => 'ویرایش فرم محصول',
                'Delete Product' => 'حذف فرم محصول',
                'Show Category'   => 'مشاهده دسته بندیها',
                'Create Category' => 'ایجاد دسته بندیها',
                'Edit Category'   => 'ویرایش دسته بندیها',
                'Delete Category' => 'حذف دسته بندیها',
                'Show Product'   => 'مشاهده وبلاگ',
                'Create Product' => 'ایجاد وبلاگ',
                'Edit Product'   => 'ویرایش وبلاگ',
                'Delete Product' => 'حذف وبلاگ',
                'Show Order'     => 'مشاهده سفارشات',
                'Edit Order Status' => 'تغییر وضعیت سفارش',
                'Show Discount Code'   => 'مشاهده کد تخفیف',
                'Create Discount Code' => 'ایجاد کد تخفیف',
                'Edit Discount Code'   => 'ویرایش کد تخفیف',
                'Delete Discount Code' => 'حذف کد تخفیف',
            ]
        ];

        foreach ($permissions as $levels) {
            foreach ($levels as $permission => $fa_permission) {
                Permission::create([
                    'name' => $permission
                ]);
            }
        }
        dd("ok");
    }
    
    public function index()
    {
        return Permission::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function make($access_id)
    {
        Permission::create([
            'name' => Access::where('id', $access_id)->first('access_name'),
        ]);

        return response([
            'status' => 'ok',
            'message' => 'permission has been created successfully!'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUser(Request $request, $permission_id)
    {
        $user = User::where('email', $request->email)->get();
        $permission = Permission::where('id', $permission_id)->first('name');
        $user->attachPermission($permission);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($permission_id, $access_id)
    {
        $permission = Permission::where('id', $permission_id)->get();
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
