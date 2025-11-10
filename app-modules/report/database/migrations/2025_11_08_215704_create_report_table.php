<?php

use Helpz\Device\Models\Device;
use Helpz\ServiceRequest\Models\ServiceRequest;
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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(ServiceRequest::class);
            $table->foreignIdFor(Device::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
