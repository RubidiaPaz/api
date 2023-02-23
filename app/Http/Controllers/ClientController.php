<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        $data = [
            'message' => 'Clients retrieved successfully',
            'clients' => $clients
        ];

        //retornar los clients en un json para la respuesta
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // se trabaja con el post 
        $client = new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client-> save();
        $data = [
            'message' => 'Client created successfully',
            'client' => $client
        ]; 
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    { // se trabaja con un get 

        // muestra el cliente
        $data = [
            'message' => 'Client details',
            'client' => $client,
            'services' => $client->services
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //metodo put
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
        $data = [
           'message' => 'Client updated successfully',
            'client' => $client
        ]; 
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //metodo delete
        $client->delete();
        $data = [
           'message' => 'Client deleted successfully',
            'client' => $client
        ]; 
        return response()->json($data);
    }

    public function attach(Request $request){
        $client = Client::find($request->client_id);
        $client->services()->attach($request->service_id);
        $data = [
            //servicio adjunto con exito
            // attach es poner
            'message' => 'Service attached successfully',
            'client' => $client
        ];
        return response()->json($data);
    }
}
