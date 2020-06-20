<?php

namespace IgorTrinidad\ModelUtilities\Tests;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as TestCaseBase;

use Tests\Models\User;
use Tests\Models\Product;

abstract class TestCase extends TestCaseBase
{
    protected function setUp(): void
    {
        parent::setUp();

        $config = require __DIR__.'/config/database.php';

        $db = new DB;
        $db->addConnection($config['sqlite']);
        $db->setAsGlobal();
        $db->bootEloquent();

        $this->migrate();
    }

    /**
     * Migrate the database.
     *
     * @return void
     */
    protected function migrate()
    {
        DB::schema()->dropAllTables();

        DB::schema()->create('actors', function (Blueprint $table) {
            $table->uuid('id')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->date('bday');
            $table->decimal('payroll', 15, 2);
        });

        DB::schema()->create('products', function (Blueprint $table) {
            $table->uuid('id')->nullable();
            $table->string('name');
            $table->decimal('value', 15, 2);
        });

    }

}
