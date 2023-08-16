<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorException;
use App\Models\Text;
use Closure;
use Illuminate\Http\Request;

class CheckParentRecordText
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
        $stories = Text::all()->find($request->input('text_id'));
        if (!$stories)
            throw ErrorException::notFound('Text not found');
        return $next($request);
    }
}
