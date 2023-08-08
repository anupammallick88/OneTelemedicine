<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CurrencyDatatable;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(CurrencyDatatable $dataTable)
    {
        return $dataTable->render('admin.currency.index');
    }

    public function create()
    {
        return view('admin.currency.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'currency_code' => 'required|unique:currencies,currency_code',
            'symbol' => 'required',
            'currency_placement' => 'required',
        ]);

        $currency = new Currency();
        $currency->currency_code = $request->currency_code;
        $currency->symbol = $request->symbol;
        $currency->currency_placement = $request->currency_placement;
        $currency->save();

        session()->flash('success', __('Currency Created Successfully'));
        Toastr::success('success', __('Currency Created Successfully'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('currency.index');
    }

    public function edit($id)
    {
        $data['currency'] = Currency::findOrFail($id);
        return view('admin.currency.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'currency_code' => 'required|unique:currencies,currency_code,' . $id,
            'symbol' => 'required',
            'currency_placement' => 'required',
        ]);

        $currency = Currency::findOrfail($id);
        $currency->currency_code = $request->currency_code;
        $currency->symbol = $request->symbol;
        $currency->currency_placement = $request->currency_placement;
        $currency->save();

        session()->flash('success', __('Currency Updated Successfully'));
        Toastr::success('success', __('Currency Updated Successfully'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('currency.index');
    }

    public function delete($id)
    {
        $item = Currency::findOrFail($id);
        $item->delete();
        session()->flash('success', __('Currency Deleted Successfully'));
        Toastr::success('success', __('Currency Deleted Successfully'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('currency.index');
    }
}
