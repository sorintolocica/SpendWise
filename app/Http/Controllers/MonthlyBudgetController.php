<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyBudget;
use App\Models\User;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class MonthlyBudgetController extends Controller {

    // Metoda pentru afișarea tuturor limitelor bugetare lunare
    public function index() {
        $user_id = auth()->user()->id;
        $today = Carbon::now();
        $start = $today->startOfMonth()->format('Y-m-d');
        $end = $today->endOfMonth()->format('Y-m-d');
        $user = User::withSum([
            'expenses' => function ($query) use ($start, $end) {
                $query->whereBetween('date', [$start, $end]);
            }
        ], 'Amount')
            ->withSum('monthlyBudget', 'Amount')
            ->find($user_id);

        $monthlyExpenses = Expense::selectRaw('SUM(expenses.Amount) as total_spent,  expense_categories.Name as category, monthly_budgets.Amount as budget')
            ->leftJoin('expense_categories', 'expense_categories.id', '=', 'expenses.category_id')
            ->leftJoin('monthly_budgets', 'monthly_budgets.category_id', '=', 'expenses.category_id')
            ->where('expenses.user_id', $user_id)
            ->whereBetween('date', [$start, $end])
            ->groupBy('expenses.category_id')
            ->get();


        return view('pages.monthly.index', compact('user', 'monthlyExpenses'));
    }

    // Metoda pentru afișarea formularului de creare a unei noi limite bugetare lunare
    public function create() {
        $user = auth()->user();
        $categories = $user->categories;

        return view('pages.monthly.create', compact(
            'categories'));
    }

    // Metoda pentru salvarea noii limite bugetare lunare în baza de date
    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'Amount' => 'required|numeric',
        ]);

        $category_id = $request->input('category_id');
        $user_id = auth()->user()->id;
        $budget = MonthlyBudget::where('user_id', $user_id)
            ->where('category_id', $category_id)
            ->first();
        if(!$budget) {
            $budget = new MonthlyBudget();
            $budget->user_id = $user_id;
            $budget->category_id = $category_id;
        }

        $budget->Amount = $request->input('Amount');
        $budget->save();

        session()->flash('success', 'Bugetul lunar a fost creat cu succes.');

        return redirect()->route('pages.monthly.create');
    }

    // Metoda pentru afișarea unei limite bugetare lunare specifice pentru editare
    public function edit(MonthlyBudget $monthlyBudget) {
        abort_if($monthlyBudget->user_id !== auth()->user()->id, Response::HTTP_UNAUTHORIZED);

        return view('monthly_budgets.edit', compact('monthlyBudget'));
    }

    // Metoda pentru actualizarea limitei bugetare lunare în baza de date
    public function update(Request $request, MonthlyBudget $monthlyBudget) {
        abort_if($monthlyBudget->user_id !== auth()->user()->id, Response::HTTP_UNAUTHORIZED);

        $request->validate([
            'monthly_limit' => 'required|numeric',
        ]);

        $monthlyBudget->update($request->all());
        session()->flash('success', 'Monthly budget updated successfully.');

        return redirect()->route('monthly_budgets.index');
    }

    // Metoda pentru ștergerea unei limite bugetare lunare
    public function destroy(MonthlyBudget $monthlyBudget) {
        abort_if($monthlyBudget->user_id !== auth()->user()->id, Response::HTTP_UNAUTHORIZED);

        $monthlyBudget->delete();
        session()->flash('success', 'Monthly budget deleted successfully.');

        return redirect()->route('monthly_budgets.index');
    }

}
