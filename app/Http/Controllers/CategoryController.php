<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $categories->load('products');
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate($this->rules());           
            
        if(request('image')){
            $imagePath =  request('image')->store('category', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            
            $imageArray = ['image' => $imagePath];
            }
            Category::create(array_merge(
                $data, 
                $imageArray ?? []
            ));

        return response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category->load('products');
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = request()->validate($this->rules());
            
            
            
            if(request('imagePath')){
                $imagePath =  request('imagePath')->store('category', 'public');
                
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
                $image->save();
                
                $imageArray = ['imagePath' => $imagePath];
            }

            $category->update(array_merge(
                $data, 
                $imageArray ?? []
            ));
            return response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->products()->delete();
        $category->delete();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'max:1000000',
        ];
    }

    
    public function load(Category $category)
    {
        $category = New Category;
        $category->name = 'Vývary';
        $category->save();
        $category = New Category;
        $category->name = 'Polévky';
        $category->save();
        $category = New Category;
        $category->name = 'Štávy';
        $category->save();
        $category = New Category;
        $category->name = 'Základy a omáčky';
        $category->save();
        $category = New Category;
        $category->name = 'Kořenící směsi';
        $category->save();
        $category = New Category;
        $category->name = 'Koření';
        $category->save();
        $category = New Category;
        $category->name = 'Vložky a závařky';
        $category->save();
        $category = New Category;
        $category->name = 'Sterilované výrobky';
        $category->save();
        $category = New Category;
        $category->name = 'Přílohy';
        $category->save();
        $category = New Category;
        $category->name = 'Těstoviny';
        $category->save();
        $category = New Category;
        $category->name = 'Moučníky';
        $category->save();
        $category = New Category;
        $category->name = 'Džemy';
        $category->save();
        $category = New Category;
        $category->name = 'Dezertní omáčky';
        $category->save();
        $category = New Category;
        $category->name = 'Nápoje';
        $category->save();
        $category = New Category;
        $category->name = 'Zdravá výživa';
        $category->save();
        $category = New Category;
        $category->name = 'Doplňkový sortiment';
        $category->save();
        $category = New Category;
        $category->name = 'Ostatní';
        $category->save();

        return back();
    }
}
