<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Base Tables
         */
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email')->unique();
            $table->string('customer_club')->nullable();
            $table->timestamps();
        });

        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
        });

        /**
         * Loyalty Programs
         */
        Schema::create('loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->string('loyalty_program_name');
            $table->string('loyalty_program_description');
            $table->timestamps();
        });

        Schema::create('loyalty_program_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('loyalty_program_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('balance');
            $table->timestamps();
        });




        /**
         * Products
         */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('quantity');
            $table->timestamps();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('product_category_name');
            $table->timestamps();
        });

        Schema::create('product_collections', function (Blueprint $table) {
            $table->id();
            $table->string('product_collection_name');
            $table->timestamps();
        });

        Schema::create('product_collection_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('product_collection_id');
            $table->timestamps();
        });

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('product_review');
            $table->string('product_rating');
            $table->timestamps();
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('product_tag');
            $table->timestamps();
        });

        Schema::create('product_category_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_category_id');
            $table->timestamps();
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('variant_name');
            $table->string('variant_value');
            $table->timestamps();
        });

        /**
         * Employees
         */

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('employee_email')->unique();
            $table->timestamps();
        });

        Schema::create('employee_roles', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('role');
            $table->timestamps();
        });

        Schema::create('employee_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('permission');
            $table->timestamps();
        });

        Schema::create('employee_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
        });

        /**
         * Orders
         */
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->foreignId('employee_id')->nullable()->constrained();
            $table->string('order_number');
            $table->string('order_date');
            $table->string('order_status');
            $table->string('order_total');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE orders ADD CHECK (
            customer_id IS NOT NULL 
            OR employee_id IS NOT NULL
        )");

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_quantity');
            $table->timestamps();
        });

        /**
         * Discounts
         */
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_name');
            $table->string('discount_code');
            $table->string('discount_description');
            $table->string('discount_type');
            $table->string('discount_scope'); // Percentage, Fixed
            $table->string('discount_value');
            $table->timestamps();
        });

        Schema::create('discounts_products', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
        });

        Schema::create('discounts_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
        });

        Schema::create('discounts_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
        });

        Schema::create('discounts_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->integer('employee_id');
            $table->timestamps();
        });

        Schema::create('discounts_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->integer('product_category_id');
            $table->timestamps();
        });

        Schema::create('discounts_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->unsignedBigInteger('product_variant_id');
            $table->timestamps();
        });

        Schema::create('discounts_collections', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->integer('product_collection_id');
            $table->timestamps();
        });

        Schema::create('discounts_loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_id');
            $table->integer('loyalty_program_id');
            $table->timestamps();
        });

        /**
         * Generics
         */
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('image_name');
            $table->string('image_type');
            $table->string('image_size');
            $table->string('image_width');
            $table->string('image_height');
            $table->string('image_alt');
            $table->string('image_title');
            $table->string('image_description');
            $table->string('image_url');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE images ADD CHECK (
            product_id IS NOT NULL 
            OR customer_id IS NOT NULL
        )");

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE addresses ADD CHECK (
            customer_id IS NOT NULL 
            OR employee_id IS NOT NULL
        )");

        Schema::create('phone_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('phone_number');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE phone_numbers ADD CHECK (
            customer_id IS NOT NULL 
            OR employee_id IS NOT NULL
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts_collections');
        Schema::dropIfExists('discounts_variants');
        Schema::dropIfExists('discounts_categories');
        Schema::dropIfExists('discounts_employees');
        Schema::dropIfExists('discounts_customers');
        Schema::dropIfExists('discounts_orders');
        Schema::dropIfExists('discounts_products');
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('employee_orders');
        Schema::dropIfExists('employee_permissions');
        Schema::dropIfExists('employee_roles');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('phone_numbers');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('images');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('product_collections');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('loyalty_programs');
        Schema::dropIfExists('discounts_loyalty_programs');
        DB::statement("DROP CHECK IF EXISTS images");
        DB::statement("DROP CHECK IF EXISTS addresses");
        DB::statement("DROP CHECK IF EXISTS phone_numbers");
        DB::statement("DROP CHECK IF EXISTS orders");
    }
};
