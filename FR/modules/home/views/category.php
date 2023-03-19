    <section class="page-header">
        <div class="container faded-background" <?php if(!empty($img_url)){ ?>style="background-image: url('<?=$img_url?>')"<?php } ?>>
            <h1><?=$page_title?></h1>
        </div>
    </section>

 <style>
    .category-content ul{
        list-style-type: disc;
        margin-bottom: 10px;
     }
    .category-content ol{
        margin-bottom: 10px;
        list-style-type: decimal;
    }
    .category-content span{
        display: inline;
    }
 </style>
    <main class="category static-background">
        <div class="container">
            <?php if(!empty($contents_on_top)){ ?>
            <div class="bordered-section d-block category-content">
                <?php foreach($contents_on_top as $c) echo $c->content?>
            </div>
            <?php } ?>
            
                
                
                
                
            <?php if(!empty($popular_subcategories)){ ?>
            <div class="row">
                <?php foreach($popular_subcategories as $name => $s){?>
                <div class="col-md-4 mb-3">
                    <div class="bordered-section card featured-performers">
                        <h3><?=$name?></h3>
                        <ul>
                            <?php
                            $i = 0;
                            if(!empty($s->GetPerformerByCategoryResult->Performer)){
                                foreach($s->GetPerformerByCategoryResult->Performer as $e){
                                    if($i == 6) break;
                                    $i++;
                            ?>
                            <li><a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>  "><?=$e->Description?></a></li>
                            <?php }} ?>
                        </ul>
                        <a href="category/<?=$s->url?>" class="btn-gradient btn">MORE <i class="lni-chevron-right-circle"></i></a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>

            
            
            
            
            <?php if(!empty($performers)){ if(!empty($performers->GetPerformerByCategoryResult->Performer)){ ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input type="text" placeholder="Search in <?=strtoupper($page_title)?>" class="filter form-control">
                </div>
            </div>
            <div class="row contents-to-filter">
                <?php
                $j = array();
                $ps = $performers->GetPerformerByCategoryResult->Performer;
                is_array($ps) || $ps = array($ps);
                foreach($ps as $e){
                    if(!empty($j[$e->ID])) continue;
                    $j[$e->ID] = TRUE;
                ?>
                <div class="performer-name col-md-3 col-sm-6">
                    <a href="events/<?=$this->mfrk->url_friendly_string($e->Description) . '-tickets/' . $e->ID?>"><?=$e->Description?></a>
                </div>
                <?php } ?>
            </div>
            <?php }else{ echo "<h4>Currently there are no events in this category</h4>"; }} ?>
            
            
            
            
            
            <?php if(!empty($contents_on_bottom)){ ?>
            <div class="bordered-section d-block category-content" style="margin-top:20px">
                <?php foreach($contents_on_bottom as $c) echo $c->content?>
            </div>
            <?php } ?>
        </div>
    </main>





    