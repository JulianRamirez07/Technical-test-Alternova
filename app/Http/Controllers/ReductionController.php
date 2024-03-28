<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReductionRequest;


class ReductionController extends Controller
{
    public function reduceString(ReductionRequest $request)
    {
        $reducedString = $this->reduce($request->input('input_string'));

        return response()->json([
            'reduced_string' => $reducedString
        ], 200);
    }

    private function reduce(string $input): string
    {
        $characters = [];

        for ($i = 0; $i < strlen($input); $i++) {
            $currentChar = $input[$i];

            // Si el arreglo no está vacío y el carácter actual es igual al último carácter en la pila, elimínalo
            if (!empty($characters) && $currentChar === end($characters)) {
                array_pop($characters);
            } else {
                $characters[] = $currentChar;
            }
        }

        $result = implode('', $characters);

        return $result === '' ? 'Empty String' : $result;
    }
}
