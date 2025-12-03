<?php

use Helpz\Device\Models\Device;
use Helpz\ServiceRequest\Enums\ServiceRequestStatusEnum;
use Helpz\User\Models\User;
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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->longText('description');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Device::class);
            $table->foreignId('technician_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->default(ServiceRequestStatusEnum::Pending->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
