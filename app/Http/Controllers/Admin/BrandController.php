<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Http\Controllers\BaseController;


class BrandController extends Controller
{

    public function __construct(BrandContract $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brandRepository->listBrands();

        //$this->setPageTitle('Brands', 'List of all brands');
        $pageTitle = "Brands";
        $subTitle = "List of all brands";

        return view('admin.brands.index', compact('brands', 'pageTitle', 'subTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->setPageTitle('Brands', 'Create Brand');
        $pageTitle = "Brands";
        $subTitle = "Create Brand";

        return view('admin.brands.create',compact('pageTitle','subTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $brand = $this->brandRepository->createBrand($params);

        if (!$brand) {
            return back()->with( 'error','Error occurred while creating brand');
        }
        return redirect()->route('admin.brands.index')->with( 'success','Brand added successfully');
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
        $brand = $this->brandRepository->findBrandById($id);

        $pageTitle = "Brands";
        $subTitle = "Edit Brand : " . $brand->name;
        return view('admin.brands.edit', compact('brand','pageTitle','subTitle'));
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
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);
    
        $params = $request->except('_token');
    
        $brand = $this->brandRepository->updateBrand($params);
    
        if (!$brand) {
            return back()->with( 'error','Error occurred while updating brand.');
        }
        return back()->with( 'success','Brand updated successfully');

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->deleteBrand($id);

    if (!$brand) {
        return back()->with( 'error','Error occurred while deleting brand.');
    }
    return redirect()->route('admin.brands.index')->with( 'success','Brand deleted successfully');

    }
}
