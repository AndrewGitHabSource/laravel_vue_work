<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Traits\Searchable;
use App\Models\Resume;

class ResumeController extends Controller
{
    use Searchable;

    private $limit;

    public function __construct()
    {
        $this->limit = config('common.limitPagination');
    }

    public function index(Request $request): JsonResponse {
        $total = Resume::count() / $this->limit;

        return response()->json([
            'total' => $total,
            'resumes' => Resume::take($this->limit)->skip($this->skip($request))->get(),
        ]);
    }

    public function getResume(Request $request): JsonResponse {
        return response()->json(Resume::with(['portfolios', 'languages:id', 'skills:id,title'])
            ->where('id', '=', $request->id)
            ->first()
        );
    }

    public function searchResume(Request $request): JsonResponse {
        $columns = ['name', 'last_name', 'email', 'phone', 'about', 'info'];
        $model = 'App\Models\Resume';

        $total = $this->fullSearch($request->search, $columns, $model)->count() / $this->limit;

        $resumes = $this
            ->fullSearch($request->search, $columns, $model)
            ->skip($this->skip($request))
            ->take($this->limit)->get();

        return response()->json([
            "resumes" => $resumes,
            "total" => $total,
        ]);
    }

    private function skip(Request $request): int {
        if ($request->page) {
            $skip = $request->page === 1 ? 0 : ($this->limit * $request->page) - $this->limit;
        }

        return $skip ?? 0;
    }
}
