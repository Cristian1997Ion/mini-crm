<?php


namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Displays a lists of all clients **/
    public function index()
    {
        $clients = Client::paginate(1);

        return view(
            'clients.index',
            ['clients' => $clients],
        );
    }
}
