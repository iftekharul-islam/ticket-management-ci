<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=!empty($og_title)? $og_title : ($page_title . " | " . $site->app_title . (!empty($site->tagline)? " | " . $site->tagline : ""))?></title>
    <base href="<?=base_url()?>">
    
    <meta charset="utf-8">
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="author" content="<?=$site->app_title?>">
    <meta name="keywords" content="<?=!empty($og_keywords)? $og_keywords : $site->keywords?>">
    <meta name="description" content="<?=!empty($og_description)? $og_description : $site->description?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- OPEN GRAPH META --> 
    <meta property="og:site_name" content="<?=$site->app_title?>">
    <meta property="og:type" content="<?=!empty($og_type)? $og_type : "website"?>">
    <meta property="og:url" content="<?=current_url()?>">
    <meta property="og:title" content="<?=!empty($og_title)? $og_title : $page_title . " | " . $site->app_title?>">
    <meta property="og:description" content="<?=!empty($og_description)? $og_description : $site->description?>">
    <meta property="og:image" content="<?=base_url() . (!empty($og_image)? $og_image : "assets/logo/logo-square.png")?>">
    <meta name="facebook-domain-verification" content="l90zgh59j7slpkjepm8m47go5c3au2" />


    <!-- FAVORITE ICONS -->
    <link rel="icon" type="image/x-icon" href="assets/logo/favicon.ico">
    <link rel="icon" sizes="192x192" href="assets/logo/icon.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/logo/touch-icon-iphone-retina.jpg">
    <link rel="apple-touch-icon" sizes="167x167" href="assets/logo/touch-icon-ipad-retina.jpg">

    <!-- CASCADING STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="assets/home/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/home/css/style.css">
    
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript" src="assets/home/js/jquery.js"></script>
    <script type="text/javascript" src="assets/home/js/bootstrap.js"></script>
    
    
    <script type='application/ld+json'> 
    {
      "@context": "http://www.schema.org",
      "@type": "Organization",
      "name": "888 seats",
      "url": "https://888seats.com/",
      "logo": "https://888seats.com/assets/logo/logo.png",
      "image": "https://888seats.com/assets/home/sliders/1573824021.jpg",
      "description": "An immense selection of tickets for all live Concerts, Sports, and Theater events are on sale now! Order easily & securely",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "4600 E Washington St Suite 300, Phoenix, AZ 85034 United States",
        "addressLocality": "Phoenix",
        "addressRegion": "Arizona",
        "postalCode": "85034",
        "addressCountry": "United States"
      },
     
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": " (866)-459-9233",
        "contactType": "+8801619005792"
      }
   }
  </script>
  
  <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T9NVPWL');</script>
    <!-- End Google Tag Manager -->
    
    <?=$site->before_head_end_tag?>
    
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0" aria-label="Site Navigation">
                <a class="navbar-brand pt-0" href=""><img src="assets/logo/logo.png" alt="<?=$site->app_title?>" height="40"></a>
                <button class="navbar-toggler my-2" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main-menu">
                    <form class="form-inline mx-auto<?=$controller == 'home'? ' v-hidden' : ''?>" action="search" method="get">
                        <input class="form-control search-query" type="search" placeholder="Search" aria-label="Search" name="query">
                    </form>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="category/sports">SPORTS</a>
                            <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#sports"></i>
                            <div class="dropdown-nav collapse tabbed-menu" id="sports">
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/sports/baseball">Baseball</a>
                                        <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#baseball"></i>
                                        <div class="dropdown-nav collapse tabbed-content" id="baseball">
                                            <ul>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/baseball/mlb">MLB</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/baseball/ilb">ILB</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/baseball/ncaa-baseball">NCAA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/baseball/pcl">PCL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/baseball/minors-aaa">Minors AAA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/baseball/other-baseball">Other</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/sports/basketball">Basketball</a>
                                        <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#basketball"></i>
                                        <div class="dropdown-nav collapse tabbed-content" id="basketball">
                                            <ul>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/basketball/nba">NBA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/basketball/wnba">WNBA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/basketball/ncaa-basketball">NCAA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/basketball/other-basketball">Other</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/sports/football">Football</a>
                                        <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#football"></i>
                                        <div class="dropdown-nav collapse tabbed-content" id="football">
                                            <ul>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/football/nfl">NFL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/football/ncaa-football">NCAA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/football/afl">AFL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/football/cfl">CFL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/football/other-football">Other</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/sports/hockey">Hockey</a>
                                        <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#hockey"></i>
                                        <div class="dropdown-nav collapse tabbed-content" id="hockey">
                                            <ul>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/hockey/nhl">NHL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/hockey/ncaa-hockey">NCAA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/hockey/ahl">AHL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/hockey/chl-central">CHL Central</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/hockey/chl-canadian">CHL Canadian</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/hockey/echl">ECHL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/hockey/sphl">SPHL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/hockey/whl">WHL</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/sports/racing">Racing</a>
                                        <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#racing"></i>
                                        <div class="dropdown-nav collapse tabbed-content" id="racing">
                                            <ul>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/racing/truck">Truck</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/racing/nascar">NASCAR</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/racing/auto">Auto</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/racing/horse">Horse</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/racing/motorcycle">Motorcycle</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/sports/soccer">Soccer</a>
                                        <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#soccer"></i>
                                        <div class="dropdown-nav collapse tabbed-content" id="soccer">
                                            <ul>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/soccer/mls">MLS</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/soccer/ncaa-soccer">NCAA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/soccer/english-premier-league" title="English Premier League">EPL</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/soccer/italian-serie-a">Serie A</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/soccer/spanish-liga">La Liga</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/soccer/french-ligue-1">Ligue 1</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/soccer/german-bundesliga">Bundesliga</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/sports/wrestling">Wrestling</a>
                                        <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#wrestling"></i>
                                        <div class="dropdown-nav collapse tabbed-content" id="wrestling">
                                            <ul>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="category/sports/wrestling/wwe">WWE</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/wrestling/ncaa-wrestling">NCAA</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="category/sports/wrestling/other-wrestling">Other</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category/concerts/">CONCERTS</a>
                            <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#concerts"></i>
                            <div class="dropdown-nav collapse" id="concerts">
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="category/concerts/comedy">Comedy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/pop">Pop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/folk">Country/Folk</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/festival">Festivals</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/hip-hop">Hip-Hop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/metal">Metal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/alternative">Alternative</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/soul">R&B/Soul</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/concerts/latin">Latin</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category/theater">THEATER</a>
                            <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#theater"></i>
                            <div class="dropdown-nav collapse" id="theater">
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="category/theater/opera">opera</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/theater/ballet">ballet</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/theater/broadway">broadway</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/theater/cirque-du-soleil">cirque du soleil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/theater/dance">dance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="category/theater/musical">musical</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/theater/children">children/family</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/theater/las-vegas">las vegas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category/theater/off-broadway">off broadway</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog">BLOG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login">SIGN IN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="lni-scroll-down more-links-icon"></i>
                                <span class="more-links">MORE</span>
                            </a>
                            <i class="lni-chevron-down-circle toggle-collapse" data-toggle="collapse" data-target="#more"></i>
                            <div class="dropdown-nav collapse" id="more">
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact">CONTACT</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about">ABOUT</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="faq">FAQ</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    
    
    
    
    
    <div class="overlay"></div>
    
    
    
    
    
