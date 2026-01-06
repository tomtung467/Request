<?php

use App\Enums\LeaveApplicationStatus;
use App\Enums\LeaveApplicationType;
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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_days')->virtualAs('DATEDIFF(end_date, start_date) + 1');
            $table->string('reason');
            $table->string('type')->default(LeaveApplicationType::ANNUAL->value);
            $table->string('status')->default(LeaveApplicationStatus::PENDING->value);
            $table->softDeletes();
            $table->timestamps();
            $table->userstamps();
            $table->userstampSoftDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_leave_request_');
    }
};
