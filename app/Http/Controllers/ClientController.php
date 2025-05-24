<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    public function index(){
        $clients = Client::with('projects')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($client) {
                return [
                    'id' => $client->id,
                    'name' => $client->name,
                    'projects' => $client->projects->pluck('name')->toArray(),
                ];
            })->toArray();

        return view('clients/index', [
            'clients' => $clients,
        ]);
    }

    public function create(){
        return view('clients/create-client');
    }

    public function store(){
        if(Auth::guest()){
            return redirect('/login')->with('error', 'You must be logged in to create a client.');
        }
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        Client::create($validated);

        return redirect('/clients')->with('success', 'Client created successfully.');
    }

    public function show(Client $client){
        if($client->user->isNot(Auth::user())){
            abort(403);
        }
        $client = $client->load(['projects', 'invoices']);
        return view('clients/show', [
            'client' => [
                'id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
                'address' => $client->address,
                'projects' => $client->projects->map(function ($project) {
                    return [
                        'name' => $project->name,
                        'project_id' => $project->project_id,
                        'description' => $project->description,
                        'rate' => $project->rate,
                        'total_hours' => $project->total_hours,
                    ];
                })->toArray(),
                'invoices' => $client->invoices->map(function ($invoice) {
                    return [
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->amount,
                        'status' => $invoice->status,
                        'project_name' => $invoice->project ? $invoice->project->name : 'N/A',
                    ];
                })->toArray(),
            ],
        ]);

    }
    public function edit(Client $client){
        return view('clients/edit', [
            'client' => $client,
        ]);
    }
    public function update(Client $client){
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $client->update($validated);

        return redirect('/clients/' . $client->id)->with('success', 'Client updated successfully.');
    }
    public function destroy(Client $client){
        $client->delete();
        return redirect('/clients')->with('success', 'Client deleted successfully.');
    }
}
