<?php

namespace App\Http\Controllers;

use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{

    public function index()
    {
        $logs = DB::table('logs')->orderBy('id','desc')->paginate(500);
        $count_logs = DB::table('logs')->count();
        return view(
            'logs.index',
            [
                'logs' => $logs,
                'count_logs' => $count_logs,
            ]
        );
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

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('logs.show', [
            'log' => Logs::findOrFail($id),
        ]);
    }


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
    }
}
