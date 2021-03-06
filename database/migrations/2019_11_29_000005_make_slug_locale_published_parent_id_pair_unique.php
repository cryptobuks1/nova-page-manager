<?php

use Exception;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use OptimistDigital\NovaPageManager\NovaPageManager;

class MakeSlugLocalePublishedParentidPairUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pagesTableName = NovaPageManager::getPagesTableName();

        try {
            Schema::table($pagesTableName, function ($table) {
                $table->dropUnique("nova_page_manager_locale_slug_published_unique");
            });
        } catch (Exception $e) {
        }

        try {
            Schema::table($pagesTableName, function ($table) {
                $table->dropUnique("nova_page_manager_pages_locale_slug_published_unique");
            });
        } catch (Exception $e) {
        }

        Schema::table($pagesTableName, function ($table) {
            $table->unique(['locale', 'slug', 'published', 'parent_id'], 'nova_page_manager_locale_slug_published_parent_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $pagesTableName = NovaPageManager::getPagesTableName();

        Schema::table($pagesTableName, function ($table) {
            $table->dropUnique('nova_page_manager_locale_slug_published_parent_id_unique');
            $table->unique(['locale', 'slug', 'published'], 'nova_page_manager_locale_slug_published_unique');
        });
    }
}
