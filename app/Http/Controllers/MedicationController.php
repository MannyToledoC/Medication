<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return DB::table('medications')
        ->select('id','name', 'dosage', 'schedule')
        ->where('user_id', $user->id)
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $field = $request->validate([
            'name' => 'required|string',
            'dosage' => 'required|string',
            'schedule' => 'required|string',
        ]);

        $med = Medication::create([
            'name' => $field['name'],
            'user_id' => $user->id,
            'dosage' => $field['dosage'],
            'schedule' => $field['schedule'],
        ]);

        $response = [
            'id'       => $med->id,
            'user'     => $user->name,
            'name'     => $med->name,
            'dosage'   => $med->dosage,
            'schedule' => $med->schedule,
        ];
        return response($response, 201);
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
        $med = Medication::find($id);
        $response = [
            'id'       => $med->id,
            'name'     => $med->name,
            'dosage'   => $med->dosage,
            'schedule' => $med->schedule,
        ];
        $med->delete();
        return response($response, 201);
    }
}
