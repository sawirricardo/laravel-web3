<?php

namespace Sawirricardo\LaravelWeb3\Components;

use Illuminate\View\Component;

class LaravelWeb3Scripts extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
<script>
class LaravelWeb3 {
    constructor() {
        this._provider = null;
        this.reloadAfterFetching = true;
        this.web3Modal = null;
        this.web3ModalOptions = {
            cacheProvider: true,
            disableInjectedProvider: false,
            providerOptions: {
                // walletconnect: {
                //     package: WalletConnectProvider,
                //     options: {
                //         infuraId: process.env.MIX_WEB3_INFURA_ID,
                //     },
                // },
            },
        };
    }

    async onConnect() {
        try {
            this.web3Modal = new Web3Modal(this.web3ModalOptions);
            const provider = await this.web3Modal.connect();
            provider.on("accountsChanged", async (accounts) => {
                console.log("accountsChanged", accounts);
                web3Modal.clearCachedProvider();
                await this.fetchAccount(provider);
                if (this.reloadAfterFetching) window.location.reload();
            });
            provider.on("chainChanged", async (chainId) => {
                console.log("chainChanged", chainId);
                web3Modal.clearCachedProvider();
                await this.fetchAccount(provider);
                if (this.reloadAfterFetching) window.location.reload();
            });
            await this.fetchAccount(provider);
            if (this.reloadAfterFetching) window.location.reload();
        } catch (e) {
            console.log({ e });
        }
    }

    async fetchAccount(web3Provider) {
        const provider = new ethers.providers.Web3Provider(web3Provider);
        const message = await(await(await fetch("/_web3/users/signature", {
        method: "get",
        headers: {
            "Content-Type": "application/json",
            "X-XSRF-Token": "{{ csrf_token() }}",
        },
    })).json()).message;
    await fetch("/_web3/users",{
      body: JSON.stringify({
            signature: await provider.getSigner().signMessage(message),
            address: await provider.getSigner().getAddress(),
      }),
      headers: {
            "Content-Type": "application/json",
            "X-XSRF-Token": "{{ csrf_token() }}",
        },
    })
        this._provider = provider;
    }

    async onDisconnect() {
        this._provider = null;
        await this.web3Modal.clearCachedProvider();
        await fetch("/_web3/users/logout",{
            headers: {
                "Content-Type": "application/json",
                "X-XSRF-Token": "{{ csrf_token() }}",
            },
        });
        if (this.reloadAfterFetching) window.location.reload();
    }

    getProvider() {
        return this._provider;
    }
}

window.LaravelWeb3 = new LaravelWeb3();
</script>
blade;
    }
}
