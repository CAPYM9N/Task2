<?php if(isset($_SESSION['guest'])):?>
<div class="row justify-content-center">
    <div class="col-3">
<div class="row">

        <div> Hello: <?= $_SESSION['guest']?></div>

</div>
    </div>
</div>

<?php endif?>