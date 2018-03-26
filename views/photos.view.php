<?php $title="Accueil"; ?>
<?php include ('partials/_header_auth.php'); ?>

    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading col-md-12" style="height: 50px;">
                            <div class="col-md-10">
                                <h2 class="panel-title" style="font-size: 20px;">Photos</h2>
                            </div>
                            <div class="col-md-2">
                                <input type="file" name="photos" id="photos"/>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php if(count($photos) !=0): ?>
                                <?php foreach ($photos as $photo): ?>
                                    <?php include('partials/_gallery.php') ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>Cet utilisateur n'a aucune photo pour le moment...</p>
                            <?php endif; ?>

                    </div>


                </div>

            </div>
        </div>

        </div>
    </section>

<?php include ('partials/_footer.php') ?>

