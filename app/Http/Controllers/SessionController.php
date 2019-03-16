<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\session;
use App\driver;
use App\sesion;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view ('pages.front');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trip=driver::all();
        
        return view ('pages.session')->with('trip',$trip);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //$x= \Request::ip();
        $x='103.216.145.228';
        $add = \Location::get($x);
        //dd($add);
        
        $e= driver::find($id);
        $data=sesion::all();
        
        $q= ($e->end);
        $d1=strtotime($q);
        $d2=time();
        print_r($d1."  ");
        print_r($d2);
        $val=date("Y-m-d h:i:s");
        return view('pages.start')->with('data',$data)->with('add',$add)->with('end',$d2);
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
