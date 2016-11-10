<?php
/**
 * Copyright (c) 2016, armpit <armpit@rumpigs.net>
 *
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 */
namespace App\Modules\Composer\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuditRepository as Audit;
use Auth;

class ComposerController extends Controller
{

    /**
     * Show a list of all packages.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page_title = trans('composer::general.page.index.title');
        $page_description = trans('composer::general.page.index.description');

        $data = self::readComposer();
        $data = self::idPackages($data);

        return view('composer::index', compact('page_title', 'page_description', 'data'));
    }


    /**
     * Show information for the given package.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function show($id)
    {
        $data = self::readComposer();
        $data = self::idPackages($data);
        $packages = array_merge($data['packages'], $data['packages-dev']);

        foreach($packages as $package) {
            if ($package['pkg_id'] == $id) {
                $data = $package;
            }
        }

        // fix anything empty
        if (!isset($data['authors']))
            $data['authors'] = array();
        if (!isset($data['keywords']))
            $data['keywords'] = array();
        if (!isset($data['license']))
            $data['license'] = array();
        if (!isset($data['require']))
            $data['require'] = array();
        if (!isset($data['require-dev']))
            $data['require-dev'] = array();
        if (!isset($data['autoload']))
            $data['autoload'] = array();

        $page_title = trans('composer::general.page.show.title');
        $page_description = trans('composer::general.page.show.description');
        return view('composer::show', compact('page_title', 'page_description', 'data'));
    }


    /**
     * Read the composer.lock file.
     * @return array
     */
    private static function readComposer()
    {
        $path = realpath(dirname(__FILE__));
        $file = $path.'/../../../../../composer.lock';
        $json = file_get_contents($file);
        return json_decode($json, true);
    }


    /**
     * Give each package an id number so we can link to them.
     * @param array $data
     * @return array
     */
    private static function idPackages($data)
    {
        $x = 0;
        foreach($data['packages'] as $package) {
            $data['packages'][$x]['pkg_id'] = $x;
            $x++;
        }
        $y = 0;
        foreach($data['packages-dev'] as $package) {
            $data['packages-dev'][$y]['pkg_id'] = $x;
            $y++;
            $x++;
        }
        return $data;
    }

}
