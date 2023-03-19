    <section class="page-header">
        <div class="container featured faded-background">
            <h1><?=$page_title?></h1>
        </div>
    </section>





    <main class="featured static-background">
        <div class="container">
            <div class="row">
                <?php
                $i = 0; $j = array();
                if(!empty($performers->$stdobject->PerformerPercent)){
                    foreach($performers->$stdobject->PerformerPercent as $e){
                        if(!empty($j[$e->ID])) continue;
                        $j[$e->ID] = TRUE;
                        if($i == 64) break;
                        $i++;
                        $img_url = "https://dtr2k13nvgx2o.cloudfront.net/auto-resized/responsive-images/performer/" . $e->ID . "/" . $e->ID . "-285x215.jpg";
                        if(stripos(get_headers($img_url)[0], "200 OK") == FALSE) $img_url = "assets/home/images/featured-" . $e->Category->ParentCategoryDescription . ".jpg";
                ?>
                <div class="single-event col-md-3 col-sm-6">
                    <img class="w-100" src="<?=$img_url?>">
                    <div class="performer-details">
                        <h3><?=$e->Description?></h3>
                    </div>
                    <a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>" class="btn-block btn-sm btn-gradient">SEE EVENTS</a>
                </div>
                <?php }} ?>
            </div>
        </div>
    </main>





    