<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryContract $categoryRepository
     */
    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories();

        $pageTitle = "Categories";
        $subTitle = "List of all categories";

        return view('admin.categories.index', compact('categories', 'pageTitle', 'subTitle'));
    }

    public function show($id)
    {
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->treeList();

        $pageTitle = "Categories";
        $subTitle = "Create Category";
        return view('admin.categories.create', compact('categories','pageTitle','subTitle'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->createCategory($params);

        if (!$category) {
            return back()->with( 'error','Error occurred while creating category.');
        }
        return redirect()->route('admin.categories.index')->with( 'success','Category added successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $category = $this->categoryRepository->findCategoryById($id);

        $targetCategory = $this->categoryRepository->findCategoryById($id);
        $categories = $this->categoryRepository->treeList();

        
        $pageTitle = "Categories";
        $subTitle = "Edit Category : " . $targetCategory->name;
        return view('admin.categories.edit', compact('categories', 'targetCategory','pageTitle','subTitle','category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->updateCategory($params);

        if (!$category) {
            return back()->with( 'error','Error occurred while updating category.');
        }
        return back()->with( 'success','Category updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);

        if (!$category) {
            return back()->with( 'error','Error occurred while deleting category.');
        }
        return redirect()->route('admin.categories.index')->with( 'success','category deleted successfully');
    }
}