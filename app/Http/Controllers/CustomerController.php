<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::select('*');
        $tableData = (new Customer)->getTableProperties();
        $data = $data->searchAllFields($tableData);
        return bd_json($data);
    }

    public function store(Request $request)
    {
        $data = (new Customer)->record($request);      
        return bd_json($data);
    }

    public function show($id)
    {
        $data = Customer::find($id);
        return bd_json($data);
    }

    public function update(Request $request, $id)
    {
        $data = Customer::find($id)->record($request);
        return bd_json($data);
    }

    public function destroy($id)
    {
        $data = Customer::find($id);
        if ($data) {
            $data->delete();
        }
        return bd_json($data);
    }
    
}
