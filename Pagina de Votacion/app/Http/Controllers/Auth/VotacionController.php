<?php

namespace App\Http\Controllers\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;



class VotacionController extends Controller
{
    public function create()
    {
        return view('admin.votacion'); // Cargamos la vista de votación
    }
}
