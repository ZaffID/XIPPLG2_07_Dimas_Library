<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    { 
        $loans = Loan::all(); 
        return response()->json([
            'status' => 200,
            'message' => 'Loans retrieved successfully.',
            'data' => $loans
        ], 200);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'book_id' => 'required|integer|exists:books,id', 
            'user_id' => 'required|integer|exists:users,id', 
            'loan_date' => 'required|date', 
            'return_date' => 'nullable|date|after_or_equal:loan_date', 
            'status' => 'required|string|max:255' 
        ]);

        $loan = Loan::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Loan created successfully.',
            'data' => $loan
        ], 200);
    }

    public function show($id)
    { 
        $loan = Loan::find($id); 

        if (!$loan) { 
            return response()->json([
                'status' => 404, 
                'message' => 'Loan not found.', 
                'data' => null 
            ], 404); 
        } 

        return response()->json([
            'status' => 200, 
            'message' => 'Loan retrieved successfully.', 
            'data' => $loan 
        ], 200); 
    }

    public function update(Request $request, $id)
    { 
        $loan = Loan::find($id); 

        if (!$loan) { 
            return response()->json([
                'status' => 404, 
                'message' => 'Loan not found.', 
                'data' => null 
            ], 404); 
        } 

        $request->validate([ 
            'book_id' => 'sometimes|integer|exists:books,id', 
            'user_id' => 'sometimes|integer|exists:users,id', 
            'loan_date' => 'sometimes|date', 
            'return_date' => 'nullable|date|after_or_equal:loan_date', 
            'status' => 'sometimes|string|max:255' 
        ]); 

        $loan->update($request->all()); 

        return response()->json([
            'status' => 200, 
            'message' => 'Loan updated successfully.', 
            'data' => $loan 
        ], 200); 
    }

    public function destroy($id)
    { 
        $loan = Loan::find($id); 

        if (!$loan) { 
            return response()->json([ 
                'status' => 404, 
                'message' => 'Loan not found.', 
                'data' => null 
            ], 404); 
        } 

        $loan->delete(); 

        return response()->json([ 
            'status' => 200, 
            'message' => 'Loan deleted successfully.', 
            'data' => null 
        ], 200); 
    }
}