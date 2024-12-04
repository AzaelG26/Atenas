<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE register_address(IN p_id_client BIGINT(20) UNSIGNED, IN p_id_neighborhood BIGINT(20) UNSIGNED, IN p_street VARCHAR(255), IN p_reference VARCHAR(255), IN p_interior_number VARCHAR(255), IN p_outer_number VARCHAR(255), OUT p_id_address BIGINT(20) UNSIGNED)
            BEGIN
                INSERT INTO address (id_client, id_neighborhood, street, reference, interior_number, outer_number, created_at, updated_at)
                VALUES (p_id_client, p_id_neighborhood, p_street, p_reference, p_interior_number, p_outer_number, NOW(), NOW());

                SET p_id_address = LAST_INSERT_ID();
            END
        ');

        DB::unprepared('
        CREATE PROCEDURE RegisterPaymentAndOrder(
            IN payment_method_id BIGINT, 
            IN payment_amount INT, 
            IN payment_status ENUM("Pending", "Completed", "Failed", "Refunded"), 
            IN order_name VARCHAR(255), 
            IN order_notes TEXT, 
            IN person_id BIGINT, 
            IN total_price BIGINT, 
            IN address_id BIGINT -- Nuevo parámetro
        )
        BEGIN
            DECLARE new_payment_id BIGINT;
            DECLARE new_order_id BIGINT;

            -- Insertar el pago
            INSERT INTO payments (id_payment_method, amount, status, payment_date, created_at, updated_at) 
            VALUES (payment_method_id, payment_amount, payment_status, NOW(), NOW(), NOW());

            SET new_payment_id = LAST_INSERT_ID();

            -- Insertar la orden online con la dirección asociada
            INSERT INTO online_orders (order_name, notes, id_people, total_price, id_payment, status, id_address, created_at, updated_at) 
            VALUES (order_name, order_notes, person_id, total_price, new_payment_id, "Pending", address_id, NOW(), NOW());

            SET new_order_id = LAST_INSERT_ID();

            -- Devolver IDs generados
            SELECT 
                new_payment_id AS PaymentID, 
                new_order_id AS OrderID;
        END
        ');

        DB::unprepared('
        CREATE PROCEDURE RegisterOrderDetails(
            IN order_id BIGINT, 
            IN menu_id BIGINT, 
            IN item_quantity INT, 
            IN item_specifications TEXT
        )
        BEGIN
            -- Verificar si el stock es suficiente antes de proceder
            IF (SELECT stock FROM stock WHERE id_menu = menu_id) >= item_quantity THEN
                -- Insertar los detalles de la orden
                INSERT INTO online_orders_details (id_online_order, id_menu, quantity, specifications)
                VALUES (order_id, menu_id, item_quantity, item_specifications);

                -- Reducir el stock del producto
                UPDATE stock
                SET stock = stock - item_quantity
                WHERE id_menu = menu_id;
            ELSE
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Stock insuficiente para el producto seleccionado.";
            END IF;
        END
        ');

        DB::unprepared('
            CREATE PROCEDURE GenerateFolioAfterOrderPaid(order_id BIGINT)
                BEGIN
                    DECLARE new_folio_identifier VARCHAR(20);
                    
                    -- Verificamos que el estado de la orden sea "Paid"
                    IF EXISTS (SELECT 1 FROM online_orders WHERE id_online_order = order_id AND status = "Paid") THEN
                        -- Generar el folio basado en el ID de la orden
                        SET new_folio_identifier = CONCAT("ORD-", LPAD(order_id, 8, "0"));
                        
                        -- Insertar el folio en la tabla `folios`
                        INSERT INTO folios (identifier, created_at, updated_at) 
                        VALUES (new_folio_identifier, NOW(), NOW());
                    END IF;
                END
        ');

        DB::unprepared('
        CREATE PROCEDURE UpdateOrderWithFolio(IN folio_id BIGINT)
        BEGIN
            DECLARE order_id BIGINT;
            DECLARE folio_identifier VARCHAR(20);

            -- Verificar si existe un folio con el ID proporcionado
            SELECT identifier INTO folio_identifier
            FROM folios
            WHERE id_folio = folio_id
            LIMIT 1;

            -- Si el folio existe, asignarlo a una orden pendiente
            IF folio_identifier IS NOT NULL THEN
                SELECT id_online_order INTO order_id
                FROM online_orders
                WHERE id_folio IS NULL
                LIMIT 1;

                IF order_id IS NOT NULL THEN
                    UPDATE online_orders
                    SET id_folio = folio_id
                    WHERE id_online_order = order_id;
                END IF;
            END IF;
        END;


        ');

        DB::unprepared('
            CREATE PROCEDURE GenerateFolioAfterOrderCompleted(IN order_id BIGINT)
            BEGIN
                DECLARE new_folio_identifier VARCHAR(20);
                DECLARE existing_folio_id BIGINT;

                -- Generamos el folio basado en el ID de la orden
                SET new_folio_identifier = CONCAT("ORD-", LPAD(order_id, 8, "0"));

                -- Verificar si la orden está en estado Completed
                IF EXISTS (SELECT 1 FROM orders WHERE id_order = order_id AND status = "Completed") THEN
                    -- Verificamos si ya existe un folio con este identificador
                    IF NOT EXISTS (SELECT 1 FROM folios WHERE identifier = new_folio_identifier) THEN
                        -- Insertar el folio en la tabla `folios`
                        INSERT INTO folios (identifier, created_at, updated_at)
                        VALUES (new_folio_identifier, NOW(), NOW());

                        -- Obtener el ID del folio insertado
                        SET existing_folio_id = LAST_INSERT_ID();
                    ELSE
                        -- Si el folio ya existe, obtener el ID del folio existente
                        SELECT id_folio INTO existing_folio_id
                        FROM folios
                        WHERE identifier = new_folio_identifier
                        LIMIT 1;
                    END IF;

                    -- Actualizar la orden para asociarla al folio
                    UPDATE orders
                    SET id_folio = existing_folio_id
                    WHERE id_order = order_id;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS register_address');
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateOrderWithFolio');
        DB::unprepared('DROP PROCEDURE IF EXISTS GenerateFolioAfterOrderPaid');
        DB::unprepared('DROP PROCEDURE IF EXISTS RegisterOrderDetails');
        DB::unprepared('DROP PROCEDURE IF EXISTS RegisterPaymentAndOrder');
        DB::unprepared('DROP PROCEDURE IF EXISTS GenerateFolioAfterOrderCompleted');
    }
};
