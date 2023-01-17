<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\ItemsDataTable;
use App\DataTables\ItemsOperatorDataTable;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemsDataTable $dataTables)
    {
        return $dataTables->render('dashboard.item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'total' => 'required'
        ]);
        $validated['available'] = $request->total;

        Item::create($validated);

        return redirect()->route('item.index')->with('success', 'Item Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('dashboard.item.edit', compact(['item', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'total' => 'required',
        ]);

        if($request->repair == 0){
            $validated['available'] = $request->total - $item->lendings->sum('total') - $item->repair;;
        }else{
            if($request->repair < 0){
                if(abs($request->repair) > $item->repair){
                    return redirect()->back()->with('error', 'Total/currentrly Repair Tidak boleh sampai minus!');
                }else{
                    $validated['available'] = $item->available - $item->lendings->sum('total') - $request->repair;
                }
            }else{
                $validated['available'] = $request->total - $item->lendings->sum('total') - abs($request->repair);
            }
        }


        $validated['repair'] = $item->repair + $request->repair;

        $item->update($validated);

        return redirect()->route('item.index')->with('success', 'Item Berhasil Di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
