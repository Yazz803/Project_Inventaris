<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use App\DataTables\LendingsDataTable;

class LendingOperatorController extends Controller
{
    public function index(LendingsDataTable $dataTables){
        return $dataTables->render('dashboard.lendingOperator.index');
    }

    public function create() {
        $items = Item::all();
        return view('dashboard.lendingOperator.create', compact('items'));
    }

    public function store(Request $request) {
        $request->validate([
            'addmore.*.name' => 'required',
            'addmore.*.item_id' => 'required',
            'addmore.*.total' => 'required',
            'addmore.*.keterangan' => 'required',
            'addmore.*.edited_by' => 'required'
        ]);

        foreach($request->addmore as $key => $value){
            // jika available yang dipinjam lebih besar dari available yang ada
            
            $spesificItem = Item::find($value['item_id']);
            if($value['total'] <= $spesificItem->available){
                Lending::create($value);
                Item::find($value['item_id'])->update([
                    'available' => $spesificItem->available - $value['total']
                ]);
            }

            if($value['total'] > $spesificItem->available) {
                return redirect()->route('dashboard.operator.lending.create')
                ->with(
                    'error', 
                    'Total yang dipinjam tidak boleh lebih dari total yang ada! ' . '<span class="font-weight-bold">' . $spesificItem->name . ' => Available : ' . $spesificItem->available . '</span>'
                );
            }

        }

        return redirect()->route('dashboard.operator.lending.index')->with('success', 'Peminjaman Berhasil Ditambahkan!');
    }

    public function returned(Lending $lending) {
        $lending->returned = now();
        $lending->updated_at = now();
        $lending->total_return = $lending->total;

        $lending->item->available += $lending->total;
        $lending->item->save();

        $lending->total = 0;

        $lending->save();

        return redirect()->route('dashboard.operator.lending.index')->with('success', 'Pengembalian Berhasil!');
    }

    public function delete(Lending $lending) {
        $lending->delete();

        return redirect()->route('dashboard.operator.lending.index')->with('success', 'Peminjaman Berhasil Dihapus!');
    }
}
