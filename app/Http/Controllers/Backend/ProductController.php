<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Category;



class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $data = Product::all();
            return view('backend.product.index', compact('data'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('backend.product.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $product=Product::create($request->all());
            if($product){
                $request->session()->flash('success','Product added successfuly');
            }else{
                $request->session()->flash('error','Product addition failed');
            }
         }
         catch (\Exception $exception){
             $request->session()->flash('error','Error'.$exception->getMessage());
         }
         return redirect()->route('backend.product.index');
     }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('backend.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $product = Product::find($id);
            if(!$product)
            {
               request()->session()->flash('error','Error:Invalid Request');
               return redirect()->route('backend.product.index');
            }
        }
        catch(Exception $exception)
        {
           request()->session()->flash('error','Error:'.$exception->getMessage());
        }
        return view('backend.product.edit',compact('product'));
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
        try
       {
           $product = Product::find($id);
           if(!$product)
           {
              request()->session()->flash('error','Error:Invalid Request');
              return redirect()->route('backend.product.index');
           }
           if($product->update($request->all()))
           {
            request()->session()->flash('success','Updated');
            
           }else
           {
            request()->session()->flash('error','Updated failed');
           }

         }
       catch(Exception $exception)
       {
          request()->session()->flash('error','Error:'.$exception->getMessage());
       }
       return redirect()->route('backend.product.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
       {
           $product = Product::find($id);
           if($product->delete())
           {
              request()->session()->flash('success','Product Deleted Successfully!!');
           }
           else
           {
            request()->session()->flash('error','Product Deleted Failed');
           }

       }
       catch(Exception $exception)
       {
          request()->session()->flash('error','Error:'.$exception->getMessage());
       }
       return redirect()->route('backend.product.index');
    }
}
