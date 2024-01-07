<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\User;
use App\Models\Letter;

class ResultsController extends Controller
{
    public function create($id)
    {
        $user = User::where('role', 'guru')->get();
        $letters = Letter::find($id);

        return view('userGuru.result', compact('user', 'letters'));
    }

    public function store(Request $request)
    {
        $arrayDistinct = array_count_values($request->presence_recipients);
        $arrayAssoc = [];

        foreach ($arrayDistinct as $id => $count) {
            $user = User::find($id);

            if ($user) {
                $arrayItem = [
                    "id" => $id,
                    "name" => $user->name,
                ];

                $arrayAssoc[] = $arrayItem;
            }
        }

        $request['presence_recipients'] = $arrayAssoc;

        Result::create($request->all());

        return redirect()->route('dataSurat.home')->with('success', 'Berhasil Menambah Data');
    }

    public function show($id)
    {
        $result = Result::where('letter_id', $id)->first();
        $user = User::where('role', 'guru')->get();
        $surat = Letter::find($id);

        return view('result.result', compact('surat', 'user', 'result'));
    }
}
