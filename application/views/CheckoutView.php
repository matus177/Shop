<div class="col-md-9">
    <div class="checkout-wrap">
        <ul class="checkout-bar">
            <li id="kos" class="active">Kosik</li>
            <li id="dop" class="next">Doprava a platba</li>
            <li id="ud" class="next">Dodacie udaje</li>
            <li id="suh" class="next">Suhrn</li>
            <li id="hot" class="active">Dokoncenie</li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function () {
        switch (<?php echo $data ?>) {
            case 0:
                $('#kos').removeClass().addClass('active');
                $('#dop').removeClass().addClass('next');
                $('#ud').removeClass().addClass('next');
                $('#suh').removeClass().addClass('next');
                $('#hot').removeClass().addClass('next');
                break;
            case 1:
                $('#kos').removeClass().addClass('previous visited');
                $('#dop').removeClass().addClass('active');
                $('#ud').removeClass().addClass('next');
                $('#suh').removeClass().addClass('next');
                $('#hot').removeClass().addClass('next');
                break;
            case 2:
                $('#kos').removeClass().addClass('previous visited');
                $('#dop').removeClass().addClass('previous visited');
                $('#ud').removeClass().addClass('active');
                $('#suh').removeClass().addClass('next');
                $('#hot').removeClass().addClass('next');
                break;
            case 3:
                $('#kos').removeClass().addClass('previous visited');
                $('#dop').removeClass().addClass('previous visited');
                $('#ud').removeClass().addClass('previous visited');
                $('#suh').removeClass().addClass('active');
                $('#hot').removeClass().addClass('next');
                break;
            case 4:
                $('#kos').removeClass().addClass('previous visited');
                $('#dop').removeClass().addClass('previous visited');
                $('#ud').removeClass().addClass('previous visited');
                $('#suh').removeClass().addClass('previous visited');
                $('#hot').removeClass().addClass('active');
        }
    });
</script>