<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting as SettingModel;
use SebastianBergmann\Type\NullType;

/**
 * Settings Controller
 * 
 * @author Mark Wickline 2023-01-02
 */
class Setting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $request->validate([
            'code' => 'required|max:255',
            'code_alt' => 'required|max:255',
            'value' => 'required',
        ]);
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
     * Get a setting by code and code alt
     *
     * @param  string  $code
     * @param  string  $codeAlt
     * @return \Illuminate\Http\Response
     */
    public function showByCode(string $code, string | null $codeAlt = null)
    {
        if ($codeAlt) {
            $setting = SettingModel::where('code', $code)
                ->where('code_alt', $codeAlt)
                ->first();
            if ($setting) {
                return $this->jsonResponse($setting->toArray());
            }
        }
        return $this->jsonFailResponse('Setting not found', 404);
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
