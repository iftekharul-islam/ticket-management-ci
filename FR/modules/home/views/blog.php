    <?php if(empty($post)){ ?>
    <section class="page-header">
        <div class="container blog faded-background">
            <h1><?=$page_title?></h1>
        </div>
    </section>
    <?php } ?>
    
    
    <style>
    .post-content ul{
        list-style-type: disc;
        margin-bottom: 10px;
     }
    .post-content ol{
        margin-bottom: 10px;
        list-style-type: decimal;
    }
    .post-content span{
        display: inline;
    }
 </style>
    <main class="blog static-background">
        <div class="container">
            <div class="row">
                <div class="<?=(!empty($full_width)? "col-md-12" : "col-md-9") . (empty($post)? " posts" : "")?>">
                    <?php if(empty($post)){ foreach($posts as $p){ ?>
                    <article class="bordered-section single-post clearfix">
                        <div class="post-thumb"><a href="blog/<?=$p->url?>"><img src="assets/posts/images/<?=(!empty($p->featured_image) && file_exists("assets/posts/images/" . $p->featured_image))? $p->featured_image : "default.jpg"?>"  alt="<?=$p->alt_text?>"></a></div>
                        <div class="post-info">
                            <a href="blog/<?=$p->url?>"><h2 class="post-title"><?=$p->title?></h2></a>
                            <div class="post-meta">
                                <div class="post-date"><i class="lni-calendar"></i> <?=date("F j, Y", strtotime($p->date))?></div>
                                <div class="post-author"><i class="lni-user"></i> by <?=$p->author?></div>
                            </div>
                        </div>
                    </article>
                    <?php } if(empty($posts)){ ?>
                    <h4>No articles in this topic have been posted yet.</h4>
                    <?php } }else{ ?>
                    <article class="bordered-section single-post clearfix">
                        <div class="post-thumb"><img src="assets/posts/images/<?=(!empty($post->featured_image) && file_exists("assets/posts/images/" . $post->featured_image))? $post->featured_image : "default.jpg"?>"  alt="<?=$post->alt_text?>"></a></div>
                        <div class="post-info mb-5">
                            <h1 class="post-title"><?=$post->title?></h1>
                            <div class="post-meta">
                                <div class="post-date"><i class="lni-calendar"></i> <?=date("F j, Y", strtotime($post->date))?></div>
                                <div class="post-author"><i class="lni-user"></i> by <?=$post->author?></div>
                            </div>
                        </div>
                        <div class="post-headings-list d-none">
                            <h2>CONTENTS  <i class="lni-chevron-down-circle" data-toggle="collapse" data-target="#h2s" aria-expanded="true"></i></h2>
                            <ul id="h2s" class="collapse show"></ul>
                        </div>
                        <div class="post-content" style="overflow-y: hidden">
                            <?=$post->content?>
                        </div>
                    </article>
                    <?php } ?>
                    <?=$links?>
                </div>
                <?php if(empty($full_width)){ ?>
                <aside class="col-md-3">
                    <div class="bordered-section search-post">
                        <form action="blog/search" method="get" class="input-group">
                            <input class="form-control" name="query" placeholder="Search in posts" type="search">
                            <div class="input-group-append">
                                <button class="btn btn-gradient" type="submit">
                                    <i class="lni-keyword-research"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <?php if(!empty($post) && !empty($posts)){ ?>
                    <div class="bordered-section related-posts">
                        <h3>RELATED</h3>
                        <ul>
                            <?php foreach($posts as $p){ ?>
                            <li>
                                <a href="blog/<?=$p->url?>" class="clearfix">
                                    <div class="p-thumb"><img src="assets/posts/images/<?=!empty($p->featured_image)? $p->featured_image : "default.jpg"?>" width="30" alt="<?=$p->alt_text?>"></div>
                                    <div class="p-title"><?=$p->title?></div>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                    <div class="bordered-section categories">
                        <h3>TOPICS</h3>
                        <ul>
                            <?php foreach($categories as $c){ ?>
                            <li<?=$c->parent_id == 0? ' class="emphasize"' : ''?>><a href="blog/category/<?=$c->url?>"><?=$c->name?></a></li>
                            <?php foreach($c->child_categories as $ch){ ?>
                            <li><a href="blog/category/<?=$ch->url?>"><?=$ch->name?></a></li>
                            <?php }} ?>
                        </ul>
                    </div>
                </aside>
                <?php } ?>
            </div>
        </div>
    </main>

