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
namespace App\Modules\Composer\Utils;

use DB;
use Sroutier\LESKModules\Contracts\ModuleMaintenanceInterface;
use Sroutier\LESKModules\Traits\MaintenanceTrait;

class ComposerMaintenance implements ModuleMaintenanceInterface
{
    use MaintenanceTrait;

    static public function initialize()
    {
        DB::transaction(function () {
            self::migrate('composer');
            self::seed('composer');

            $permUseComposer = self::createPermission(  'use-composer',
                'Use Composer',
                'Allows a user to use the Composer module.');


            $routeHome = self::createRoute( 'composer.home',
                'composer',
                'App\Modules\Composer\Http\Controllers\ComposerController@home',
                $permUseComposer );
            self::createRoute( 'composer.show',
                'composer/show/{dn}',
                'App\Modules\Composer\Http\Controllers\ComposerController@show',
                $permUseComposer );

            // Create a role for the module
            self::createRole( 'composer-users',
                'Composer Users',
                'Users of the Composer module.',
                [$permUseComposer->id] );

            // Create menu system for the module
            $menuToolsContainer = self::createMenu( 'tools-container', 'Tools', 10, 'fa fa-folder', 'home', true );
            self::createMenu( 'composer.home', 'Composer', 0, 'fa fa-file', $menuToolsContainer, false, $routeHome );
        }); // End of DB::transaction(....)
    }


    static public function unInitialize()
    {
        DB::transaction(function () {
            self::destroyMenu('composer.home');
            self::destroyMenu('tools-container');
            self::destroyRole('composer-users');
            self::destroyRoute('composer.show');
            self::destroyRoute('composer.home');
            self::destroyPermission('use-composer');
        }); // End of DB::transaction(....)
    }


    static public function enable()
    {
        DB::transaction(function () {
            self::enableMenu('composer.home');
        });
    }


    static public function disable()
    {
        DB::transaction(function () {
            self::disableMenu('composer.home');
        });
    }

}
