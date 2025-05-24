<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            abort(403, 'Access forbidden. You must be logged in to view the dashboard.');
        }
        $userClientIds = Client::where('user_id', Auth::id())->pluck('id');

        $total_income = Invoice::whereIn('client_id', $userClientIds)
            ->where('status', 'Paid')
            ->sum('amount');

        // Current month income from paid invoices
        $current_month_income = Invoice::whereIn('client_id', $userClientIds)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'Paid')
            ->sum('amount');

        $client_count = $userClientIds->count();
        $project_count = Project::whereIn('client_id', $userClientIds)->count();
        $outstanding_invoice_count = Invoice::whereIn('client_id', $userClientIds)
            ->whereIn('status', ['pending', 'overdue'])
            ->count();

        $jobs = Invoice::select([
                'invoices.amount as outstanding_invoice',
                'clients.name as client',
                'projects.name as project',
            ])
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('projects', 'invoices.project_id', '=', 'projects.id')
            ->whereIn('invoices.client_id', $userClientIds)
            ->orderBy('invoices.created_at', 'desc')
            ->whereIn('invoices.status', ['Pending', 'Overdue'])
            ->get()
            ->map(function ($invoice) {
                return [
                    'client' => $invoice->client,
                    'project' => $invoice->project,
                    'outstanding_invoice' => $invoice->outstanding_invoice,
                ];
            })->toArray();

        $completed_jobs = Invoice::select([
                'invoices.amount as outstanding_invoice',
                'clients.name as client',
                'projects.name as project',
            ])
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('projects', 'invoices.project_id', '=', 'projects.id')
            ->whereIn('invoices.client_id', $userClientIds)
            ->orderBy('invoices.created_at', 'desc')
            ->whereIn('invoices.status', ['Paid'])
            ->get();

        return view('dashboard', [
            'total_income' => $total_income,
            'current_month_income' => $current_month_income,
            'completed_jobs' => $completed_jobs,
            'jobs' => $jobs,
            'client_count' => $client_count,
            'project_count' => $project_count,
            'outstanding_invoice_count' => $outstanding_invoice_count,
        ]);
    }

}
