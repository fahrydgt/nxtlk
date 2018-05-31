
<div class="container">
<div id="pg_contnt">aa</div>
    <nav aria-label="Page navigaation">
        <ul class="pagination" id="pagination"></ul>
    </nav>
</div>
<script type="text/javascript">
    $(function () {
        var obj = $('#pagination').twbsPagination({
            totalPages: 35,
            visiblePages: 10,
            onPageClick: function (event, page) {
            $('#pg_contnt').text('Page ' + page);
                console.info(page);
            }
        });
		
        console.info(obj.data());
    });
</script>