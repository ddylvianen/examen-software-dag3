<?php

namespace App\Http\Controllers\Voedselpakket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voedselpakket\UpdateVoedselpakketStatusRequest;
use App\Services\Voedselpakket\VoedselpakketRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class VoedselpakketController extends Controller
{
    public function gezinnenIndex(Request $request, VoedselpakketRepository $repo): View
    {
        $selectedEetwensId = $request->query('eetwensId');

        try {
            $eetwensen = $repo->getEetwensen();

            if ($selectedEetwensId !== null && $selectedEetwensId !== '') {
                $gezinnen = $repo->getGezinnenOverzichtByEetwens((int) $selectedEetwensId);
            } else {
                $gezinnen = $repo->getGezinnenOverzicht();
            }
        } catch (\Throwable $e) {
            return view('voedselpakket.gezinnen.index', [
                'eetwensen' => [],
                'gezinnen' => [],
                'selectedEetwensId' => $selectedEetwensId,
                'showEmptyMessage' => false,
                'errorMessage' => 'Er is iets misgegaan bij het ophalen van de gezinnen.',
            ]);
        }

        $showEmptyMessage = ($selectedEetwensId !== null && $selectedEetwensId !== '') && count($gezinnen) === 0;

        return view('voedselpakket.gezinnen.index', [
            'eetwensen' => $eetwensen,
            'gezinnen' => $gezinnen,
            'selectedEetwensId' => $selectedEetwensId,
            'showEmptyMessage' => $showEmptyMessage,
            'errorMessage' => null,
        ]);
    }

    public function pakkettenIndex(int $gezinId, VoedselpakketRepository $repo): View
    {
        try {
            $gezin = $repo->getGezinDetail($gezinId);
            if (! $gezin) {
                abort(404);
            }

            $pakketten = $repo->getPakkettenPerGezin($gezinId);
        } catch (\Throwable $e) {
            if ($e instanceof HttpExceptionInterface) {
                throw $e;
            }
            return view('voedselpakket.pakketten.index', [
                'gezin' => null,
                'pakketten' => [],
                'errorMessage' => 'Er is iets misgegaan bij het ophalen van de voedselpakketten.',
            ]);
        }

        return view('voedselpakket.pakketten.index', [
            'gezin' => $gezin,
            'pakketten' => $pakketten,
            'errorMessage' => null,
        ]);
    }

    public function edit(int $voedselpakketId, VoedselpakketRepository $repo): View
    {
        try {
            $voedselpakket = $repo->getVoedselpakketForEdit($voedselpakketId);
            if (! $voedselpakket) {
                abort(404);
            }
        } catch (\Throwable $e) {
            if ($e instanceof HttpExceptionInterface) {
                throw $e;
            }
            return view('voedselpakket.pakketten.edit', [
                'voedselpakket' => null,
                'isLocked' => false,
                'backUrl' => route('voedselpakketten.gezinnen.index'),
                'successMessage' => null,
                'errorMessage' => 'Er is iets misgegaan bij het ophalen van het voedselpakket.',
            ]);
        }

        $isLocked = ($voedselpakket->Status === 'NietMeerIngeschreven');

        $successMessage = session('success');
        $errorMessage = session('error');

        if ($isLocked) {
            $errorMessage = 'Dit gezin is niet meer ingeschreven bij de voedselbank en daarom kan er geen voedselpakket worden uitgereikt';
        }

        $backUrl = route('voedselpakketten.gezinnen.pakketten.index', ['gezinId' => $voedselpakket->GezinId]);

        return view('voedselpakket.pakketten.edit', [
            'voedselpakket' => $voedselpakket,
            'isLocked' => $isLocked,
            'backUrl' => $backUrl,
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage,
        ]);
    }

    public function update(UpdateVoedselpakketStatusRequest $request, int $voedselpakketId, VoedselpakketRepository $repo): RedirectResponse
    {
        $status = $request->validated()['status'];

        try {
            $result = $repo->updateStatus($voedselpakketId, $status);
            $gezinId = $result->GezinId ?? null;

            if (! $result || (int) ($result->ResultCode ?? 0) !== 1) {
                return redirect()
                    ->route('voedselpakketten.pakketten.edit', ['voedselpakketId' => $voedselpakketId])
                    ->with('error', $result->Message ?? 'Er is iets misgegaan bij het wijzigen van de status.');
            }

            // Wireframe-05: show success then redirect after 3 seconds (handled in view)
            return redirect()
                ->route('voedselpakketten.pakketten.edit', ['voedselpakketId' => $voedselpakketId])
                ->with('success', $result->Message ?? 'De wijziging is doorgevoerd')
                ->with('redirectTo', $gezinId
                    ? route('voedselpakketten.gezinnen.pakketten.index', ['gezinId' => $gezinId])
                    : route('voedselpakketten.gezinnen.index'));
        } catch (\Throwable $e) {
            return redirect()
                ->route('voedselpakketten.pakketten.edit', ['voedselpakketId' => $voedselpakketId])
                ->with('error', 'Er is iets misgegaan bij het wijzigen van de status.');
        }
    }
}

