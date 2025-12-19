<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // User Type (admin, staff, customer)
            $table->enum('user_type', ['admin', 'staff', 'customer', 'partners'])->default('customer')->after('email');

            // Contact
            $table->string('phone', 20)->nullable()->after('user_type');

            // Verification
            $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');

            // Preferences
            $table->string('preferred_language', 5)->default('pt')->after('phone_verified_at');
            $table->boolean('newsletter_subscribed')->default(false)->after('preferred_language');

            // Security
            $table->string('password_reset_token', 100)->nullable()->after('remember_token');
            $table->dateTime('password_reset_expires')->nullable()->after('password_reset_token');

            // Control
            $table->boolean('is_active')->default(true)->after('password_reset_expires');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            $table->unsignedInteger('login_count')->default(0)->after('last_login_at');

            // Soft Delete
            $table->softDeletes()->after('updated_at');

            // Indexes
            $table->index('phone');
            $table->index('is_active');
            $table->index('user_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['phone']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['user_type']);

            $table->dropColumn([
                'user_type',
                'phone',
                'phone_verified_at',
                'preferred_language',
                'newsletter_subscribed',
                'password_reset_token',
                'password_reset_expires',
                'is_active',
                'last_login_at',
                'login_count',
                'deleted_at'
            ]);
        });
    }
};
