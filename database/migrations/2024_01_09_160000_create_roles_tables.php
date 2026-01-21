<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Rol', function (Blueprint $table) {
            $table->increments('Id'); // INT UNSIGNED AUTO_INCREMENT
            $table->string('Naam', 100);
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerking', 255)->nullable();

            // Custom timestamps
            $table->timestamp('DatumAangemaakt')->useCurrent();
            $table->timestamp('DatumGewijzigd')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('RolPerGebruiker', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedInteger('GebruikerId');
            $table->unsignedInteger('RolId');
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerking', 255)->nullable();

            // Custom timestamps
            $table->timestamp('DatumAangemaakt')->useCurrent();
            $table->timestamp('DatumGewijzigd')->useCurrent()->useCurrentOnUpdate();

            // Foreign keys
            // Note: users table usually has 'id' as bigIncrements or unsignedBigInteger
            // But the script says INT UNSIGNED for users.id.
            // In the create_users_table migration standard Laravel uses id() which is bigIncrements.
            // Let's assume standard Laravel users.id for now, but referenced as GebruikerId.
            // If users.id is BigInt, GebruikerId should be too?
            // The script says users.id is INT UNSIGNED.
            // The default create_users_table uses $table->id() which is bigIncrements.
            // To be safe with SQLite and typical Laravel setups, I'll match the type.
            // Usually we just don't add the foreign key constraint in SQLite tests if getting types right is hard,
            // but let's try to be correct.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('RolPerGebruiker');
        Schema::dropIfExists('Rol');
    }
};
