<style>
@media only screen and (max-width: 768px) {footer{display: none;}}
.event-info-date{border: 0;border-right: 1px solid #ccc;padding-right: 15px;text-transform: uppercase;}
.seatics{font-weight: 300;font-family: 'Open Sans', 'Segoe UI';}
#pre-checkout-price-cta{background-image: linear-gradient(to right, #DC0000, black);color:white;border-right-color: black;transition-duration: 0s;}
#pre-checkout-price-cta:hover{background-image: linear-gradient(to left, #DC0000, #DC3545);border-right-color: #DC0000;}
#event-info-area,#list-ctn{
    z-index: 1;
}
</style>
    <main class="tickets static-background">
        <div class="container the-map">
            <div class="the-map-container">
                <div id="tn-maps" role="main" class="seatics"><h3 class="text-center my-5">Loading venue map...</h3></div>
                <script type="text/javascript" src="https://mapwidget3.seatics.com/js?eventId=<?=$id?>&websiteConfigId=<?=$wcid?>&includeBootstrap=false&includeJQuery=false&mobileOptimized=true"></script>
            </div>
        </div>
    </main>
    <script>
        Seatics.config.c3CheckoutDomain = "checkout.tickettransaction.com";
        Seatics.config.c3CurrencyCode = "USD";
        Seatics.config.useC3 = true;
    </script>
