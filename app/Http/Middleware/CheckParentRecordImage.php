<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorException;
use App\Models\Image;
use Closure;
use Illuminate\Http\Request;

class CheckParentRecordImage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $stories = Image::all()->find($request->input('image_id'));
        if (!$stories)
            throw ErrorException::notFound('Image not found');
        return $next($request);

    }
}
