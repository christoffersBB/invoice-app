<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceSent;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function index()
    {
        // Only show invoices for the current user's clients
        $userClientIds = Client::where('user_id', Auth::id())->pluck('id');
        return view('invoices/index', [
            'invoices' => Invoice::whereIn('client_id', $userClientIds)->get(),
        ]);
    }

    public function create()
    {
        $latestInvoice = Invoice::orderBy('invoice_number', 'desc')->first();
        $nextInvoiceNumber = $latestInvoice
            ? 'INV-' . str_pad(intval(substr($latestInvoice->invoice_number, 4)) + 1, 4, '0', STR_PAD_LEFT)
            : 'INV-0001';

        return view('invoices/create-invoice', [
            'next_invoice_number' => $nextInvoiceNumber,
            'clients' => Client::all(['id', 'name'])->toArray(),
            'projects' => Project::all(['id', 'name', 'rate', 'total_hours', 'client_id'])->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'client_id' => 'required|exists:clients,id',
            'project_id' => 'required|exists:projects,id',
            'total_hours' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Paid,Overdue',
        ]);

        $invoice = Invoice::create([
            'invoice_number' => $validated['invoice_number'],
            'client_id' => $validated['client_id'],
            'project_id' => $validated['project_id'],
            'amount' => $validated['amount'],
            'status' => $validated['status'],
        ]);

        $client = Client::find($validated['client_id']);
        $project = Project::find($validated['project_id']);

        Mail::to($client->email)->send(
            new InvoiceSent(
                $invoice,
                $client->name,
                $project->name,
                $validated['total_hours'],
                $validated['amount'],
                $project->rate // Pass the rate
            )
        );
        return redirect('/invoices')->with('success', 'Invoice created and sent successfully.');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices/show', [
            'invoice' => $invoice,
        ]);
    }
}
