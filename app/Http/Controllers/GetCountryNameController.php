<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetCountryNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index()
        {
            $countryName = getenv('COUNTRY_NAME');

            if ($countryName == 'COLOMBIA') {
                $url = 'https://corresponsales.asparecargas.net/transaction/detail/';
            }
            if ($countryName == 'ECUADOR') {
                $url = 'https://transacciones.asparecargas.net/transaction/detail/';
            }
            $responseBody = [
                'data' => $url
            ];

            return json_encode($responseBody);
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