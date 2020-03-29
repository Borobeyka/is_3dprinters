$(document).ready(function(){
    $("a#add-to-cart").on("click", function() {
        var itemID = $(this).attr("data-item-id");
        $.ajax({
            type: "POST",
            url: "/core/libs/handlers/addItemToCart.php",
            data: "itemID="+itemID,
            success: function(response) {
                var response = JSON.parse(response);
                if(response["status"] == "success") {
                    alert(response["message"]);
                    location.reload();
                }
                else if(response["status"] == "error")
                    alert("Ошибка:\n" + response["message"]);
            }
        });
    });
    $("a#loadMoreItems").on("click", function() {
        var pageID = $(this).attr("data-page-id");
        $.ajax({
            type: "POST",
            url: "/templates/catalog/show_category.php",
            data: "page="+pageID,
            success: function() {
                
            }
        });
    });

    $("img#add-count-cart").on("click", function() {
        var itemID = $(this).attr("data-item-id");
        $.ajax({
            type: "POST",
            url: "/core/libs/handlers/addCountToCart.php",
            data: "itemID="+itemID,
            success: function() {
                location.reload();
            }
        });
    });

    $("img#sub-count-cart").on("click", function() {
        var itemID = $(this).attr("data-item-id");
        $.ajax({
            type: "POST",
            url: "/core/libs/handlers/subCountToCart.php",
            data: "itemID="+itemID,
            success: function() {
                location.reload();
            }
        });
    });

    $(".delete-item-from-cart").on("click", function() {
        var itemID = $(this).attr("data-item-id");
        $.ajax({
            type: "POST",
            url: "/core/libs/handlers/deleteItemFromCart.php",
            data: "itemID="+itemID,
            success: function() {
                location.reload();
            }
        });
    });

    $(function() {
        $("#phone").mask("8(999)999-99-99");
    });
});