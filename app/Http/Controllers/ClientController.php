<?php


namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    public const DEFAULT_AVATAR = 'default-avatar.png';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);

        return response()->view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('clients.create');
    }

    /**
     * Store client.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:50',
            'lastName'  => 'required|max:50',
            'email'     => 'required|email',
        ]);

        if (!$client = Client::find($request->post('id', 0))) {
            $client         = new Client();
            $client->avatar = asset('/storage/avatars/' . self::DEFAULT_AVATAR);
        }

        $client->first_name = $request->post('firstName');
        $client->last_name  = $request->post('lastName');
        $client->email      = $request->post('email');

        $client->save();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = 'avatar_' . $client->id . '.' . $avatar->getClientOriginalExtension();

            if($avatar->storeAs('/public/avatars/', $avatarName)) {
                $client->avatar = $avatarName;
                $client->save();
            }
        }

        return response()->redirectTo(@route('clients.edit', $client->id));
    }

    /**
     * Display client's info.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing client's info.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$client = Client::find($id)) {
            return response()->view(
                'layouts.error',
                ['error' => 'Client not found!']);
        }

        $client               = $client->toArray();
        $client['has_avatar'] = $client['avatar'] === self::DEFAULT_AVATAR;
        $client['avatar']     = asset('storage/avatars/' . $client['avatar']);

        return response()->view(
            'clients.edit',
            ['client' => $client]);
    }

    /**
     * Update client.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {}

    /**
     * Remove client.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove client's avatar.
     *
     * @param int $id
     */
    public function removeAvatar($id)
    {
        if ($client = Client::find($id)) {
            $client->avatar = self::DEFAULT_AVATAR;
            $client->save();
        }
    }
}
