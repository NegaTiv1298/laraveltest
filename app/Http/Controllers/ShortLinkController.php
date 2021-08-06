<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinksRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ShortLinkController extends Controller
{
    /**
     * Default lifetime of link
     */
    private const DEFAULT_TIME = 86400;

    /**
     * Show view 'page' and information from the table 'short_link'
     *
     * @return Application|Factory|View
     */
    public function show()
    {

        return view('page', [
            'shortLinks' => DB::table('short_link')->latest()->get()
        ]);
    }

    /**
     * Operations with times, link token and adding to the database
     *
     * @param LinksRequest $request
     * @return RedirectResponse
     */
    public function save(LinksRequest $request): RedirectResponse
    {
        date_default_timezone_set('Europe/Kiev');
        $urlRequest = $request->input('link');
        $limitRequest = $request->input('limit');
        $timeRequest = $request->input('time_to_die');

        if (!empty($timeRequest)) {
            $timestampRequest = ((int)$timeRequest * 60 * 60);
        } else $timestampRequest = self::DEFAULT_TIME;

        $generatedTime = date('Y-m-d-H-i-s', ($timestampRequest + time()));
        $generatedToken = str_shuffle(Str::upper(Str::random(3)) . Str::lower(Str::random(3)) . mt_rand(10, 99));

        DB::table('short_link')->insert([
            'request_link' => $urlRequest,
            'token_link' => $generatedToken,
            'attendance_limit' => $limitRequest,
            'time_to_die' => $generatedTime,
        ]);

        return redirect()->route('short.link');
    }

    /**
     * Validate short link and redirect to the request page or 404 page
     *
     * @param $token
     * @return Application|Factory|RedirectResponse|View
     */
    public function redirect($token)
    {
        $link = DB::table('short_link')
            ->where('token_link', $token)->first();
        $currentTime = date('Y-m-d-H-i-s', (time()));
        if (($link->attendance_limit === 0 || $link->count_limit < $link->attendance_limit) && $currentTime < $link->time_to_die) {
            DB::table('short_link')
                ->where('token_link', $token)->increment('count_limit', 1);

            return redirect($link->request_link);
        }

        return view('error404');
    }
}
