<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;

class ResumeService {
    public function saveResume($request): void {
        if ($request->file('avatar')) {
            $filename = time() . $request->file('avatar')->getClientOriginalName();
            Storage::disk('public')->put($filename, file_get_contents($request->file('avatar')));
        } else {
            $filename = '';
        }

        $form = json_decode($request->form);
        $resume = Resume::updateOrCreate([
            'id' => $request->id,
        ], [
            'name' => $form->name,
            'last_name' => $form->last_name,
            'email' => $form->email,
            'about' => $form->about,
            'info' => $form->info,
            'phone' => $form->phone,
            'avatar' => asset('storage/' . $filename),
        ]);

        $portfolios = collect($form->portfolio)->map(function($item) {
            return collect($item)->except('id');
        })->toArray();

        $resume->portfolios()->delete();
        $resume->portfolios()->createMany($portfolios);

        $resume->languages()->sync($form->languages);
        $resume->save();

        $resume->skills()->sync([]);
        $skills = collect($form->skills)->except(['id']);
        foreach ($skills as $key => $value) {
            $model = Skill::firstOrCreate(['title' => $value->title]);
            $resume->skills()->attach($model->id);
        }
    }
}
