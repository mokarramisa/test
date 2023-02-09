<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Promotion::where('shop_id', auth()->user()->shop_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            Promotion::create([
                'code' => $request->code, // random code generate
                'promotion_status' => $request->status,
                'promotion_type' => $request->type,
                'promotion_amount' => $request->amount,
                'promotion_total_amount' => $request->promotion_total_amount,
                'starts_at' => $request->starts_at,
                'finishes_at' => $request->finishes_at,
                'promotion_link' => $request->link,
            ]);
            
            return response([
                'status' => 'ok',
                'message' => 'کد تخفیف ایجاد شد.'
            ]);

        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }
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
    public function show($id)
    {
        
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
        try {
            DB::beginTransaction();
            Promotion::create([
                'code' => $request->code, // random code generate
                'promotion_status' => $request->status,
                'promotion_type' => $request->type,
                'promotion_amount' => $request->amount,
                'promotion_total_amount' => $request->promotion_total_amount,
                'starts_at' => $request->starts_at,
                'finishes_at' => $request->finishes_at,
                'promotion_link' => $request->link,
            ]);
            
            return response([
                'status' => 'ok',
                'message' => 'کد تخفیف آپدیت شد.'
            ]);

        } catch (\Exception $ex) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro = Promotion::where('id', $id)->delete();

        return response([
            'status' => true,
            'message' => 'کد حذف شد'
        ]);

    }
}
