<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Skill;
use App\Models\Language;
Use App\Models\Resume;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ResumeRequest;
use App\Http\Requests\ResumeUpdateRequest;
use App\Services\ResumeService;

class HomeController extends Controller
{
    use Searchable;

    private $maxCount = 1000;
    private $limit;

    public function __construct()
    {
        $this->limit = config('common.limitPagination');
    }

    public function index(): JsonResponse {
        return response()->json(Position::take($this->limit)->get());
    }

    public function searchSkills(Request $request): JsonResponse {
        return response()->json(Skill::where('title', 'LIKE', "%{$request->searchedSkill}%")->take($this->maxCount)->get());
    }

    public function getLanguages(): JsonResponse {
        return response()->json(Language::all());
    }

    public function saveResume(ResumeRequest $request, ResumeService $resumeService): void {
        $resumeService->saveResume($request);
    }

    public function updateResume(ResumeUpdateRequest $request, ResumeService $resumeService): void {
        $resumeService->saveResume($request);
    }
}
