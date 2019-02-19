$(document).ready(function() {

    /**
     * смена статуса заявки на пополнение
     */
    $('.change_status_put_balance').click(function() {

        var current_obj = $(this);
        var order_id = current_obj.parent().parent().find('.order_id').html();

        $('#change_put_money_user input[name="order_id"]').val(order_id);

    });


    /**
     * смена статуса заявки на вывод
     */
    $('.change_status_out_balance').click(function() {

        var current_obj = $(this);
        var order_id = current_obj.parent().parent().find('.order_id').html();

        $('#change_out_money_user input[name="order_id"]').val(order_id);

    });



});