<?php

namespace App\Http\Controllers;

use App\Helpers\TermHelper;
use App\Models\PeopleCertificate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class CertificatesSearchController extends Controller
{
    public function execute(string $term): JsonResponse
    {
        try {
            $term = TermHelper::prepare($term);
            Log::info($term);
        } catch (InvalidArgumentException $e) {
            Log::warning('Invalid term used in search: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }

        $items = PeopleCertificate::with(['person', 'edition'])
            ->where(function ($query) use ($term) {
                $query->where('code', $term)
                    ->orWhereHas('person', fn($q) => $q->where('email', $term));
            })
            ->whereNull('removed_at')
            ->orderByDesc('edition_id')
            ->orderBy('name')
            ->get();

        if ($items->isEmpty()) {
            return response()->json([], 404);
        }

        $list = $items->map(function ($item) {
            $enjoyedAs = null;

            if (!is_null($item->organizer_id)) {
                $enjoyedAs = 'Organizer';
            } elseif (!is_null($item->collaborator_id)) {
                $enjoyedAs = 'Collaborator';
            } elseif (!is_null($item->talk_id)) {
                $enjoyedAs = 'Speaker';
            } elseif (!is_null($item->participant_id)) {
                $enjoyedAs = 'Participant';
            }

            $unit = null;
            if (!empty($item->edition->options) && is_object($item->edition->options)) {
                $unit = $item->edition->options->unit ?? null;
            }

            return [
                'edition' => $item->edition->year,
                'unit' => $unit,
                'name' => $item->name,
                'enjoyedAs' => $enjoyedAs,
                'code' => $item->code,
            ];
        });

        return response()->json($list);
    }
}
