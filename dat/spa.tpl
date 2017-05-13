<h1>E-Commerce Website</h1>

<div id="spa_main">

</div>

<script>
    $(function () {
        var mainDiv = $("#spa_main");
        $.getJSON("/api/categories").fail(function () {
            alert("failed API call");
        }).success(function (data) {
            mainDiv.empty().append($("<p>We sell items, arranged by categories:</p>"));


            for (var n = 0; n < data.length; n++) {
                var div = $("<div></div>").addClass("cat-card well");
                div.append("<h3>" + data[n].name + "</h3>").css('color', data[n].color);
                div.append($("<i></i>").addClass("fa").addClass(data[n].icon));
                mainDiv.append(div);
                div.click(function () {
                    $("#spa_main").empty();
                });
            }
        })
    });
</script>