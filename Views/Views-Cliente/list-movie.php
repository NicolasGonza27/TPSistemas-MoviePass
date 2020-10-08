<?php
    require_once("Views/header.php");
    require_once("nav.php");
?>
<div class="row">
    <div class="container">
        <div class="content">
            <div class="scrollable">
                <form class="form" action="<?php echo FRONT_ROOT."/"?>" method="post">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Descripción</th>
                                <th>Dirección</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>lalala</td>
                                <td>lololo</td>
                                <td></td>
                                <td></td>
                                <td><button type="submit" name="id" class="btn" value="<?php?>"> Remove </button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
</div>
</div>
<?php
    require_once("Views/footer.php");
?>