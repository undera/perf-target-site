<h1>E-Commerce Website</h1>
<p>We sell items, arranged by categories:</p>

<div id="spa_main">

</div>

<script>
    $(function () {
        $.getJSON("/api/categories").fail(function () {
            alert("failed API call");
        }).success(function (data) {
            for (var n = 0; n < data.length; n++) {
                var div = $("<div></div>").addClass("cat-card well");
                div.append("<h3>" + data[n].name + "</h3>").css('color', data[n].color);
                div.append($("<i></i>").addClass("fa").addClass(data[n].icon));
                $("#spa_main").append(div);
            }
        })
    });
</script>