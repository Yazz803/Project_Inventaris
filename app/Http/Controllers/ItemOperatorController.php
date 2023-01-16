<?php

namespace App\Http\Controllers;

use App\DataTables\ItemsDataTable;
use Illuminate\Http\Request;

class ItemOperatorController extends Controller
{
    public function index(ItemsDataTable $dataTables){
        return $dataTables->render('dashboard.itemOperator.index');
    }
}
