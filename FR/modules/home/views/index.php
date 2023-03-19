    
    <section class="banner-slider">
        <div id="banners" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $i = 0; foreach($sliders as $s){ ?>
                <figure class="carousel-item<?=$i == 0? " active" : ""?>">
                    <img class="d-block w-100" src="assets/home/sliders/<?=$s->image?>" alt="<?=$s->heading?>">
                    <figcaption class="container">
                        <div class="banner-caption">
                            <h2><?=$s->heading?></h2>
                            <p><?=$s->description?></p>
                            <a href="<?=$s->link?>" class="btn btn-gradient"><?=strtoupper($s->link_title)?></a>
                            <a href="<?=$s->link?>" class="btn btn-gradient btn-sm"><?=strtoupper($s->link_title)?></a>
                        </div>
                    </figcaption>
                </figure>
                <?php $i++;} ?>
            </div>
            <a class="carousel-control-prev" href="#banners" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#banners" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    
    
    
    

    <section class="search-bar">
        <div class="container">
            <div class="row bar-design">
                <div class="col-md-3">
                    FIND <strong>YOUR</strong> SEATS
                </div>
                <div class="col-md-6">
                    <form class="form-inline" action="search" method="get">
                        <input class="form-control search-query" type="search" placeholder="Search" aria-label="Search" name="query" required>
                        
                        
                        
                        
                        
                        <div class="modal fade" id="state-list" tabindex="-1" role="dialog" aria-labelledby="SearchOptions" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="SearchOptions" style="color: #333;">Enter full name of your city - </h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" id="city-name" placeholder="Example 'San Francisco'" class="form-control" name="city">
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                    </form>
                </div>
                <div class="col-md-3">
                    <a class="select-state" data-toggle="modal" data-target="#state-list"><i class="lni-location"></i><div class="state-name">Your Location</div><i class="lni-chevron-down"></i></a>
                </div>
            </div>
        </div>
    </section>





    <main class="home">
        <div class="container">
            <div class="row featured-contents">
                <div class="col-md-4 mb-3">
                    <div class="bordered-section card featured-performers">
                        <h3><strong>TRENDING</strong> EVENTS</h3>
                        <ul>
                            <?php
                            $i = 0; $j = array();
                            if(!empty($trending_events->GetHighInventoryPerformersResult->PerformerPercent)){
                                foreach($trending_events->GetHighInventoryPerformersResult->PerformerPercent as $e){
                                    if(!empty($j[$e->ID])) continue;
                                    $j[$e->ID] = TRUE;
                                    if($i == 6) break;
                                    $i++;
                            ?>
                            <li><a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>  "><?=$e->Description?></a></li>
                            <?php }} ?>
                        </ul>
                        <a href="trending-events" class="btn-gradient-reverse mt-6px">MORE <i class="lni-chevron-right-circle"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="bordered-section card featured-performers">
                        <h3><strong>ON SALE</strong> NOW</h3>
                        <ul>
                            <?php
                            $i = 0; $j = array();
                            if(!empty($on_sale_now->GetHighSalesPerformersResult->PerformerPercent)){
                                foreach($on_sale_now->GetHighSalesPerformersResult->PerformerPercent as $e){
                                    if(!empty($j[$e->ID])) continue;
                                    $j[$e->ID] = TRUE;
                                    if($i == 6) break;
                                    $i++;
                            ?><li><a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>  "><?=$e->Description?></a></li>
                            <?php }} ?>
                        </ul>
                        <a href="on-sale-now" class="btn-gradient-reverse mt-6px">MORE <i class="lni-chevron-right-circle"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="bordered-section card latest-posts">
                        <h3><strong>GOOD</strong> READS</h3>
                        <ul>
                            <?php if(!empty($posts)){foreach($posts as $p){ ?>
                            <li>
                                <a href="blog/<?=$p->url?>" class="clearfix">
                                    <div class="p-thumb"><img src="assets/posts/images/<?=(!empty($p->featured_image) && file_exists("assets/posts/images/" . $p->featured_image))? $p->featured_image : "default.jpg"?>" width="30" alt="<?=$p->alt_text?>"></div>
                                    <div class="p-title"><?=$p->title?></div>
                                </a>
                            </li>
                            <?php }} ?>
                        </ul>
                        <a href="blog" class="btn-gradient-reverse">BLOG <i class="lni-notepad"></i></a>
                    </div>
                </div>
                



                
                <?php if(!empty($midsections)){foreach($midsections as $a){ ?>
                <div class="col-md-<?=round(12 * ($a->width / 100))?> mb-5">
                    <?php if(!empty($a->image)){ ?>
                    <a href="<?=$a->link?>"><img class="w-100" src="assets/home/ads/<?=$a->image?>" alt="<?=$a->alt_text?>"></a>
                    <?php } ?>
                    <?php if(!empty($a->code)) echo $a->code; ?>
                </div>
                <?php }} ?>
                
                
                
                
                
                <div class="col-md-4">
                    <div class="bordered-section card featured-performers">
                        <h3>TOP <strong>SPORTS</strong></h3>
                        <ul>
                            <?php
                            $i = 0; $j = array();
                            if(!empty($top_sports->GetHighInventoryPerformersResult->PerformerPercent)){
                                foreach($top_sports->GetHighInventoryPerformersResult->PerformerPercent as $e){
                                    if(!empty($j[$e->ID])) continue;
                                    $j[$e->ID] = TRUE;
                                    if($i == 6) break;
                                    $i++;
                            ?>
                            <li><a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>  "><?=$e->Description?></a></li>
                            <?php }} ?>
                        </ul>
                        <a href="category/sports" class="btn btn-gradient">VIEW ALL <i class="lni-chevron-right-circle"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="bordered-section card featured-performers">
                        <h3>TOP <strong>CONCERTS</strong></h3>
                        <ul>
                            <?php
                            $i = 0; $j = array();
                            if(!empty($top_concerts->GetHighInventoryPerformersResult->PerformerPercent)){
                                foreach($top_concerts->GetHighInventoryPerformersResult->PerformerPercent as $e){
                                    if(!empty($j[$e->ID])) continue;
                                    $j[$e->ID] = TRUE;
                                    if($i == 6) break;
                                    $i++;
                            ?>
                            <li><a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>  "><?=$e->Description?></a></li>
                            <?php }} ?>
                        </ul>
                        <a href="category/concerts" class="btn btn-gradient">VIEW ALL <i class="lni-chevron-right-circle"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="bordered-section card featured-performers">
                        <h3>TOP <strong>THEATER</strong></h3>
                        <ul>
                            <?php
                            $i = 0; $j = array();
                            if(!empty($top_theater->GetHighInventoryPerformersResult->PerformerPercent)){
                                foreach($top_theater->GetHighInventoryPerformersResult->PerformerPercent as $e){
                                    if(!empty($j[$e->ID])) continue;
                                    $j[$e->ID] = TRUE;
                                    if($i == 6) break;
                                    $i++;
                            ?>
                            <li><a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>  "><?=$e->Description?></a></li>
                            <?php }} ?>
                        </ul>
                        <a href="category/theater" class="btn btn-gradient">VIEW ALL <i class="lni-chevron-right-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>




 