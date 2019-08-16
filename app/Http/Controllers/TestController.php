<?php

/* File yang berkaitan

App/Test (Model)
Database/Migrations/create_tests_table (Migrasi Database)

*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\TestDetail;

class TestController extends Controller
{
    //Menampilkan seluruh data test
    public function index()
    {
        //Beri sql query dari model Test
        $data = Test::select('*'); //untuk index() kita akan select all

        $tableData = (new Test)->getTableProperties(); //Ambil property tabel dari test
        $data = $data->searchAllFields($tableData); //Filter data dengan property tadi

        return bd_json($data); //Return ke dalam bentuk json untuk diambil front end
    }

    //Menginsert data test
    public function store(Request $request)
    {
        //panggil new <NamaModel> untuk membuat model baru dan 'record' request di dalamnya
        $data = (new Test)->record($request);
        //jika terdapat detail, insert juga detailnya
        $data = $data->recordDetail($request->detail);
        return bd_json($data);
    }

    //Mengambil data by id
    public function show($id)
    {
        $data = Test::find($id);
        return bd_json($data);
    }

    //Mengupdate data by id
    public function update(Request $request, $id)
    {
        //Mengambil model data by id dan mengisi dengan 'record' request baru
        $data = Test::find($id)->record($request);
        //Jika terdapat detail maka hapus detail yang ada, kemudian isi kembali
        $data = $data->deleteDetail()->recordDetail($request->detail);
        return bd_json($data);
    }

    //Menghapus data by id
    public function destroy($id)
    {
        //Mengambil model data by id
        $data = Test::find($id);
        if ($data) {
            //Jika model ada, maka hapus
            $data->deleteDetail(); //hapus detailnya jika perlu
            $data->delete();
        }

        return bd_json($data);
    }

    //Mengambil semua data dengan detail
    public function indexWithDetail() {
        //Mengambil model semua data test
        $parentData = Test::select('*');
        //Mengambil model semua data testdetail
        $detailData = TestDetail::select('*');

        //Menjoin parent dengan detail
        //      ModelParent->joinModel(ModelDetail, NamaTabelDetail, PrimaryKeyParent, ForeignKeyParentPadaDetail)
        $data = $parentData->joinModel($detailData, 'test_detail' , 'test.id' , 'test_detail.id_test');

        $parentTableData = (new Test)->getTableProperties(); //Ambil property tabel dari test
        $detailTableData = (new TestDetail)->getTableProperties(); //Ambil property tabel dari test
        $data = $data->searchAllFields($parentTableData,$detailTableData); //Filter data dengan property tadi

        return bd_json($data);
    }

    //Mengambil satu data dengan detail
    public function showWithDetail($id) {
        //Mengambil model dengan where, karena find tidak berfungsi untuk join
        $parentData = Test::select('*')->where('test.id','=',$id);
        $detailData = TestDetail::select('*');
        $data = $parentData->joinModel($detailData, 'test_detail','test.id','test_detail.id_test');
        
        return bd_json($data);
    }


}
