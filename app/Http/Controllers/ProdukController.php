<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::select('*');
        $tableData = (new Produk)->getTableProperties();
        $data = $data->searchAllFields($tableData);
        return bd_json($data);
    }

    public function store(Request $request)
    {
        $data = (new Produk)->record($request);      
        return bd_json($data);
    }

    public function show($id)
    {
        $data = Produk::find($id);
        return bd_json($data);
    }

    public function update(Request $request, $id)
    {
        $data = Produk::find($id)->record($request);
        return bd_json($data);
    }

    public function destroy($id)
    {
        $data = Produk::find($id);
        if ($data) {
            $data->delete();
        }
        return bd_json($data);
    }


}
