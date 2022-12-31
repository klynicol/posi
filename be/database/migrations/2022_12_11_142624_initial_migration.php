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
         * Base
         */
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->string('service_price');
            $table->string('service_duration');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->foreignId('employee_id')->nullable()->constrained();
            $table->string('number');
            $table->timestamp('date_paid')->nullable();
            $table->string('status');
            $table->string('total');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE orders ADD CONSTRAINT orders_multi CHECK (
            customer_id IS NOT NULL 
            OR employee_id IS NOT NULL
        )");

        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('description');
            $table->string('type');
            $table->string('scope'); // Percentage, Fixed
            $table->string('value');
            $table->timestamps();
        });

        /**
         * Clubs
         */
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('club_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('club_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });


        /**
         * Products
         */
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('product_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('review');
            $table->string('rating');
            $table->timestamps();
        });

        Schema::create('product_collection_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_collection_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('product_category_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('product_tag_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });


        /**
         * Services
         */

        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('service_category_name');
            $table->timestamps();
        });

        /**
         * Employees
         */
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('role');
            $table->timestamps();
        });

        Schema::create('employee_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('permission');
            $table->timestamps();
        });

        Schema::create('employee_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onUpdate('cascade');;
            $table->timestamps();
        });

        /**
         * Orders
         */
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_quantity');
            $table->timestamps();
        });

        Schema::create('order_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('service_name');
            $table->string('service_price');
            $table->string('service_quantity');
            $table->timestamps();
        });

        /**
         * Customers
         */
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        /**
         * Loyalty Programs
         */
        Schema::create('loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('loyalty_program_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loyalty_program_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('balance');
            $table->timestamps();
        });

        /**
         * Discounts
         */
        Schema::create('discounts_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('discounts_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('discounts_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('discounts_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('discounts_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('discounts_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_variant_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('discounts_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_collection_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('discounts_loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->foreignId('loyalty_program_id')->constrained()->onDelete('cascade');
            $table->string('discount_applicable'); // Product, Order, Customer, Employee, Category, Variant, Collection
            $table->timestamps();
        });

        /**
         * Gift Cards
         */
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description');
            $table->string('balance');
            $table->timestamps();
        });
        Schema::create('gift_card_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_card_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('gift_card_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_card_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('gift_card_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_card_id')->constrained()->onDelete('cascade');
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        /**
         * Invoices
         */
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->string('status');
            $table->string('total');
            $table->string('total_tax');
            $table->string('total_discount');
            $table->string('total_shipping');
            $table->string('total_price');
            $table->string('subtotal_price');
            $table->string('subtotal_price_with_tax');
            $table->string('currency');
            $table->string('taxes_included');       
            $table->string('financial_status');
            $table->string('billing_address_company');
            $table->string('billing_address_address1');
            $table->string('billing_address_address2');
            $table->string('billing_address_city'); 
            $table->string('billing_address_zip');  
            $table->string('billing_address_province');
            $table->string('billing_address_country');
            $table->string('billing_address_phone');
            $table->string('billing_address_name');
        });

        /**
         * Expenses
         */
        

        /**
         * Generics
         */
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->string('size');
            $table->string('width');
            $table->string('height');
            $table->string('alt');
            $table->string('title');
            $table->string('description');
            $table->string('url');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE images ADD CONSTRAINT images_multi CHECK (
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
        DB::statement("ALTER TABLE addresses ADD CONSTRAINT addresses_multi CHECK (
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
        DB::statement("ALTER TABLE phone_numbers ADD CONSTRAINT phone_numbers_multi CHECK (
            customer_id IS NOT NULL 
            OR employee_id IS NOT NULL
        )");

        /**
         * Utility
         */
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropDatabaseIfExists('posi');
    }
};
