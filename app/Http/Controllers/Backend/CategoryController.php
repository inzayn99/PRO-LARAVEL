<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends BackendController
{
    public function index(Request $request)
    {
        if (!empty($request->search_category)) {
            $search = $request->search_category;
            $categoryData = Category::where('cat_name','LIKE','%'. $search .'%')->paginate(5);
            $this->data('categoryData', $categoryData);
            if(empty($categoryData->first())){
                return redirect()->route('category')->with('error','Data not found');
            }else{
                return view($this->pagePath . 'category.show-category', $this->data);
            }

        } else {
            $categoryData = Category::orderBy('id', 'desc')->paginate(5);
            $this->data('categoryData', $categoryData);
            return view($this->pagePath . 'category.show-category', $this->data);
        }

    }
    public function slugGenerator($data){
        return str_replace(' ','-',trim($data));
    }
    public function add(Request $request){

        if($request->isMethod('get')){
            return view($this->pagePath.'category.add-category',$this->data);
        }
        if($request->isMethod('post')){
            $this->validate($request, [
                'cat_name' => 'required|unique:categories,cat_name',
                'slug' => 'required|unique:categories,cat_name',
            ]);


            //inserting data using object
            $catObj=new Category();
            $catObj->cat_name=$request->cat_name;
            $catObj->slug=$this->slugGenerator($request->slug);
            $catObj->meta_keywords=$request->meta_keywords;
            $catObj->meta_description=$request->meta_description;
            $catObj->description=$request->description;
            $catObj->posted_by=Auth::guard('admin')->user()->id;

            if($catObj->save()){
                return redirect()->route('category')->with('success','Data inserted Succesfully');
            }else{
                return redirect()->back()->with('error','Data cannot inserted ');
            }
        }
    }

    public function updateStatus(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $id = $request->criteria;
            $findUser = Category::findOrFail($id);
            if (isset($_POST['active'])) {
                $findUser->status = 0;
                $message = "Status Updated to Inactive";
            }
            if (isset($_POST['inactive'])) {
                $findUser->status = 1;
                $message = "Status Updated to Active";
            }
            if ($findUser->update()) {
                return redirect()->back()->with('success', $message);
            }
        }
    }

    public function delete(Request $request)
    {
        $id = $request->criteria;
        if (Category::findOrFail($id)->delete()) {
            return redirect()->route("category")->with('success', "Data Deleted Successfully");
        }
    }

    public function edit(Request $request)
    {
        $id = $request->criteria;
        $categoryData = Category::findOrFail($id);
        $this->data('categoryData', $categoryData);
        return view($this->pagePath . 'category.edit-category', $this->data);
    }

    public function editAction(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $id = $request->criteria;
            $this->validate($request, [
                'cat_name' => 'required',[
                    Rule::unique('categories','slug')->ignore($id)
                ],
                'slug' => 'required',[
                    Rule::unique('categories','slug')->ignore($id)
                ]
            ]);

            $data['cat_name'] = $request->cat_name;
            $data['slug'] = $request->slug;
            $data['meta_keywords'] = $request->meta_keywords;
            $data['meta_description'] = $request->meta_keywords;
            $data['description'] = $request->meta_keywords;
            $data['posted_by']=Auth::guard('admin')->user()->id;

            if (Category::findOrFail($id)->update($data)) {
                return redirect()->route('category')->with('success', 'Data was successfully Updated');
            } else {
                return redirect()->back()->with('error', 'Data was not Updated');
            }
        }
    }
}
