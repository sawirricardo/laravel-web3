<?php

namespace Sawirricardo\LaravelWeb3\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Web3Controller
{
    public function signature()
    {
        $nonce = Str::random();
        request()->session()->put('nonce', $nonce);

        return ['message' => $this->generateSignatureMessage($nonce)];
    }

    public function store()
    {
        $data = request()->validate([
            'address' => ['required', 'string', 'regex:/0x[a-fA-F0-9]{40}/m'],
            'signature' => ['required', 'string', 'regex:/^0x([A-Fa-f0-9]{130})$/'],
        ]);

        if ($this->verifySignature(request()->session()->pull('nonce'), $data['signature'], $data['address'])) {
            throw ValidationException::withMessages(['signature' => 'Signature verification failed.']);
        }

        $user = $this->getUserModel()::firstOrCreate([
            config('web3.model.column') => $data['address'],
        ]);

        if (! is_null(request()->user()) && request()->user()->id !== $user->id) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        Auth::login($user);

        return response()->noContent();
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response()->noContent();
    }

    protected function getUserModel(): Model
    {
        return app(config('auth.providers.users.model'));
    }

    protected function generateSignatureMessage($nonce)
    {
        $appName = config('app.name');

        return "You are logging to {$appName}. Nonce: $nonce";
    }

    protected function verifySignature($nonce, $signature, $address)
    {
        $message = $this->generateSignatureMessage($nonce);
        $msglen = strlen($message);
        $hash = \kornrunner\Keccak::hash("\x19Ethereum Signed Message:\n{$msglen}{$message}", 256);
        $sign = ["r" => substr($signature, 2, 64), "s" => substr($signature, 66, 64)];
        $recid = ord(hex2bin(substr($signature, 130, 2))) - 27;
        if ($recid != ($recid & 1)) {
            return false;
        }
        $pubkey = (new \Elliptic\EC('secp256k1'))->recoverPubKey($hash, $sign, $recid);

        return hash_equals($address, $this->pubKeyToAddress($pubkey));
    }

    protected function pubKeyToAddress($pubkey)
    {
        return "0x" . substr(\kornrunner\Keccak::hash(substr(hex2bin($pubkey->encode("hex")), 1), 256), 24);
    }
}
