<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreOfflineTransactionRequest;
use App\Repositories\Contracts\LayananRepositoryInterface;
use App\Services\Contracts\OfflineTransactionServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function __construct(
        private LayananRepositoryInterface $layananRepository,
        private OfflineTransactionServiceInterface $offlineTransactionService,
    ) {}

    /**
     * Show offline transaction form
     */
    public function createOffline(): View
    {
        $layanans = $this->layananRepository->getActive();
        return view('admin.transaksi.offline', compact('layanans'));
    }

    /**
     * Store offline transaction
     */
    public function storeOffline(StoreOfflineTransactionRequest $request): RedirectResponse
    {
        try {
            $result = $this->offlineTransactionService->create(auth()->id(), $request->validated());

            if (! $result['success']) {
                return back()->with('error', $result['message'])->withInput();
            }

            return redirect()->route('admin.antrean')->with('success', $result['message']);
        } catch (\Exception $e) {
            report($e);
            return back()->with('error', 'Gagal menyimpan transaksi.')->withInput();
        }
    }
}
