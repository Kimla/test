<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Carbon\Carbon;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'authed' => function () {
                return \Auth::user();
            },

            'banner' => $this->createBanner($request),

            'translations' => function () {
                return translations();
            },

            'jetstream' => null,
        ]);
    }

    public function createBanner(Request $request)
    {
        if (!empty($request->session()->get('errors'))) {
            return [
                'style' => 'danger',
                'message' => __('One or more fields are not filled in correctly, please try again.'),
                'id' => time()
            ];
        }

        if (empty($request->session()->get('flash.banner'))) {
            return;
        }

        $banner = $request->session()->get('flash.banner');

        if (!is_array($banner)) {
            $banner = [
                'message' => $banner
            ];
        }

        $banner['id'] = time();
        
        return $banner;
    }
}
