<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\User;
use App\Models\Expense;
class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $categories = $user->categories;
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $user = auth()->user();
        $categories = $user->categories;
        return view('pages.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
        ]);

        $validatedData = array_merge(['user_id' => auth()->user()->id], $validatedData);
        ExpenseCategory::create($validatedData);

        return redirect()->route('pages.category.store')->with('success', 'Categoria a fost creata cu succes.');
    }

    public function edit(ExpenseCategory $category)
    {
        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, ExpenseCategory $category)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('pages.category.edit', ['category' => $category])->with('success', 'Categoria a fost actualizată.');
    }
    public function destroy(ExpenseCategory $category)
    {
        // Verifică dacă există înregistrări în tabela 'expenses' care fac referire la categoria $category
        if ($category->expenses->count() > 0) {
            session()->flash('error', 'Nu poți șterge această categorie deoarece are înregistrări asociate în tabela "expenses".');
            return redirect()->back();
        }

        $category->delete();

        session()->flash('success', 'Categoria a fost ștearsă cu succes.');
        return redirect()->route('pages.category.create');
    }
}
