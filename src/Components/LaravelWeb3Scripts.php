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
        this.alertUserIfMetamaskIsNotInstalled = true;
        this.contracts = @json(config('web3.contracts'));
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
            const web3Modal = this.prepareWeb3Modal();
            const provider = await web3Modal.connect();
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
            provider.on("connect", ( { chainId }) => {
                console.log("connect", chainId);
            });

            provider.on("disconnect", ( { code, message }) => {
                console.log("disconnect", code, message);
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
            "X-CSRF-Token": "{{ csrf_token() }}",
        },
    })).json()).message;
    await fetch("/_web3/users",{
        method:'post',
      body: JSON.stringify({
            signature: await provider.getSigner().signMessage(message),
            address: await provider.getSigner().getAddress(),
      }),
      headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": "{{ csrf_token() }}",
        },
    })
        this._provider = provider;
    }

    async onDisconnect() {
        this._provider = null;
        const web3Modal = this.prepareWeb3Modal();
         await web3Modal.clearCachedProvider();
        await fetch("/_web3/users/logout",{
        method: "delete",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
        });
        if (this.reloadAfterFetching) window.location.reload();
    }

    async getProvider() {
        if (!this._provider) {
            const web3Modal = this.prepareWeb3Modal();
            const web3Provider = await web3Modal.connect();
            this._provider = new ethers.providers.Web3Provider(web3Provider);
        }
        return this._provider;
    }

     prepareWeb3Modal () {
        let Web3Modal, WalletConnectProvider;
        if (!(window.web3 || window.ethereum) && this.alertUserIfMetamaskIsNotInstalled) {
            alert(`Please install Metamask first`);
            return;
        }
        if (window.Web3Modal.default) {
                Web3Modal = window.Web3Modal.default;
        }
        if (window.WalletConnectProvider) {
                WalletConnectProvider = window.WalletConnectProvider.default;
        }
        const web3Modal = new Web3Modal(this.web3ModalOptions);
        return web3Modal;
    }

    addContract(address,contract) {
        this.contracts = [...this.contracts, { address, contract }];
    }
}

window.laravelWeb3 = new LaravelWeb3();
</script>
blade;
    }
}
