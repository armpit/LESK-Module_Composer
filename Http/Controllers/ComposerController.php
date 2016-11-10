<?php
namespace App\Modules\Composer\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuditRepository as Audit;
use Auth;

class ComposerController extends Controller
{
    public function index()
    {
        $var = 'SomeVar';
        Audit::log(Auth::user()->id, trans('composer::general.audit-log.category'), trans('composer::general.audit-log.msg-index', ['var' => $var]));

        $page_title = trans('composer::general.page.index.title');
        $page_description = trans('composer::general.page.index.description');

        $data = self::readComposer();
        $data = self::idPackages($data);

        return view('composer::index', compact('page_title', 'page_description', 'data'));
    }

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

    private static function readComposer()
    {
        $path = realpath(dirname(__FILE__));
        $file = $path.'/../../../../../composer.lock';
        $json = file_get_contents($file);
        return json_decode($json, true);
    }

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
