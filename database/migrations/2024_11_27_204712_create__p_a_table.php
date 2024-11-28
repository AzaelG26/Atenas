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
                INSERT INTO atenas_official.address (id_client, id_neighborhood, street, reference, interior_number, outer_number, created_at, updated_at)
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
            IN total_price BIGINT
        )
        BEGIN
            DECLARE new_payment_id BIGINT;
            DECLARE new_order_id BIGINT;
            
            -- Insertar el pago
            INSERT INTO payments (id_payment_method, amount, status, payment_date, created_at, updated_at) 
            VALUES (payment_method_id, payment_amount, payment_status, NOW(), NOW(), NOW());
            
            SET new_payment_id = LAST_INSERT_ID();
            
            -- Insertar la orden online
            INSERT INTO online_orders (order_name, notes, id_people, total_price, id_payment, status, created_at, updated_at) 
            VALUES (order_name, order_notes, person_id, total_price, new_payment_id, "Pending", NOW(), NOW());
            
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
        CREATE PROCEDURE UpdateOrderWithFolio(id_folio BIGINT)
            BEGIN
                DECLARE order_id BIGINT;

                -- Obtener el ID de la orden correspondiente al folio recién generado
                -- Limitar a una sola fila para evitar más de una fila en el resultado
                SELECT id_online_order INTO order_id
                FROM online_orders
                WHERE id_folio IS NULL  -- Asegúrate de que la orden no tenga un folio ya asignado
                LIMIT 1;  -- Limitar a una sola fila

                -- Si se encuentra la orden, actualizarla con el ID del nuevo folio
                IF order_id IS NOT NULL THEN
                    UPDATE online_orders
                    SET id_folio = id_folio
                    WHERE id_online_order = order_id;
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
    }
};
