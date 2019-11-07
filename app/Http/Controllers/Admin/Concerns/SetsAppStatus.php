<?php

namespace App\Http\Controllers\Admin\Concerns;

trait SetsAppStatus
{
    /**
     * Turn on maintenance mode.
     */
    public function down()
    {
        @touch(storage_path('down'));
    }

    /**
     * Turn off maintenance mode.
     */
    public function up()
    {
        @unlink(storage_path('down'));
    }
}
