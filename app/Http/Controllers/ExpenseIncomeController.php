<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ExpenseIncomeCollection;
use App\Http\Fetch\ExpenseIncomeFetch;

use App\Models\ExpenseIncome;
use App\Models\User;

class ExpenseIncomeController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(ExpenseIncomeFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\ExpenseIncomeMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.expense-income.index', [
            'headers' => ExpenseIncomeCollection::$headers,
            'searches' => ExpenseIncomeCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new ExpenseIncomeCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.expense-income.create', [
            'users' => User::get(),
            'expenseTypes' => collect(ExpenseIncome::getExpensesType()),
            'incomeTypes' => collect(ExpenseIncome::getIncomeType())
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = ExpenseIncome::withTrashed()->findOrFail($id);
        $users = User::get();

        $types = [
            [
                'type' => 'Income'
            ],[
                'type' => 'Expenses'
            ],
        ];

        return view('pages.expense-income.show', [
            'item' => $item,
            'users' => $users,
            'types' => collect($types),
            'expenseTypes' => collect(ExpenseIncome::getExpensesType()),
            'incomeTypes' => collect(ExpenseIncome::getIncomeType())
        ]);
    }

}
