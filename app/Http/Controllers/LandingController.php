<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\LayananRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __construct(private LayananRepositoryInterface $layananRepository) {}

    public function index(): View
    {
        return view('beranda.landing', [
            'layanans' => Schema::hasTable('ms_layanan')
                ? $this->layananRepository->getActive()
                : collect(),
        ]);
    }
}
