<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;
use App\Models\MonthlyBudget;
use Symfony\Component\HttpFoundation\Response;

class ExpenseController extends Controller {

    public function index() {
        $user = auth()->user();
        $expenses = $user->expenses;
        $rewards = $user->rewards;
        $categories = ExpenseCategory::all();

        return view('pages.home', compact('expenses', 'categories', 'rewards'));
    }

    public function create() {
        $user = auth()->user();
        $categories = $user->categories;

        return view('pages.expense.create', compact('categories'));
    }

    public function store(Request $request) {
        // Validează datele din request
        $validatedData = $request->validate([
            'category_id' => 'required',
            'Amount' => 'required|numeric',
            'Date' => 'required',
            'Description' => 'required',
        ]);

        $validatedData = array_merge(['user_id' => auth()->user()->id], $validatedData);

        Expense::create($validatedData);

        return redirect()->route('pages.expense.create')->with('success', 'Cheltuiala a fost adaugata!');
    }

    public function edit(Expense $expense) {

        abort_if($expense->user_id !== auth()->user()->id, Response::HTTP_UNAUTHORIZED);

        $categories = ExpenseCategory::all();

        return view('pages.expense.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense) {
        // Valideaza datele din request
        $request->validate([
            'category_id' => 'required',
            'Amount' => 'required|numeric',
            'Date' => 'required',
            'Description' => 'required',
        ]);

        $expense->update([
            'category_id' => $request->category_id,
            'Amount' => $request->Amount,
            'Date' => $request->Date,
            'Description' => $request->Description,
        ]);

        return redirect()->route('pages.expense.create')->with('success', 'Cheltuiala a fost modificata!');
    }

    public function destroy(Expense $expense) {
        abort_if($expense->user_id !== auth()->user()->id, Response::HTTP_UNAUTHORIZED);

        $expense->delete();

        session()->flash('success', 'Cheltuiala a fost stearsa!');

        return redirect()->route('pages.index');
    }

}
