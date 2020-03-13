<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;
use Intervention\Image\Facades\Image;
//need to add policies

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categories->load('products');
        return CategoryResource::collection($categories);
    }

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

    public function show(Category $category)
    {
        $category->load('products');
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        //need to add policies
        dd(request());
            // $data = request()->validate($this->rules());        
            // if(request('image')){
            //     $imagePath =  request('image')->store('category', 'public');
                
            //     $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            //     $image->save();
                
            //     $imageArray = ['image' => $imagePath];
            // }

            // $category->update(array_merge(
            //     $data, 
            //     $imageArray ?? []
            // ));
            // return response('success');
    }

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
