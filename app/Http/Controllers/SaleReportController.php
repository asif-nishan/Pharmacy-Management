<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Sale;
use App\SaleInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    public function monthly()
    {
        $validatedData = request()->validate([
            'year' => 'nullable',
            'month' => 'nullable'
        ]);
        if (isset($validatedData['year']) && isset($validatedData['month'])) {
            $date = Carbon::createFromDate($validatedData['year'], $validatedData['month'], 1);
            $dateImmutable = Carbon::createFromDate($validatedData['year'], $validatedData['month'], 1)->toImmutable();
        } else {
            $date = Carbon::now()->firstOfMonth();
            $dateImmutable = Carbon::now()->firstOfMonth()->toImmutable();
        }
        $days_in_month = $date->daysInMonth;
        $sale_profit_by_month = [];
        $total_profit = 0;
        $total_sale = 0;
        for ($i = 1; $i <= $days_in_month; $i++) {
            $sale_profit["date"] = $date->format('d-m-Y');
            $sale_profit["profit"] = SaleInvoice::getTodayProfit($date->startOfDay());
            $sale_profit["sale"] = SaleInvoice::getTodaySales($date->startOfDay());
            $sale_profit_by_month[] = $sale_profit;
            $total_profit += $sale_profit["profit"];
            $total_sale += $sale_profit["sale"];
            $date->addDay();
        }

        return view('sale_reports.monthly', [
            'date' => Carbon::now()->firstOfMonth(),
            'days_in_month' => $days_in_month,
            'currentMonth' => $dateImmutable,
            'nextMonth' => $dateImmutable->addMonth()->format('m-Y'),
            'prevMonth' => $dateImmutable->subMonth()->format('m-Y'),
            'grand_total' => $total_profit,
            'total_sale' => $total_sale,
            'sale_profit_by_month' => $sale_profit_by_month,
        ]);
    }

    public function daily()
    {
        $validatedData = request()->validate([
            'date' => 'date'
        ]);
        $date = isset($validatedData['date']) ? Carbon::createFromFormat('d-m-Y', $validatedData['date'])->toImmutable() : Carbon::now()->toImmutable();
        $nextDay = $date->addDay()->format('d-m-Y');
        $prevDay = $date->subDay()->format('d-m-Y');
        $saleInvoices = SaleInvoice::whereDate('selling_date', $date)->get();

        return view('sale_reports.daily', [
            'saleInvoices' => $saleInvoices,
            'currentDay' => $date,
            'nextDay' => $nextDay,
            'prevDay' => $prevDay,
        ]);
    }

    public function weekly()
    {

    }

}
