<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use App\Models\Resume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Traits\Searchable;

class PositionController extends Controller
{
    use Searchable;

    private $limit;

    public function __construct()
    {
        $this->limit = config('common.limitPagination');
    }

    public function index(Request $request): JsonResponse {
        $total = Position::count() / $this->limit;

        return response()->json([
            'total' => $total,
            'positions' => Position::take($this->limit)->skip($this->skip($request))->get(),
        ]);
    }

    public function save(Request $request): void
    {
        $position = Position::updateOrCreate([
            'id' => $request->id,
        ], [
            'title' => $request->title,
            'description' => $request->description,
        ]);
    }

    private function skip(Request $request): int {
        if ($request->page) {
            $skip = $request->page === 1 ? 0 : ($this->limit * $request->page) - $this->limit;
        }

        return $skip ?? 0;
    }

    public function searchPosition(Request $request): JsonResponse {
        $columns = ['title', 'description'];
        $model = 'App\Models\Position';

        $total = $this->fullSearch($request->search, $columns, $model)->count() / $this->limit;

        $positions = $this
            ->fullSearch($request->search, $columns, $model)
            ->skip($this->skip($request))
            ->take($this->limit)->get();

        return response()->json([
            "positions" => $positions,
            "total" => $total,
        ]);
    }
}
