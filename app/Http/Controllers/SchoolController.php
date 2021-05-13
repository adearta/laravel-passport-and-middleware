<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolModel;
use Illuminate\Support\Facades\Validator;


class SchoolController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = SchoolModel::all();
        return response()->json([
            "message" => "data",
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->middleware('admin');
        //

        $valid = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 202);
        } else {
            $data = SchoolModel::create([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'kelas' => $request->kelas
            ]);
            return response()->json([
                'message' => 'data berhasil diinput',
                'data' => $data
            ], 200);
        }
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
        //
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
        //
        // $id->update($request->all());
        // $findId = SchoolModel::find($id);
        $valid = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $post = SchoolModel::findOrfail($id);

        if ($post) {
            $post->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'kelas' => $request->kelas,
            ]);
            return response()->json([
                'message' => "data updated!"
            ], 200);
        }
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = SchoolModel::findOrfail($id);
        if ($post) {
            $post->delete();
            return response()->json([
                'message' => "data deleted!"
            ], 200);
        }
    }
}
