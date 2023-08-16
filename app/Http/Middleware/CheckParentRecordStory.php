<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorException;
use App\Models\Story;
use Closure;
use Illuminate\Http\Request;

class CheckParentRecordStory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $stories = Story::all()->find($request->input('story_id'));
        if (!$stories)
            throw ErrorException::notFound('Story not found');
        return $next($request);
    }
}
