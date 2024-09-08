<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;

class OpController extends Controller
{
    
    public function genapGanjil(Request $request){
        $numberDetails = [];
        if ($request->has('n')) {
            $validatedData = $request->validate([
                'n' => 'required|integer|min:1',
            ]);

            $n = $validatedData['n'];
            $numberDetails = Operator::getGenapGanjil($n); //
        }
        return view('Operation.genapGanjil',compact('numberDetails'));
    }

    public function bilanganPrima(Request $request){
        $numberDetails = [];
        if ($request->has('n')) {
            $validatedData = $request->validate([
                'n' => 'required|integer|min:1',
            ]);

            $n = $validatedData['n'];
            $numberDetails = Operator::getPrima($n);
        }
        return view('Operation.prima',compact('numberDetails'));
    }

    public function fibonacci(Request $request){
        $numberDetails = [];
        if ($request->has('n')) {
            $validatedData = $request->validate([
                'n' => 'required|integer|min:1',
            ]);

            $n = $validatedData['n'];
            $numberDetails = Operator::getFibonaci($n);
        }

        return view('Operation.fibonacci',compact('numberDetails'));
    }

    public function param1($param1 = '')
    {
        $data['param1'] = $param1;
        return view('Operation.param1', compact('data'));
    }
    
    public function param2($param1 = '', $param2 = '')
    {
        $data['param1'] = $param1;
        $data['param2'] = $param2;
        return view('Operation.param2', compact('data'));
    }
}
