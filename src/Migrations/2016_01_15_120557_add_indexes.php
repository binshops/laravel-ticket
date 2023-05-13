<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Add indicies for better performance.
 *
 * Class AddIndexes
 */
class AddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laravelticket', function (Blueprint $table) {
            $table->index('subject');
            $table->index('status_id');
            $table->index('priority_id');
            $table->index('user_id');
            $table->index('agent_id');
            $table->index('category_id');
            $table->index('completed_at');
        });

        Schema::table('laravelticket_comments', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('ticket_id');
        });

        Schema::table('laravelticket_settings', function (Blueprint $table) {
            $table->index('lang');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laravelticket', function (Blueprint $table) {
            $table->dropIndex('laravelticket_subject_index');
            $table->dropIndex('laravelticket_status_id_index');
            $table->dropIndex('laravelticket_priority_id_index');
            $table->dropIndex('laravelticket_user_id_index');
            $table->dropIndex('laravelticket_agent_id_index');
            $table->dropIndex('laravelticket_category_id_index');
            $table->dropIndex('laravelticket_completed_at_index');
        });

        Schema::table('laravelticket_comments', function (Blueprint $table) {
            $table->dropIndex('laravelticket_comments_user_id_index');
            $table->dropIndex('laravelticket_comments_ticket_id_index');
        });

        Schema::table('laravelticket_settings', function (Blueprint $table) {
            $table->dropIndex('laravelticket_settings_lang_index');
            $table->dropIndex('laravelticket_settings_slug_index');
        });
    }
}
