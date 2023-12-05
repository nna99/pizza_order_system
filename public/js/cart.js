$(document).ready(function(){

    //  active + button
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $totalprice = Number($parentNode.find('#price').text().replace("kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $totalprice * $qty ;
        $parentNode.find('#total').html($total+" kyats")

        summaryCalculation();
    })

    //  active - button
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $totalprice = Number($parentNode.find('#price').text().replace("kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $totalprice * $qty ;
        $parentNode.find('#total').html($total+" kyats")

        summaryCalculation();
    })

    //  active X button
    $('.btnRemove').click(function(){
        $parentNode = $(this).parents("tr");
        $parentNode.remove();

        summaryCalculation();
    })

    function summaryCalculation(){
        $allTotalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row){
            $allTotalPrice  += Number($(row).find('#total').text().replace("kyats",""));
        })
        $('#subTotalPrice').html(`${$allTotalPrice} kyats `)

        $('#finalTotalPrice').html(`${$allTotalPrice + 2500} kyats `)
    }

})
