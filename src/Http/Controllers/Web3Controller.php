<?php

namespace Sawirricardo\LaravelWeb3\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

class Web3Controller
{
    public function store()
    {
        $data = request()->validate([
      'address' => ['required', 'string', 'regex:/0x[a-fA-F0-9]{40}/m'],
      'signature' => ['required', 'string', 'regex:/^0x([A-Fa-f0-9]{130})$/'],
    ]);

        $user = $this->getUserModel()->firstOrCreate([
      'account' => $data['address'],
    ]);
    }

    public function update()
    {
        request()->validate([
      'address' => ['required', 'string', 'regex:/0x[a-fA-F0-9]{40}/m'],
    ]);
    }

    protected function getUserModel(): Model
    {
        return app(config('auth.providers.users.model'));
    }
}
