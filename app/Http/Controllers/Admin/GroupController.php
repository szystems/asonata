<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Group;
use App\Http\Requests\GroupFormRequest;
use App\Http\Requests\GroupEditFormRequest;
use App\Models\Category;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Requests\CategoryEditFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use DB;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryGroup=$request->input('fgroup');
            $groups=DB::table('groups')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryGroup.'%')
            ->orderBy('name','asc')
            ->paginate(25);
            $filterGroups = Group::all();
            return view('admin.group.index', compact('groups','queryGroup','filterGroups'));
        }
    }

    public function show($id)
    {
        $group = Group::find($id);
        $categories=DB::table('categories')
            ->where('status',1)
            ->where('group_id',$id)
            ->orderBy('name','asc')
            ->paginate(25);
        return view('admin.group.show', compact('group','categories'));
    }

    public function add()
    {
        return view('admin.group.add');
    }

    public function insert(GroupFormRequest $request)
    {


        $group = new Group();
        if($request->hasFile('image'))
        {
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/groups',$filename1);
            $group->image = $filename1;
        }
        if($request->hasFile('contract'))
        {
            $file2 = $request->file('contract');
            $ext2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$ext2;
            $file2->move('assets/uploads/contracts',$filename2);
            $group->contract = $filename2;
        }
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->status = 1;
        $group->save();

        return redirect('index_groups')->with('status', __('Group Added Successfully'));
    }

    public function edit($id)
    {
        $group = Group::find($id);
        return view('admin.group.edit', \compact('group'));
    }

    public function update(GroupEditFormRequest $request, $id)
    {
        $group = Group::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/groups/'.$group->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/groups',$filename1);
            $group->image = $filename1;
        }
        if($request->hasFile('contract'))
        {
            $path2 = 'assets/uploads/contracts/'.$group->contract;
            if(File::exists($path2))
            {
                File::delete($path2);
            }
            $file2 = $request->file('contract');
            $ext2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$ext2;
            $file2->move('assets/uploads/contracts',$filename2);
            $group->contract = $filename2;
        }
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->update();

        return redirect('index_groups')->with('status',__('Group Updated Successfully'));
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        if ($group->image)
        // {
        //     $path = 'assets/uploads/groups/'.$group->image;
        //     if (File::exists($path))
        //     {
        //         File::delete($path);

        //     }
        // }
        $group = Group::find($id);
        $group->status = 0;
        $group->update();
        return redirect('index_groups')->with('status',__('Group Deleted Successfully'));
    }

    public function addcategory($id)
    {
        $group_id = $id;
        return view('admin.group.addcategory', compact('group_id'));
    }

    public function insertcategory(CategoryFormRequest $request)
    {


        $category = new Category();
        if($request->hasFile('image'))
        {
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/categories',$filename1);
            $category->image = $filename1;
        }
        if($request->hasFile('contract'))
        {
            $file2 = $request->file('contract');
            $ext2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$ext2;
            $file2->move('assets/uploads/contracts/categories',$filename2);
            $category->contract = $filename2;
        }
        $category->group_id = $request->input('group_id');
        $category->name = $request->input('name');
        $category->age_from = $request->input('age_from');
        $category->age_to = $request->input('age_to');
        $category->requirements = $request->input('requirements');
        $category->implements = $request->input('implements');
        $category->description = $request->input('description');
        $category->status = 1;
        $category->save();

        $group = Group::find($category->group_id);
        $categories=DB::table('categories')
            ->where('status',1)
            ->where('group_id',$category->group_id)
            ->orderBy('name','asc')
            ->paginate(25);

        return view('admin.group.show', compact('group','categories'))->with('status',__('Category Added Successfully'));
    }

    public function editcategory($id)
    {
        $category = Category::find($id);
        return view('admin.group.editcategory', \compact('category'));
    }

    public function updatecategory(CategoryEditFormRequest $request, $id)
    {
        $category = Category::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/categories/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file1 = $request->file('image');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/categories',$filename1);
            $category->image = $filename1;
        }
        if($request->hasFile('contract'))
        {
            $path2 = 'assets/uploads/contracts/categories'.$category->contract;
            if(File::exists($path2))
            {
                File::delete($path2);
            }
            $file2 = $request->file('contract');
            $ext2 = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$ext2;
            $file2->move('assets/uploads/contracts/categories',$filename2);
            $category->contract = $filename2;
        }
        $category->name = $request->input('name');
        $category->age_from = $request->input('age_from');
        $category->age_to = $request->input('age_to');
        $category->requirements = $request->input('requirements');
        $category->implements = $request->input('implements');
        $category->description = $request->input('description');
        $category->update();

        $group = Group::find($category->group_id);
        $categories=DB::table('categories')
            ->where('status',1)
            ->where('group_id',$category->group_id)
            ->orderBy('name','asc')
            ->paginate(25);

        return view('admin.group.show', compact('group','categories'))->with('status',__('Category Added Successfully'));
    }

    public function showcategory($id)
    {
        $category = Category::find($id);
        $group = Group::find($category->group_id);
        return view('admin.group.showcategory', compact('category','group'));
    }

    public function destroycategory($id)
    {
        // $category = Category::find($id);
        // if ($category->image)
        // {
        //     $path = 'assets/uploads/groups/'.$group->image;
        //     if (File::exists($path))
        //     {
        //         File::delete($path);

        //     }
        // }
        $category = Category::find($id);
        $category->status = 0;
        $category->update();

        $group = Group::find($category->group_id);
        $categories=DB::table('categories')
            ->where('status',1)
            ->where('group_id',$category->group_id)
            ->orderBy('name','asc')
            ->paginate(25);

        return view('admin.group.show', compact('group','categories'))->with('status',__('Category Added Successfully'));
    }
}
