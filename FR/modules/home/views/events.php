<section class="page-header">
        <div class="container faded-background" <?php if(!empty($img_url)){ ?>style="background-image: url('<?=$img_url?>')"<?php } ?>>
            <h1><?=$page_title?></h1>
        </div>
</section>
<style>
    .event-content ul{
        list-style-type: disc;
        margin-bottom: 10px;
     }
    .event-content ol{
        margin-bottom: 10px;
        list-style-type: decimal;
    }
    .event-content span{
        display: inline;
    }
 </style>
    <main class="events static-background">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if(!empty($contents_on_top)){ ?>
                    <div class="bordered-section d-block event-content">
                        <?php foreach($contents_on_top as $c) echo $c->content?>
                    </div>
                    <?php } ?>
                    
                    <?php if($events){ ?>
                    <table class="table table-hover" id="event-listing">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name & venue</th>
                                <th>Ticket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            is_array($events) || $events = array($events);
                            foreach($events as $e){
                                $tba = explode(" ", $e->DisplayDate);
                                $time = strtotime($e->Date);
                                $url = $this->mfrk->url_friendly_string($e->Name);
                            ?>
                            <tr>
                                <td class="text-center date-time">
                                    <a href="tickets/<?=$e->ID . "/" . $url?>" class="event-details">
                                        <div class="day"><?=date("l", $time)?></div>
                                        <div class="date"><?=date("F j", $time)?></div>
                                        <div class="date"><?=date("Y", $time)?></div>
                                        <div class="time"><?=(!empty($tba[1]) && $tba[1] == "TBA")? "TBA" : date("h:i A", $time)?></div>
                                    </a>
                                </td>
                                <td class="text-left">
                                    <a href="tickets/<?=$e->ID . "/" . $url?>" class="event-details">
                                        <div class="name"><?=$e->Name?></div>
                                        <span class="venue"><?=$e->Venue?> - </span>
                                        <span class="location"><?=$e->City . ", " . $e->StateProvince?></span>
                                    </a>
                                </td>
                                <td class="text-right d-none d-md-block">
                                    <a href="tickets/<?=$e->ID . "/" . $url?>" class="btn btn-gradient">TICKETS</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php }else echo "<h4>No events found according to your query. You may find something interesting <a href='trending-events'>HERE</a></h4>"; ?>
                    
                        
                        
                        
                        
                    <?php if(!empty($contents_on_bottom)){ ?>
                    <div class="bordered-section d-block event-content" style="margin-top: 30px;">
                        <?php foreach($contents_on_bottom as $c) echo $c->content?>
                    </div>
                    <?php } ?>
                </div>
                
                
                
                
                
                <aside class="col-md-3">
                    <div class="bordered-section guarantee">
                        <h3><i class="lni-shield"></i> 100% GUARANTEE</h3>
                        <ul>
                            <li><i class="lni-bolt"></i> Tickets will arrive before the event.</li>
                            <li><i class="lni-bolt"></i> Your seats are together unless otherwise noted.</li>
                            <li><i class="lni-bolt"></i> Tickets will be the ones you ordered or better.</li>
                            <li><i class="lni-bolt"></i> Your tickets will be legitimate and valid for entry at the event.</li>
                            <li><i class="lni-bolt"></i> If your event is permanently canceled you will receive a refund.</li>
                        </ul>
                    </div>
                    
                    
                    
                    
                    
                    <?php if(!empty($contents_on_sidebar)){ ?>
                    <div class="bordered-section d-block event-content">
                        <?php foreach($contents_on_sidebar as $c) echo $c->content?>
                    </div>
                    <?php } ?>
                </aside>
            </div>
        </div>
    </main>





    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#event-listing').DataTable({"lengthChange": false, "pageLength": 52, "ordering": false, "info": false, "language": {"search": "", "paginate": {"previous": "«", "next": "»"}, "searchPlaceholder": "Search by day, date, time, venue, city, state any keyword.", "zeroRecords": "No matching events found" }});
    });
    </script>
