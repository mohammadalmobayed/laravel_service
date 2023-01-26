<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
// use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', ['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.services.new_service', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->Service_Price){
            $price = $request->Service_Price;
        }else {
            $price = 0;
        }
        if (!$request->Service_Duration){
            $duration = $request->Service_Duration;
        }else {
            $duration = 0;
        }
        
        $imgname = $request->file('Service_Image')->getClientOriginalName();
        $request->file('Service_Image')->storeAs('public/serviceimage',$imgname);
        $serv = new Service();
        $serv->Service_Name = $request->Service_Name;
        $serv->Category_id = $request->Category_id;
        $serv->Service_Description = $request->Service_Description;
        $serv->Service_Image = $imgname;
        $serv->Service_Price = $price;
        $serv->Service_Duration = $duration;
        $serv->save();
        
       
        return redirect()->route('Service.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', ['service'=> $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Category = Category::all();
        $service = Service::findOrFail($id);
        return view('admin.services.edit',['service'=> $service ,'Category'=> $Category] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       
         
        $service = Service::findOrFail($id);
        $service->Service_Name = $request->Service_Name;
        $service->Category_id  = $request->Category_id;
        $service->Service_Description = $request->Service_Description;
        $service->Service_Image = $request->Service_Image;
        $service->Service_Price = $request->Service_Price;
        $service->Service_Duration = $request->Service_Duration;
        $service->save();
        
     return redirect()->route('Service.index');

          
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        // Service::findOrFail($id)->delete();
        // return redirect()->route('services.index');
    }
}
